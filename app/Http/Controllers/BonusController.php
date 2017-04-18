<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BonusController extends Controller
{

    public function index()
    {
    	$data['headerText'] = 'Bonuses';
    	$data['bonuses'] = \Auth::user()->bonuses;
    	return view('office.bonuses.index',$data);
    }

}
