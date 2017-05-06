<?php 

namespace App\Services;

use App\GetHelp;
use App\Pairing;
use App\ProvideHelp;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
* A class for handling Transaction Matching
*/
class Matcher 
{
    const COMPLETED = 4;
    const FULLY_MATCHED = 3;
    const PARTIALLY_MATCHED = 2;
    const UNMATCHED = 1;

	protected $incompleteGhs;
	protected $incompletePhs;
	protected $recordSet = false;


	protected function setRecords()
	{
		$this->incompleteGhs = GetHelp::incomplete()->get();
		$this->incompletePhs = ProvideHelp::incomplete()->get();
		$this->recordSet = true;
	}

	protected function initRecords(){
		if (!$this->recordSet) {
			$this->setRecords();
		}
	}

	public function getPartialGhs()
	{
		$this->initRecords();
		return $this->incompleteGhs->where('status',self::PARTIALLY_MATCHED)->sortBy('created_at');
	}

	public function getPartialPhs()
	{
		$this->initRecords();
		return $this->incompletePhs->where('status',self::PARTIALLY_MATCHED)->sortBy('created_at');
	}
	public function getUnmatchedGhs()
	{
		$this->initRecords();
		return $this->incompleteGhs->where('status',self::UNMATCHED)->sortBy('created_at');
	}

	public function getUnmatchedPhs()
	{
		$this->initRecords();
		return $this->incompletePhs->where('status',self::UNMATCHED)->sortBy('created_at');
	}

	public function getIncompleteGhs()
	{
		$this->initRecords();
		return $this->incompleteGhs->where('status','<',self::FULLY_MATCHED)->sortBy('created_at');
	}

	public function getIncompletePhs()
	{
		$this->initRecords();
		return $this->incompletePhs->where('status','<',self::FULLY_MATCHED)->sortBy('created_at');
	}

	public function getUrgentPhs()
	{
		$this->initRecords();
		return $this->incompletePhs->where('status',self::UNMATCHED)->where('urgent',true)->sortBy('created_at');
	}

	/**
	 * Creates Pairings in the database
	 * 
	 * @return void 
	 */
	public function createPairings()
	{
		$pghs = $this->getPartialGhs();
		$pphs = $this->getPartialPhs();
		$ughs = $this->getUnmatchedGhs();
		$uphs = $this->getUnmatchedPhs();

		foreach ($pghs as $pgh) {
			DB::transaction(function () use($pphs,$uphs,$pgh){
				$this->loopMatcher($pphs, $pgh);
				if (!$this->hasBalance($pgh)) {
					$this->loopMatcher($uphs, $pgh);
				}
			});
		}
		foreach ($ughs as $ugh) {
			DB::transaction(function () use($pphs,$ugh,$uphs){
				$this->loopMatcher($pphs, $ugh);
				if ($this->hasBalance($ugh)) {
					$this->loopMatcher($uphs, $ugh);
				}
			});
		}
	}

	/**
	 * Check if there is any amount left to be matched
	 * 
	 * @param  mixed $ph The ProvideHelp or GetHelp Model 
	 * @return bool
	 */
	public function hasBalance($ph)
	{
		return $ph->amount_matched < $ph->amount;
	}

	/**
	 * Get the amount left to be matched
	 * 
	 * @param  mixed $ph 	The ProviedeHelp or GetHelp Model
	 * @return float
	 */
	public function getHelpBalance($help)
	{
		return $help->amount - $help->amount_matched;
	}


	/**
	 * Check if a PH and GH can be Paired
	 * @param  App\ProvideHelp $ph 
	 * @param  App\GetHelp $gh 
	 * @return bool     
	 */
	public function canPair($ph, $gh)
	{
		return  $this->getHelpBalance($ph) <= $this->getHelpBalance($gh);
	}

	/**
	 * Creates a pair in the pairings table
	 * 
	 * @param  App\ProvideHelp 	$ph The ProvideHelp Model
	 * @param  App\GetHelp 		$gh The GetHelp Model
	 * @param  float  			$amount The amount of money
	 * @return App\Pairing     An instance of the Pairing Model
	 */
	public function createPair($ph , $gh, $amount)
	{
		$pair = new Pairing;
		$pair->provide_help_id = $ph->id;
		$pair->get_help_id = $gh->id;
		$pair->amount = $amount;
		$pair->expiry = Carbon::now()->isWeekend()? new Carbon('3 Days') : new Carbon('2 Days');
		$res = $pair->save();
		if ($res) {
			$this->updateMatchedAmount($gh,$amount);
			$this->updateMatchedAmount($ph,$amount);
		}
		return $res;
	}

	/**
	 * Update Provide Help Model's status and amount_matched
	 * @param  App\GetHelp $gh        The GetHelp Model
	 * @param  float $addAmount The Amount to be added
	 * @return void
	 */
	public function updateMatchedAmount($h,$addAmount)
	{
		$h->amount_matched = $h->amount_matched +$addAmount;
		if ($this->getHelpBalance($h) > 0 && $this->getHelpBalance($h) < $h->amount) {
			$h->status = self::PARTIALLY_MATCHED;
		}
		elseif ($this->getHelpBalance($h) == 0) {
			$h->status = self::FULLY_MATCHED;
		}
		else{
			$h->status  = self::UNMATCHED;
		}
		$h->save();
	}


	/**
	 * Get the real amount that can be mathce between a PH and GH
	 * @param  App\ProvideHelp $ph 
	 * @param  App\GetHelp $gh 
	 * @return float
	 */
	public function getMatchableAmount($ph, $gh)
	{
		$phBalance = $this->getHelpBalance($ph);
		$ghBalance = $this->getHelpBalance($gh);
		return $phBalance < $ghBalance ? $phBalance : $ghBalance;
	}

	/**
	 * Loop and match a collection of ProvideHelps with a GetHelp
	 * @param  Illuminate\Support\Collection $phs A collection of Provide Helps
	 * @param  App\GetHelp $gh  A GetHelp Model
	 * @return void
	 */
	public function loopMatcher($phs, $gh)
	{
		foreach ($phs as $ph) {
			if ($this->sameOwner($ph,$gh)) continue;
			if ($this->hasBalance($ph)) { # if ph money is not comletely matched
				$matchableAmount = $this->getMatchableAmount($ph,$gh);
				if ($matchableAmount) {#check if mathhable money is not 0
					$pair =  $this->createPair($ph,$gh,$matchableAmount);
				}
				if (!$this->hasBalance($gh)) break;
			}
		}
	}

	/**
	 * Loop and match a collection of ProvideHelps with a GetHelp
	 * @param  Illuminate\Support\Collection $phs A collection of Provide Helps
	 * @param  App\GetHelp $gh  A GetHelp Model
	 * @return void
	 */
	public function urgentLoopMatcher($phs, $gh)
	{
		foreach ($phs as $ph) {
			if ($this->sameOwner($ph,$gh)) continue;
			if ($this->hasBalance($ph)) { # if ph money is not comletely matched
				$matchableAmount = $this->getMatchableAmount($ph,$gh);
				$tenPercent = (10 * $ph->amount /100);
				if ($matchableAmount >= $tenPercent) {#check if mathhable money is not 0
					$pair =  $this->createPair($ph,$gh,$tenPercent);
					$this->removeUrgency($ph);
					$phs->shift();
				}
				if (!$phs->count() || !$this->hasBalance($gh) ) break;
			}
		}
	}

	public function removeUrgency($ph)
	{
		$ph->urgent = false;
		return $ph->save();
	}

	/**
	 * Check if ProvideHelp and GetHelp models have the same owner
	 * 
	 * @param  App\ProvideHelp $ph ProvideHelp Model
	 * @param  App\GetHelp $gh GetHelp model
	 * @return bool     
	 */
	public function sameOwner($ph, $gh)
	{
		return $gh->owner->id  === $ph->owner->id;
	}

	public function createUrgentPairings()
	{
		$ghs = $this->shuffleIncompleteGhs();
		$phs = $this->shuffleIncompletePhs()->where('urgent', true);

		foreach ($ghs as $gh) {
			DB::transaction(function () use($phs,$gh){
				$this->urgentLoopMatcher($phs, $gh);
			});
			if (!$phs->count()) break;
		}
	}

	public function shuffleIncompleteGhs()
	{
		return $this->getIncompleteGhs()->shuffle();
	}

	public function shuffleIncompletePhs()
	{
		return $this->getIncompletePhs()->shuffle();
	}

}