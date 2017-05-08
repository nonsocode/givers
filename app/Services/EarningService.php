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
use Illuminate\Support\Facades\DB;
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
			return $this->createForProvideHelp($earnable,$opts);
		}
	}

	public function createForBonus($bonus, array $opts = [])
	{
		$opts['frozen'] = $opts['frozen'] ?? true;
		return $this->create($bonus,$opts)	;
	}

	public function createForProvideHelp($ph, array $opts = [])
	{
		$opts['frozen'] = $opts['frozen'] ?? true;
		$opts['percentage'] = $opts['percentage'] ?? (float) Conf::val('ph_daily_growth');
		return $this->create($ph,$opts);
	}

	protected function create($earner, array $options = [])
	{
		$e = new Earning;
		$e->user_id =  $options['user_id'] ?? $earner->user_id ??$this->user->id ?? Auth::user()->id;
		$e->initial_amount = $options['amount'] ?? $earner->amount;
		$e->current_amount = $options['amount'] ?? $earner->amount;
		$e->growable = $options['growable'] ?? true;
		$e->percentage = $options['percentage'] ?? 0;
		$e->frozen = $options['frozen'] ?? false;
		$e->description = $options['description'] ?? null;
		$e->growth_end = $options['growth_end'] ?? Carbon::now()->addDays(30);
		$e->releasable = $options['releasable'] ?? Carbon::now()->addDays(14);
		$e->expiry = $options['expiry'] ?? Carbon::now()->addDays(37);
		return $earner->{$this->earningRelation($earner)}()->save($e);
	}

	public function earningRelation($earner)
	{
		if ($earner instanceof ProvideHelp) {
			return 'earnings';
		}
		elseif ($earner instanceof Bonus) {
			return 'earning';
		}
	}

	public function deleteEarningsFor($earnable)
	{
		if ($earnable instanceof ProvideHelp) {
			return $earnable->earnings()->delete();
		}
		elseif ($earnable instanceof Bonus) {
			return $earnable->earning()->delete();
		}
	}

	public function cashableFunds($user = null, $pretty = true)
	{
		$user = $user ?? $this->user ?? Auth::user();
		$earning = $user->earnings()->availableForWithdrawal()->get();
		$cashable = $earning->sum('current_amount') - $earning->sum('claimed_amount');
		return $pretty ? number_format($cashable,2) : $cashable;
	}

	public function ghable($earning,$amount = null)
	{
		if (!($earning instanceof Earning)) {
			$earning = Earning::find($earning);
		}
		$conds = [];
		$conds[] = !$this->hasExpired($earning);
		$conds[] = $this->isReleased($earning);
		$conds[] = $amount <= $earning->available_amount;
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

	public function growGrowableFunds()
	{
		$earnings  = Earning::growable()->notExpired()->get();
		DB::beginTransaction();
		try {
			$earnings->each(function ($e,$key)
			{
				$e->current_amount += $e->initial_amount * $e->percentage/100;
				$e->save();
			});
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
		return false;
	}

	public function shrinkGrowableFunds()
	{
		$earnings  = Earning::growable()->notExpired()->get();
		DB::beginTransaction();
		try {
			$earnings->each(function ($e,$key)
			{
				$e->current_amount -= $e->initial_amount * $e->percentage/100;
				$e->save();
			});
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
		return false;
	}
}