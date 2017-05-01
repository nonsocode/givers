<?php 

namespace App\Services;

use App\Pairing;

class TransactionHandler 
{

	protected $pair;

	/**
	 * Create a new Pairing Service Instance
	 * @param Pairing $pair A pairing model
	 */
	public function __construct(Pairing $pair)
	{
		$this->pair = pair;
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

