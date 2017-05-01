<?php 

namespace App\Services;

use App\ProvideHelp;
use App\Services\EarningService;
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
		$user = $this->user ?? Auth::user();
		DB::beginTransaction();
		try {
		    $ph = $user->phs()->create(['amount'=>$amount]);
		    $this->createEarning($ph,$opts);
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
			$this->deleteEarning($ph);
			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			return false;
		}
		return $res;
	}

	public function deleteEarning(ProvideHelp $ph)
	{
		$es = new EarningService;
		return $es->deleteEarningFor($ph);
	}
}

