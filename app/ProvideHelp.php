<?php

namespace App;

use App\Earning;
use App\MoneyModel;
use App\Traits\LongID;
use App\Traits\StatusCollections;
use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * status 0 -> Canceled
     * status 1 -> Created and Unmatched
     * status 2 -> Partially Mathched
     * status 3 -> Fully Matched
     * status 4 -> Fully Paid
     * status 5 -> Matured
     */

class ProvideHelp extends MoneyModel
{

    use LongID;
    use SoftDeletes;
    use StatusCollections;

    const COMPLETED = 4;
    const FULLY_MATCHED = 3;
    const PARTIALLY_MATCHED = 2;
    const UNMATCHED = 1;

    protected $idPrefix = 'PH';
	protected $guarded = ['id'];
    protected $money = ['amount','amount_matched'];
    
    ///////////////////
    // Relationships //
    ///////////////////
    public function pairings()
    {
        return $this->hasMany(Pairing::class);
    }
    public function owner()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function earnings()
    {
        return $this->morphMany(Earning::class,'earnable');
    }

    ////////////
    // Scopes //
    ////////////
    public function scopeVeryFirst($q)
    {
        return $q->whereVeryFirst(true);
    }
    //////////////////////////
    // Accessors & Mutators //
    //////////////////////////

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'Canceled';
                break;
            case 1:
                return 'Unmatched';
                break;
            case 2:
                return 'Partially Matched';
                break;
            case 3:
                return 'Fully Matched';
                break;
            case 4:
                return 'Fully Paid';
                break;
            case 5:
                return 'Unfrozen';
                break;
            
            default:
                return 'Unknown';
                break;
        }
    }

    public function getTypeAttribute()
    {
        return 'provide-help';
    }

    ///////////
    // Tests //
    ///////////

    public function authOwner()
    {
        return $this->owner->id === \Auth::user()->id;
    }

    public function canBeDeleted(){
        return $this->status === 1 && $this->authOwner();
    }

    public function isVeryFirst()
    {
        return $this->very_first;
    }

}
