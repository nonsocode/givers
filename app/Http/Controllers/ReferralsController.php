<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralsController extends Controller
{
    public function index()
    {
    	$children = Auth::user()->load('children.primaryPhone')->children;
    	return view(config('view.dashboard').'office.referrals.index',['children' => $children]);
    }
}
