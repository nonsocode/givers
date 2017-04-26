<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user()->load(['phs','ghs','phPairings.gh.owner','ghPairings']);
        $helps = $user->phs->merge($user->ghs)->sortByDesc('created_at');
        $transactions = $user->phPairings->merge($user->ghPairings);
    	return view(config('view.dashboard').'office.dashboard',compact('helps','user','transactions'));
    }   
}
