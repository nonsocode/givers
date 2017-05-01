<?php

namespace App;

use App\MoneyModel;
use App\Traits\LongID;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Earning extends MoneyModel
{
    use LongID;

	protected $dates = ['created_at','deleted_at','updated_at','expiry','releasable','growth_end'];
    protected $idPrefix = 'ERN';
    protected $appends = ['status'];
    protected $money = ['initial_amount','current_amount','claimed_amount','available_amount','releasedate_amount'];
	///////////////////
	// Relationships //
	///////////////////

    public function earnables()
    {
    	return $this->morphTo();
    }

    public function ghs()
    {
    	return $this->belongsToMany(GetHelp::class,'earning_get_help')->withPivot('amount');
    }

    public function owner()
    {
    	return $this->belongsTo(User::class);
    }	

    ////////////
    // Scopes //
    ////////////

    public function scopeAvailableForWithdrawal($query)
    {
    	return $query->where('releasable','<=',Carbon::now())->where('expiry','>=',Carbon::now())->whereFrozen(false);
    }

    public function scopeNotExpired($query)
    {
        return $query->where('expiry','>' , Carbon::now());
    }

    public function scopeExpired($query)
    {
        return $query->where('expiry','<', Carbon::now());
    }

    public function scopeGrowable($query)
    {
        return $query->whereGrowable(true)->where('growth_end','>',Carbon::now());
    }

    public function scopeNotGrowable($query)
    {
        return $query->whereGrowable(false)->orWhere('growth_end','<',Carbon::now());
    }

    public function scopeFrozen($query)
    {
        return $query->whereFrozen(true);
    }

    public function scopeNotFrozen($query)
    {
        return $query->whereFrozen(false);
    }

    //////////////////////////
    // Accessors & Mutators //
    //////////////////////////

    public function getStatusAttribute()
    {
        if ($this->deleted_at) {
            return 'deleted';
        }
        elseif ($this->expiry->lt(Carbon::now())) {
            return 'expired';
        }
        elseif ($this->releasable->gt(Carbon::now())) {
            return 'frozen';
        }
        elseif ($this->available_amount) {
            return 'available';
        }
        elseif($this->growable) {
            return 'claiming';
        }
        else{
            return 'claimed';
        }
    }

    public function getAvailableAmountAttribute()
    {
        return $this->current_amount - $this->claimed_amount;
    }

    public function getReleasedateAmountAttribute()
    {
        $days = $this->created_at->diffInDays($this->releasable);
        $percentage = $this->percentage/100;
        $init = $this->initial_amount;
        return $init * ( 1 +($days* $percentage));
    }
}