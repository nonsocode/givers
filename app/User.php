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
    // use NodeTrait;
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
    public function outstandingGh(){
        return $this->ghs()->outstanding();
    }
    public function completeGh(){
        return $this->ghs()->complete();
    }
    public function phs()
    {
        return $this->hasMany(ProvideHelp::class);
    }
    public function outstandingPh(){
        return $this->phs()->outstanding();
    }
    public function completePh(){
        return $this->phs()->complete();
    }

    // public function addRole($rolename)
    // {
    //     if ($this->hasRole($rolename)) {
    //         return false;
    //     }
    //     else{
    //         $this->roles()->attach(Role::whereName($rolename)->get());
    //         return true;
    //     }
    // }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

    // public function hasRole($role)
    // {
    //     return $this->roles()->whereName($role)->orWhere('roles.id',$role)->count() ? true:false;
    // }
    // public function isSuperAdmin()
    // {
    //     return $this->roles()->whereName('superadmin')->count() ?true:false;
    // }

    public function isBlocked()
    {
        return $this->status ? false: true;
    }

}