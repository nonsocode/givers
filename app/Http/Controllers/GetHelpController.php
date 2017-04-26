<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetHelpController extends Controller
{
	public function create()
	{
		return view(config('view.dashboard').'office.get.create');
	}
}
