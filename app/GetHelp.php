<?php

namespace App;

use App\MoneyModel;
use App\Traits\LongID;
use App\Traits\StatusCollections;
use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GetHelp extends MoneyModel
{
    use LongID;
    use SoftDeletes;
    use StatusCollections;

    protected $idPrefix = 'GH';
    protected $money = ['amount', 'amount_gotten','amount_matched'];
    const COMPLETED = 4;
    const FULLY_MATCHED = 3;
    const PARTIALLY_MATCHED = 2;
    const UNMATCHED = 1;
    

	protected $guarded = ['id'];

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

    public function getTypeAttribute()
    {
        return 'provide-help';
    }

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
}
