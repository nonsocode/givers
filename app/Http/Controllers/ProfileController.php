<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    	$data['headerText'] = 'Profile';
    	$data['user'] = \Auth::user()->load(['phones','bankAccounts.bank']);
    	return view('office.profile',$data);
    }
}
