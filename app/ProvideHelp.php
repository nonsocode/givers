<?php

namespace App;

use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
    /**
     * status 0 -> Created
     * status 1 -> Partially Mathched
     * status 2 -> Fully Matched
     * status 3 -> Fully Paid
     */

class ProvideHelp extends Model
{

    use UniqueId;
    use SoftDeletes;

    public $incrementing = false;
    

	protected $guarded = ['id'];
    // protected $hidden = ['status'];
    public function pairings()
    {
        return $this->hasMany(Pairing::class);
    }
    public function owner()
    {
    	return $this->belongsTo(User::class,'user_id');
    }
    public function scopeOutstanding($query)
    {
    	return $query->where('status', '!=', 4);
    }
    public function scopeComplete($query)
    {
    	return $query->where('status', '=', 4);
    }
    static function allOutstanding(){
    	return static::where('status', '!=', 4)->get();
    }

}
