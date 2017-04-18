<?php

namespace App;

use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/////////////////////////////
// Status Messages         //
/////////////////////////////
//                         //
// 0 -> Open Ticket        //
// 1 -> In-Progress Ticket //
// 2 -> Closed Ticket      //
/////////////////////////////

class Ticket extends Model
{
    use UniqueId;
    use SoftDeletes;

    public $incrementing = false;

    ////////////////////////////
    // Mutators and Accessors //
    ////////////////////////////

    public function getTidAttribute()
    {
        return "#".$this->did;
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'Open';
                break;
            case 1:
                return 'In-Progress';
                break;
            case 2:
                return 'Closed';
                break;
            
            default:
                return 'Unknown';
                break;
        }
    }

    ///////////////////
    // Relationships //
    ///////////////////

    public function messages()
    {
    	return $this->hasMany(TicketMessage::class);
    }

    public function owner()
    {
    	$this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(SupportCategory::class,'support_category_id');
    }
}
