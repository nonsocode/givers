<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $fillable =  ['amount'];

    public function earning()
    {
        return $this->morphOne(Earning::class,'earnable');
    }

    public function type()
    {
    	return $this->belongsTo(BonusType::class,'bonus_type_id','name');
    }

}
