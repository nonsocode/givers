<?php

use App\Phone;
use App\User;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$u1 = User::first()->id;
    	$u2 = User::latest()->first()->id;

        Phone::create([
        	'number'	=> '07012903451',
        	'user_id'	=> 1000,
        	'primary'	=> true,
    	]);
        Phone::create([
            'number'    => '07048938283',
            'user_id'   =>  1001,
            'primary'   =>  true,
        ]);
        Phone::create([
        	'number'	=> '08035842254',
        	'user_id'	=>	1002,
        	'primary'	=>  true,
    	]);
    }
}
