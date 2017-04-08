<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register')->with('request', request());
    }


    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function register(Request $request)
        {
            $this->validator($request->all())->validate();
            $user = $this->create($request->all());
            event(new Registered($user,$this->activator));

        // $this->guard()->login($user);

            return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
        }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        session()->flash('info' ,'You registered successfully. An email has been sent to you. please follow the link to activate your account');
        return redirect()->route('login');
    }

    
    public function activateUser($token)
    {
        if ($user = $this->activator->activateUser($token)) {
            // auth()->login($user);
            session()->flash('success',"You've successfully activated your account. You may now login");
            return redirect()->route('login')->withInput(['email',$user->email]);
        }
        abort(404);
    }

    public function resendForm()
    {
        return view('auth.resend');
    }

    public function resendToken(Request $req)
    {
        Validator::make($req->only('email'),
            ['email'=>'email|exists:users,email'],
            [
                'email.email'=>'Please enter a valid email',
                'email.exists' => 'There is no record of this email address. Please check and try again',
            ])->validate();

        $user = User::where('email', $req->email)->first();
        if ($user && !$user->activated) {
            $this->activator->sendActivationMail($user);
            return redirect()->route('login')->with('info', 'An activation token was sent to your email address. Follow the link to ativate your account');
        }
        elseif ($user && $user->activated) {
            return redirect()->back()->with('info','Your account has already been activated.');
        }
        else{
            return redirect()->back()->with('failed','This is not a valid user email');
        }
    }
}
