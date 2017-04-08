<?php

namespace App;

use App\Traits\UniqueId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pairing extends Model
{
    use UniqueId;
    use SoftDeletes;

	public $incrementing = false;
    

	public function gh()
	{
		return $this->belongsTo(GetHelp::class,'get_help_id');
	}
	public function ph()
	{
		return $this->belongsTo(ProvideHelp::class,'provide_help_id');
	}
}
