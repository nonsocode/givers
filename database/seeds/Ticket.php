<?php

use App\Ticket as Tick;
use App\User;
use Illuminate\Database\Seeder;

class Ticket extends Seeder
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
        Tick::create([
        	'support_category_id' => 1,
        	'user_id' 	=>  $u1,
        	'title'		=> "I'm unable to provide Help",
        	'priority'	=> "medium",
    	]);
        Tick::create([
        	'support_category_id' => 1,
        	'user_id' 	=>  $u1,
        	'title'		=> "I'm unable to provide Help",
        	'priority'	=> "medium",
    	]);
        Tick::create([
        	'support_category_id' => 2,
        	'user_id' 	=>  $u2,
        	'title'		=> "Everything is just good",
        	'priority'	=> "medium",
    	]);
    }
}
