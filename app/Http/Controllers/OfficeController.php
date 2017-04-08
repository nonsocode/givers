<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
	function __construct()
	{
		$this->middleware(['auth']);
	}
    public function index(){
    	$phPairs = \Auth::user()->phPairings()->with(['ph','gh.owner'])->take(5)->latest()->get();
    	$ghPairs = \Auth::user()->ghPairings()->with(['gh','ph.owner'])->take(5)->latest()->get();
    	// $user = \Auth::user()->load([
    	// 		'phs.owner'=> function ($q){
    	// 			$q->orderBy('created_at','desc');
    	// 		},
    	// 		'ghs.owner'=> function ($q){
    	// 			$q->orderBy('created_at','desc');
    	// 		},

    	// 	]);
    	// $ghs = $user->ghs;
    	// $phs = $user->phs;
    	$ghs = \Auth::user()->ghs()->with(['owner'])->latest()->take(5)->get();
    	$phs = \Auth::user()->phs()->with(['owner'])->latest()->take(5)->get();
        $phLimit = Config::find('ph_limit');
        $ghLimit = Config::find('gh_limit');
        $ghMax = Config::find('gh_max');
        $phMax = Config::find('ph_max');
    	return view('office.dashboard',compact('phPairs','ghPairs','ghs','phs','ghLimit','phLimit','ghMax','phMax'));
    }
    public function refferals()
    {
        $page = 'referrals';
        return view('office.refferals');
    }	
    
}
