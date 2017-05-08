<?php 

namespace App\Services;

use App\Pairing;
use App\PairingConfirmation;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

