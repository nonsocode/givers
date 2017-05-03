<?php

namespace App\Http\Controllers;

use App\Config as Conf;
use App\ProvideHelp;
use App\Services\ProvideHelpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvideHelpController extends Controller
{
    public function create()
    {
        $ps = new ProvideHelpService;
		return view(config('view.dashboard').'office.provide.create',['min' => $ps->leastAcceptableAmount()]);	
    }

    public function delete(ProvideHelp $ph)
    {
        if (Auth::user()->can('delete',$ph)){
            $phService = new ProvideHelpService;
            if($phService->delete($ph)){
                return response()->json(['status' => 'success'],200);
            }
        }
        return response()->json(['status' => 'fail'],200);
    }

    public function store(Request $request)
    {
        $phService = new ProvideHelpService(Auth::user());
        $this->validate($request,[
            'amount'=> 'required|numeric|min:'.$phService->leastAcceptableAmount(),
        ]);

        if (!$phService->amountSufficient($request->amount)) {
            $lt = $phService->prettyLatestAmount();
            return back()->with('fail',"You cannot provide help less than your previous amount. Please provide help of $lt or more");
        }
        elseif (Auth::user()->phs()->incomplete()->count() >= Conf::val('ph_limit')) {
            return back()->with('fail',"You too many Incomplete Provide Help requests. Please wait till they are completed before attempting to create another one");
        }
        else{
            $phService->create($request->amount,['percentage'=>Conf::val('ph_daily_growth')]);
            $alert = [
                'type' => 'success',
                'message' => 'Your request to provide help was successful',
            ];
            return redirect()->route(config('routes.prefix').'dashboard')->with('alert',$alert);
        }
    }

    public function check($user){
        $errors = [];
        $profile = route('profile');
        if(!$user->primaryPhone()->count()) $errors[] = "You need to specify a phone number in your <a href='$profile'>Profile</a>  page";
        if(!$user->bankAccounts()->count()) $errors[] = "You need to specify a bank account in your <a href='$profile'>Profile</a> page first";
        if(!$user->status == 1)             $errors[] = 'Your account haas been deactivated';
        $answer = [
            'status' => !count($errors),
            'messages' => $errors,
        ];
        return (object) $answer;
    }

}
