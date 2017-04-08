<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable =['name','value'];
    protected $hidden = [];

    public function getRouteKeyName()
    {
    	return 'name';
    }
    public function getKeyName()
    {
    	return 'name';
    }

    static function val($v){
    	return static::find($v)->value;
    }
}
