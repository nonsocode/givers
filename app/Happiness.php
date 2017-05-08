<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Happiness extends Model
{
    public function media()
    {
    	return $this->hasOne(HappinessMedia::class,'happiness_id');
    }
}
