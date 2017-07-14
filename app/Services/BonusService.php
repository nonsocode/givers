<?php 

namespace App\Services;

use App\Bonus;
use App\BonusType;
use App\ProvideHelp;
use App\Services\EarningService;
use App\User;
use Illuminate\Support\Facades\DB;

class BonusService 
{
	const REFERRAL_BONUS = 5;
	 const VIDEO_OF_HAPINESS = 5;
	 const SPEED_PAYMENT = 2;
	 const SPEED_CONFIRM = 1;
	 const REGISTERATION = 5;
	 protected $user;

	public function __construct($user=null)
	{
		$this->user = $user?:\Auth::user();
	}

	protected function createBonus($bonus, $opts = [])
	{
		$user = $opts['user'] ?? $this->user;
		$bonus->description = $opts['description'] ?? null;
		DB::beginTransaction();
		try {
			$user->bonuses()->save($bonus);
			$this->createEarning($bonus,$opts);
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}

	public function createReferralBonus(ProvideHelp $ph, $opts = [])
	{
		$bonus = new Bonus;
		$bonus->amount = $ph->amount * self::REFERRAL_BONUS /100;
		return $this->createBonus($bonus, $opts);
	}

	public function createSpeedConfirmationBonus()
	{
		
	}

	public function createSpeedPaymentBonus()
	{
		
	}

	public function createVOHBonus()
	{
		
	}

	public function createSecondGenerationBonus()
	{

	}

	public function createEarning($bonus, $opts = [])
	{
		$es = new EarningService;
		return $es->createFor($bonus,$opts);
	}
}	