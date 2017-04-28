<?php

namespace App\Http\Controllers;

use App\ProvideHelp;
use Illuminate\Http\Request;

class ProvideHelpController extends Controller
{
    public function create()
    {
		return view(config('view.dashboard').'office.provide.create');	
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        $this->validate($request,[
            'amount'=> 'required|numeric'
        ]);
        $amount = $request->amount;
        $old_amount = $user->latestPhAmount();
        if ($amount < $old_amount) {
            return back()->with('fail',"You cannot provide help less than your previous amount. Please provide help of $old_amount or more");
        }
        else{
            $ph = new ProvideHelp;
            $ph->amount = $request->amount;
            $ph->current_worth = $request->amount;
            $user = \Auth::user();
            $user->phs()->save($ph);
            $ph->owner = $user;
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
