<?php

namespace App\Http\Controllers;

use App\Services\EarningService;
use Illuminate\Http\Request;

class EarningsController extends Controller
{
    public function index()
    {
    	$myEarnings = (new EarningService)->myAll();
    	return view(config('view.dashboard')."office.earnings.index")->with([
    		'earnings' => $myEarnings
		]);
    }
}
