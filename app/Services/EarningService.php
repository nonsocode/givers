<?php

namespace App\Services;

use App\Bonus;
use App\Config as Conf;
use App\Earning;
use App\GetHelp;
use App\ProvideHelp;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
/**
* 
*/
class EarningService
{
	protected $user;
	

	public function __construct($user = null)
	{
		$this->user = $user ?? Auth::user();
	}



	public function createFor($earnable, array $opts = [])
	{
		if ($earnable instanceof ProvideHelp) {
			return $this->createForBonus($earnable,$opts);
		}
		elseif ($earnable instanceof Bonus) {
			$opts['frozen'] = true;
			return $this->createForProvideHelp($earnable,$opts);
		}
	}

	public function createForBonus($bonus, array $opts = [])
	{
		return $this->create($bonus,$opts)	;
	}

	public function createForProvideHelp($ph, array $opts = [])
	{
		$opts['percentage'] = $opts['percentage'] ?? (float) Conf::val('ph_daily_growth');
		return $this->create($ph,$opts);
	}

	protected function create($earner, array $options = [])
	{
		$e = new Earning;
		$e->user_id =  $options['user_id'] ?? $earner->user_id ??$this->user->id ?? Auth::user()->id;
		$e->initial_amount = $earner->amount;
		$e->current_amount = $earner->amount;
		$e->growable = $options['growable'] ?? true;
		$e->percentage = $options['percentage'] ?? 0;
		$e->percentage = $options['frozen'] ?? false;
		$e->growth_end = $options['growth_end'] ?? Carbon::now()->addDays(30);
		$e->releasable = $options['releasable'] ?? Carbon::now()->addDays(14);
		$e->expiry = $options['expiry'] ?? Carbon::now()->addDays(37);
		return $earner->earning()->save($e);
	}

	public function deleteEarningFor($earnable)
	{
		return $earnable->earning->delete();
	}

	public function cashableFunds($user = null, $pretty = true)
	{
		$user = $user ?? $this->user ?? Auth::user();
		$earning = $user->earnings()->availableForWithdrawal()->get();
		$cashable = $earning->sum('current_amount') - $earning->sum('claimed_amount');
		return $pretty ? number_format($cashable,2) : $cashable;
	}

	public function ghable($earning)
	{
		if (!($earning instanceof Earning)) {
			$earning = Earning::find($earning);
		}
		$conds = [];
		$conds[] = !$this->hasExpired($earning);
		$conds[] = $this->isReleased($earning);
		$res = true;
		foreach ($conds as $cond) {
			$res &= $conds;
		}

		return $res;
	}

	public function hasExpired(Earning $earning)
	{
		return $earning->expiry->lt(Carbon::now());
	}

	public function isReleased(Earning $earning)
	{
		return $earning->releasable->lt(Carbon::now());
	}

	/**
	 * Add amount to claimed amount

	 * @param App\GetHelp $addable A GetHelp Model
	 * @param int $earningId Id of Earning model
	 */
	public function addClaimedAmount($addable, $earningId)
	{
		if ($addable instanceof GetHelp) {
			$earning = $addable->earnings()->find($earningId);
			$earning->claimed_amount += $earning->pivot->amount;
			$earning->save();
			return $earning;
		}
		return false;
	}

	public function deductClaimedAmount($deductable, $earningId)
	{
		if ($deductable instanceof GetHelp) {
			$earning = $deductable->earnings()->find($earningId);
			$earning->claimed_amount += $earning->pivot->amount;
			$earning->save();
			return $earning;
		}
		return false;
	}

	public static function all()
	{
		return Earning::all();
	}

	public function myAll()
	{
		$user = $this->user ?? Auth::user();
		return $this->user->earnings;
	}
}