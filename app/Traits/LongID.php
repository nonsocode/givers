<?php 

namespace App\Traits;

/**
* Turens of Auto increments on the $id property of eloquent models
*/
trait LongID{
	
    public static function finder($lid){
        return static::find(intval(explode('-',$lid)[1]));
    }

    protected function getDidAttribute(){
        $prefix = isset($this->idPrefix)?$this->idPrefix : "ID";
        $pad = isset($this->idPadding)? $this->idPadding : 6;
        return $prefix.'-'.str_pad($this->id, $pad, "0", STR_PAD_LEFT);
    }


}