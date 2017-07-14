<?php

namespace App;

use App\Traits\LongID;
use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketMessage extends Model
{
    use LongID;
    use SoftDeletes;

    protected $fillable = ['message'];
    protected $touches = ['ticket'];
    protected $idPrefix = 'TKM';
    

    public function ticket()
    {
    	return $this->belongsTo(Ticket::class,'ticket_id');
    }
    public function owner()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function documents()
    {
        return $this->hasMany(TicketDocument::class);
    }

    //////////////////
    // Repositories //
    //////////////////

    public function myMessage()
    {
        return \Auth::check() && $this->user_id == \Auth::user()->id;
    }

    ///////////////
    // Mutators  //
    ///////////////

    public function setMessageAttribute($v)
    {
        $pd = new \Parsedown();
        $pd->setMarkupEscaped(true)->setBreaksEnabled(true);
        $this->attributes['message'] = $pd->text($v);
    }
}
