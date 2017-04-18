<?php

namespace App\Http\Controllers\Auth;

use App\Factories\UserActivation;
use App\Http\Controllers\Controller;
use App\Referral;
use App\Traits\RegistersUsers;
use App\User;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    public $activator;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserActivation $a)
    {
        $this->middleware('guest');
        $this->activator = $a;
        // dd($a);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|min:11|numeric|unique:phones,number',
            'referrer' => 'email|nullable|different:email|exists:users,email',
            'bank' => 'exists:banks,name',
            'bank_account.name' => 'required',
            'bank_account.number' => 'required|numeric',
            ],[
            'email.unique' => "A user with this email already exists. You can login <a href='/login/?email={$data['email']}'>here</a>",
            'phone.min' =>'Phone number is too short',
            'referrer.different' => "You can\'t refer yourself",
            'bank_account.number' => "The Account number provided is not correct",
            ]);
    }

    /**
     * Check if the this refferal is valid
     * @return bool
     */
    protected function validateReferral()
    {
        if (!Referral::where('baby_email' ,request()->refferal)->count() && User::where('email', $request)) {
            $ref->baby_email;
        }

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if (request()->has('referrer')){
            $papa = User::where('email',$data['referrer'])->first();
            return $papa->children()->create($data);
        }
        else {
            return User::where('email','superadmin@givers.app')->first()->children()->create($data);
        }
    }
}
