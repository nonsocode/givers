<?php

namespace App;

use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use UniqueId;
    use SoftDeletes;

    public function messages()
    {
    	return $this->hasMany(TicketMessage::class);
    }

    public function owner()
    {
    	$this->belongsTo(User::class);
    }
}
