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
        	'user_id'	=> $u1,
        	'primary'	=> true,
    	]);
        Phone::create([
        	'number'	=>	'33234432334',
        	'user_id'	=>	$u2,
        	'primary'	=>  true,
    	]);
    }
}
