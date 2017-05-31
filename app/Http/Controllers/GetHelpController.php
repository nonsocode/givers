<?php

namespace App\Http\Controllers;

use App\GetHelp;
use App\Http\Requests\StoreGetHelpRequest;
use App\Services\GetHelpService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetHelpController extends Controller
{
	public function create()
	{
        Auth::login();
        $bankAccounts = Auth::user()->bankAccounts()->with('bank')->get();
        $cashable = Auth::user()->earnings()->availableForWithdrawal()->notZero()->get();
        // dd($cashable->toJson());
		return view(config('view.dashboard').'office.get.create')
                ->with('cashables',$cashable)
                ->with('bankAccounts',$bankAccounts);
        ;
	}

    public function store(StoreGetHelpRequest $req)
    {
        $gs = new GetHelpService;
        if ($gs->create($req->earnings, $req->bank_account)) {
            return redirect()->route(config('routes.prefix').'dashboard');
        }
        else{
            return back()->with('status' , "failed");
        }
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
