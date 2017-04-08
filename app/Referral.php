<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Referral extends Model
{
    use NodeTrait;

    public function getRouteKeyName(){
    	return 'baby_email';
    }
}
