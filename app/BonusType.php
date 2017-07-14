<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusType extends Model
{
    public function getKeyname()
    {
    	return 'name';
    }
    public function bonuses()
    {
    	return $this->hasMany(Bonus::class);
    }
}
