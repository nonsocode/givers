<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePasswordRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    	$data['headerText'] = 'Profile';
    	$data['user'] = \Auth::user()->load(['phones','bankAccounts.bank']);
    	return view(config('view.dashboard').'office.profile.index',$data);
    }

    public function password(ProfilePasswordRequest $req)
    {
    	$user = \Auth::user();
    	if ($user->update(['password'=>$req->new_password])) {
    		return response()->json([
    			'status'=> 'success',
    			'message' => 'Your password was updated successfully',
    		]);
    	}
    	else{
    		return response()->json([
    			'status'=> 'failed',
    			'message' => 'Your password was updated successfully',
    		]);
    	}
    }
}
