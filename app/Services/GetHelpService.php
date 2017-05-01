<?php 

namespace App\Services;

use App\Earning;
use App\GetHelp;
use App\Services\EarningService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
* 	
*/
class GetHelpService 
{
	protected $user;

	function __construct($user = null)
	{
		$this->user = $user ?? Auth::user();
	}

	public function create(array $options)
	{
		$options = collect($options);
		foreach ($options as $key => $value) {
			if (!$this->ghable($key)) {
				return false;
			}
		}
		DB::beginTransaction();
		try {
			$gh = new GetHelp;
			$gh->amount = $options->sum();
			$this->user->ghs()->save($gh);
			foreach ($options as $key => $value) {
				$e = Earning::find($key);
				$e->ghs()->attach($gh, ['amount'=> $value]);
				$es = new EarningService;
				$es->addClaimedAmount($gh,$key);
			}
			DB::commit();
			return $gh;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
		return false;
		// if ($this->ghable($earning)) {
		// 	DB::beginTransaction();
		// 	try {
		// 		$gh = new GetHelp;
		// 		$gh->amount = $earning->current_amount;
		// 		$gh->user_id = $this->user->id ?? $earing->user;
		// 		$earning->ghs()->save($gh);
		// 		$es = new EarningService;
		// 		$es->addClaimedAmount($gh);
		// 		DB::commit();
		// 	} catch (Exception $e) {
		// 		DB::rollBack();
		// 		return false;
		// 	}
		// 	return $gh;
		// }
		// return false;
	}

	public function ghable($earning)
	{
		return (new EarningService)->ghable($earning);
	}

	public function delete($gh)
	{
		if ($this->deletable($gh)) {
			DB::beginTransaction();
			try {
				(new EarningService)->deductClaimedAmount($gh);
				$res = $gh->delete();
				DB::commit();
				return $res;
			} catch (Exception $e) {
				DB::rollBack();
				return false;
			}
			return false;
		}
		return false;
	}

	public function deletable(GetHelp $gh)
	{
		return $gh->status == GetHelp::UNMATCHED;
	}
}