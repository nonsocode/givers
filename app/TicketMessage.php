<?php

namespace App;

use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketMessage extends Model
{
    use UniqueId;
    use SoftDeletes;

    protected $fillable = ['message'];
    public $incrementing = false;

    public function ticket()
    {
    	return $this->belongsTo(Ticket::class);
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
        $pd->setMarkupEscaped(true);
        $this->attributes['message'] = $pd->text($v);
    }
}
