<?php 

namespace App\Traits;

/**
* Turens of Auto increments on the $id property of eloquent models
*/
trait UniqueId{
	
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = \Uuid::generate()->string;
        });
    }

    protected function getDidAttribute(){
        return explode('-',$this->id)[4];
    }


}