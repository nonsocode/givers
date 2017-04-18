<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketDocument extends Model
{
    ///////////////////
    // Relationships //
    ///////////////////

	public function message()
	{
		return $this->belongsTo(TicketMessage::class);
	}

}
