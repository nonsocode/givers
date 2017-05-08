<?php 

namespace App\Services;

use App\Config as Conf;
use App\ProvideHelp;
use App\Services\EarningService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
* 		
*/
class ProvideHelpService
{
	protected $user;

	public function __construct($user=null)
	{
		$this->user = $user?:\Auth::user();
	}

	public function latestAmount($user=null)
	{
		$user = $user?: $this->user;
		$ph = $user->phs()->latest()->first();
		return $ph? $ph->amount : 0;
	}

	public function prettyLatestAmount($user=null)
	{
		$user = $user?: $this->user;
		$ph = $user->phs()->latest()->first();
		return $ph? $ph->prettyAmount : 'NGN 0';
	}

	public function amountSufficient($amount)
	{
		return $amount >= $this->latestAmount();
	}

	public function create($amount,$opts = [])
	{
		$firstTime = $this->isFirstTimePhing();
		$user = $this->user ?? Auth::user();
		DB::beginTransaction();
		try {
		    $ph = $user->phs()->create(['amount'=>$amount,'urgent' => $firstTime]);
		    $opts['description'] = Conf::val('ph_daily_growth')."% Daily Earning for ($ph->did)";
		    $this->createEarning($ph,$opts);
		    if ($firstTime) {
		    	$this->createEarning($ph,[
		    		'description' => '5% Registeration bonus',
		    		'growable' => false,
		    		'amount' => $ph->amount * 0.05,
	    		]);
	    		$this->createReferralBonus($ph);
		    }
		    DB::commit();
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
		return $ph;
	}

	public function createEarning($ph, $opts = []){
		$es = new EarningService;
		return $es->createFor($ph, $opts);
	}

	public function delete(ProvideHelp $ph)
	{
		DB::beginTransaction();
		try {
			$res = $ph->delete();
			$this->deleteEarnings($ph);
			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			return false;
		}
		return $res;
	}
	public function deleteWithPenalty(ProvideHelp $ph)
	{
		if($this->$delete($ph))
		{
			$this->$user;
		}
	}

	public function deleteEarnings(ProvideHelp $ph)
	{
		$es = new EarningService;
		return $es->deleteEarningsFor($ph);
	}

	public function isFirstTimePhing()
	{
		return $this->user->phs()->withTrashed()->count() ? false : true;
	}

	public function isFirstPh($ph)
	{
		return $ph->very_first;
	}

	public function leastAcceptableAmount()
	{
		$latestAmount = $this->latestAmount();
        $minConf = Conf::val('ph_min');
        return  $latestAmount > $minConf ? $latestAmount : $minConf;
	}

	public function createReferralBonus($ph)
	{
		$user = $this->user->parent ?: User::find(1000);
		return (new BonusService)->createReferralBonus($ph, 
			[
				'description' => '5% Referral Bonus for User '.$this->user->did,
				'user' => $user,
				'percentage' => 0,
			]);
	}
}

