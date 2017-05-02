<?php

namespace App\Http\Controllers;

use App\GetHelp;
use App\Services\GetHelpService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetHelpController extends Controller
{
	public function create()
	{
        $cashable = User::earnings()->availableForWithdrawal()->get();
		return view(config('view.dashboard').'office.get.create')
            ->with()
        ;
	}
    public function delete(GetHelp $gh)
    {
        $ghService = new GetHelpService;
        if ($ghService->deletable($gh)){
            if($ghService->delete($gh)){
                return ['status' => 'success'];
            }
        }
        return ['status' => 'fail'];
    }

}
