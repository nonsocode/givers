<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable =['name','value'];
    protected $hidden = [];
    protected static $attr=[];

    public function getRouteKeyName()
    {
    	return 'name';
    }
    public function getKeyName()
    {
    	return 'name';
    }

    static function val($v){
        if (isset(static::$attr[$v]) && !is_null(static::$attr[$v])) {
            return static::$attr[$v];
        }
    	return static::$attr[$v] =  static::find($v)->value ?? null;
    }
}
