<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HappinessMedia extends Model
{
    public function hapiness()
    {
    	return $this->belongsTo(Happiness::class,'happiness_id');
    }
}
