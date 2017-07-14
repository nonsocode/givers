<?php

namespace App\Http\Controllers;

use App\Config;
use App\Services\EarningService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        // $user = Auth::user()->load(['phs','ghs','phPairings.gh.bankAccount.bank', 'phPairings.ph.owner','ghPairings.ph.owner','ghPairings.gh.bankAccount.bank']);
        $user = Auth::user()->load(['ghs','phs']);
        $helps = $user->phs->merge($user->ghs)->sortByDesc('created_at');
        $cashable = (new EarningService)->cashableFunds();
        // $transactions = $user->phPairings->merge($user->ghPairings)->sortByDesc('created_at');
        $phPairings = $user->phPairings()->incomplete()->with(['gh.bankAccount.bank','ph.owner'])->get();
        $ghPairings = $user->ghPairings()->incomplete()->with(['gh.bankAccount.bank','ph.owner'])->get();
        $transactions = $phPairings->merge($ghPairings)->sortByDesc('created_at');
    	return view(config('view.dashboard').'office.dashboard',compact('helps','user','transactions','cashable'));
    }   
}
