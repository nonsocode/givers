<?php

namespace App;

use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketMessage extends Model
{
    use UniqueId;
    use SoftDeletes;

    public $incrementing = false;

    public function ticket()
    {
    	return $this->belongsTo(Ticket::class);
    }
    public function owner()
    {
    	return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(TicketDocument::class);
    }
}
