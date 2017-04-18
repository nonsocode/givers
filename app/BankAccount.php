<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
	protected $fillable = ['name','number',];
	
    public function bank()
    {
    	return $this->belongsTo(Bank::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
