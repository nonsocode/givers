<?php

namespace App;

use App\GH;
use App\Role;
use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kalnoy\Nestedset\NodeTrait;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use UniqueId;
    use NodeTrait;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password','first_name', 'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','_lft','_rgt','created_at','updated_at'
    ];

    protected $allChildren = [];

    ////////////////////////////
    // Accessors and Mutators //
    ////////////////////////////

    protected function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    protected function setFirstNameAttribute($name)
    {
        $this->attributes['first_name'] = implode('-',array_map(function($i){
            return ucfirst(strtolower($i));
        },
        explode("-",$name)));
    }
    protected function getNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }
    protected function setLastNameAttribute($name)
    {
        $this->attributes['last_name'] = implode('-',array_map(function($i){
            return ucfirst(strtolower($i));
        },
        explode("-",$name)));
    }


    ///////////////////////////
    // Relationships         //
    ///////////////////////////

    public function phPairings()
    {
        return $this->hasManyThrough(Pairing::class,ProvideHelp::class);
    }
    public function ghPairings()
    {
        return $this->hasManyThrough(Pairing::class,GetHelp::class);
    }
    public function ghs()
    {
        return $this->hasMany(GetHelp::class);
    }

    public function phs()
    {
        return $this->hasMany(ProvideHelp::class);
    }
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function phones(){
        return $this->hasMany(Phone::class);
    }

    public function primaryPhone()
    {
        return $this->hasOne(Phone::class)->wherePrimary(true);
    }

    public function bankAccounts(){
        return $this->hasMany(BankAccount::class);
    }

    ////////////////////////////
    // Repositories and stuff //
    ////////////////////////////
    public function outstandingGh(){
        return $this->ghs()->outstanding();
    }
    public function completeGh(){
        return $this->ghs()->complete();
    }
    public function outstandingPh(){
        return $this->phs()->outstanding();
    }
    public function completePh(){
        return $this->phs()->complete();
    }

    public function isBlocked()
    {
        return $this->status ? false: true;
    }

}