<?php

namespace App;

use App\MoneyModel;
use App\Traits\LongID;
use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Statuses
// 
class Pairing extends MoneyModel
{
    use LongID;
    use SoftDeletes;

    protected $idPrefix = 'TRN';
    protected $money = ['amount'];

	
	protected $fillable = ['ammount','expiry'];
    

	public function gh()
	{
		return $this->belongsTo(GetHelp::class,'get_help_id');
	}
	public function ph()
	{
		return $this->belongsTo(ProvideHelp::class,'provide_help_id');
	}
	public function receiver(){
		return $this->gh->owner;
	}
	public function giver(){
		return $this->ph->owner;
	}
}
