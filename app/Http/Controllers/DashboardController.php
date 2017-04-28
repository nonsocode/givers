<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user()->load(['phs','ghs','phPairings.gh.owner.bankAccount.bank', 'phPairings.ph.owner','ghPairings.ph.owner','ghPairings.gh.owner.bankAccount.bank']);
        $helps = $user->phs->merge($user->ghs)->sortByDesc('created_at');
        $transactions = $user->phPairings->merge($user->ghPairings)->sortByDesc('created_at');
    	return view(config('view.dashboard').'office.dashboard',compact('helps','user','transactions'));
    }   
}
