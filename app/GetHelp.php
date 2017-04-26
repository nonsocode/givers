<?php

namespace App;

use App\MoneyModel;
use App\Traits\LongID;
use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GetHelp extends MoneyModel
{
    use LongID;
    use SoftDeletes;

    protected $idPrefix = 'GH';
    protected $money = ['amount', 'amount_gotten'];
    

	protected $guarded = ['id'];

    public function pairings()
    {
        return $this->hasMany(Pairing::class);
    }
    public function owner()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function scopeOutstanding($query)
    {
    	return $query->where('status', '!=', 4);
    }
    public function scopeComplete($query)
    {
    	return $query->where('status', '=', 4);
    }
    static function allOutstanding(){
    	return static::where('status', '!=', 4)->get();
    }
}
