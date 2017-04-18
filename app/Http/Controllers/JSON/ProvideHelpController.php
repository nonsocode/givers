<?php

namespace App\Http\Controllers\JSON;

use App\Config;
use App\Http\Controllers\Controller;
use App\ProvideHelp;
use Illuminate\Http\Request;

class ProvideHelpController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authorize = $this->check(\Auth::user());
        if (!$authorize->status) {
            return response()->json([
                'status'=>'fail',
                'message' => 'You can not provide Help at this time',
                'messages' => $authorize->messages,
            ]);
        }
        else{
            return [
                'status' => 'allowed',
                'limit' => (int) Config::val('ph_limit'),
            ];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \Auth::user();
        $this->validate($request,[
            'amount'=> 'required|numeric'
        ]);
        $amount = $request->amount;
        $old_amount = $user->latestPhAmount();
        if ($amount < $old_amount) {
            return ['status' => 'failed', 'message'=> "You cannot provide help less than your previous amount. Please provide help of $old_amount or more"];
        }
        elseif ($request->has('amount') ) {
            $ph = new ProvideHelp;
            $ph->amount = $request->amount;
            $ph->current_worth = $request->amount;
            $user = \Auth::user();
            $user->phs()->save($ph);
            $ph->owner = $user;

            return ['status' => 'success', 'ph' => $ph];
        }
        else{
            return ['status' => 'failed', 'message'=> 'Something went wrong. Try again later'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
