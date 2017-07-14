<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketDocument extends Model
{
	protected $fillable = ['url'];
    ///////////////////
    // Relationships //
    ///////////////////

	public function message()
	{
		return $this->belongsTo(TicketMessage::class);
	}

}
