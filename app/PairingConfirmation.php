<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PairingConfirmation extends Model
{
    protected $dates = ['created_at','updated_at','fake','pher_stamp','gher_confirm'];
}
