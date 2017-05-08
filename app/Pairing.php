<?php

namespace App;

use App\MoneyModel;
use App\Traits\LongID;
use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

// Statuses
// 
class Pairing extends MoneyModel
{
    use LongID;
    use SoftDeletes;

    protected $idPrefix = 'TRN';
    protected $money = ['amount'];
	protected $dates = ['expiry'];
	protected $fillable = ['ammount','expiry'];
    

	public function gh()
	{
		return $this->belongsTo(GetHelp::class,'get_help_id');
	}
	public function ph()
	{
		return $this->belongsTo(ProvideHelp::class,'provide_help_id');
	}
	public function account()
	{
		return $this->belongsTo(BankAccount::class,'account');
	}

	public function confirmation()
	{
		return $this->hasOne(PairingConfirmation::class,'pairing_id');
	}
	public function receiver(){
		return $this->gh->owner;
	}
	public function giver(){
		return $this->ph->owner;
	}

	public function getStatusTextAttribute()
	{
		if ($this->pher_confirm && $this->gher_confirm) {
			return 'Transaction Complete';
		}
		elseif (!$this->pher_confirm && $this->gher_confirm) {
			return 'Receiver Has confirmed receipt';
		}
		elseif ($this->pher_confirm && !$this->gher_confirm) {
			return  'Giver Has confirmed payment';
		}
		elseif (Carbon::now()->gt($this->expiry)) {
			return 'Transaction has Expired';
		}
		else{
			return 'Pending';
		}
	}

	public function getStatusAttribute()
	{
	}
}
