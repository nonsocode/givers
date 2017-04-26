<?php

namespace App;

use App\MoneyModel;
use App\Traits\LongID;
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

    protected $idPrefix = 'PH';
	protected $guarded = ['id'];
    protected $money = ['amount','amount_paid','current_worth'];
    
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

    ////////////
    // Scopes //
    ////////////

    public function scopeOutstanding($query)
    {
    	return $query->where('status', '!=', 4);
    }
    public function scopeComplete($query)
    {
    	return $query->where('status', '=', 4);
    }
    public static function allOutstanding(){
    	return static::where('status', '!=', 4)->get();
    }
    //////////////////////////
    // Accessors & Mutators //
    //////////////////////////

    public function getStatusTextAttribute(){
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
}
