<?php

namespace App;

use App\GH;
use App\Role;
use App\Traits\LongID;
use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use LongID;
    use NodeTrait;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password','first_name', 'last_name'
    ];
    protected $idPrefix = 'USR';

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
    protected function getShortNameAttribute($prop){
        return $this->first_name." ".ucfirst($this->last_name[0]).".";
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

    protected function getStatusTextAttribute(){
        switch ($this->attributes['status']) {
            case 0:
                return 'innactive';
                break;
            case 1:
                return 'active';
                break;
            
            default:
                return null;
                break;
        }
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

    public function ticketMessages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function phones(){
        return $this->hasMany(Phone::class);
    }

    public function phone()
    {
        return $this->hasOne(Phone::class)->wherePrimary(true);
    }

    public function bankAccounts(){
        return $this->hasMany(BankAccount::class);
    }

    public function bankAccount(){
        return $this->hasOne(BankAccount::class)->wherePrimary(true);;
    }

    public function bonuses(){
        return $this->hasMany(Bonus::class);
    }

    public function earnings()
    {
        return $this->hasMany(Earning::class);
    }

    ////////////////////////////
    // Repositories and stuff //
    ////////////////////////////
    public function routeNotificationForTwilio()
    {
        return $this->phone->number;
    }
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

    public function latestPhAmount(){
        $ph = $this->phs()->latest()->first();
        return $ph ? $ph->amount: 0;
    }

    public function isBlocked()
    {
        return $this->status ? false: true;
    }

    public function isLoggedIn()
    {
        return Auth::check() && $this->id == Auth::user()->id;
    }

}