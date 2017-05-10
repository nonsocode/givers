<?php 

namespace App\Services;

use App\Happiness;
use App\Pairing;
use App\PairingConfirmation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionHandler 
{

	protected $pair;

	/**
	 * Create a new Pairing Service Instance
	 * @param Pairing $pair A pairing model
	 */
	public function __construct(Pairing $pair)
	{
		$this->pair = $pair;
	}

	public function savePOP(Request $request)
	{
		$url = $request->file('proof_of_payment')->store('pop','public');
		if (!$this->pair->confirmation)
		{
			$confirmation = new PairingConfirmation;
			$confirmation->url = $url;
			$confirmation->pher_stamp = Carbon::now();
			$this->pair->confirmation()->save($confirmation);
		}
		else {
			$confirmation = $this->pair->confirmation;
			$confirmation->url = $url;
			$confirmation->pher_stamp = Carbon::now();
			$confirmation->save();
		}
		return $confirmation;
	}

	public function saveLetterOfHappiness($request)
	{
		if (!$this->pair->happiness) {
			$happiness = new Happiness;
			$happiness->message = $request->letter_of_happiness;
			$happiness->user_id = Auth::check() ? Auth::user()->id : $this->pair->receiver->id;
			DB::beginTransaction();
			try {
				$this->pair->happiness()->save($happiness);
				$this->ghStamp();
				DB::commit();
				return true;
			} catch (Exception $e) {
				DB::rollback();
				return false;
			}
		}
		else{
			$this->pair->happiness->message = $request->letter_of_happiness;
			DB::beginTransaction();
			try {
				$this->pair->hapiness->save();
				$this->ghStamp();
				DB::commit();
				return true;
			} catch (Exception $e) {
				DB::rollback();
				return false;
			}
		}
	}

	public function ghStamp()
	{
		$this->pair->confirmation->gher_confirm = Carbon::now();
		return  $this->pair->confirmation->save() ? true :false ;
	}
	public function pherConfirm($url)
	{
		$this->pair->pher_confirm = $url;
	}

	public function gherConfirm()
	{
		$this->pair->gher_confirm = true;
	}

	public function persist()
	{
		return $this->pair->save();
	}
	

}

