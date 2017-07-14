<?php

use App\Earning;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EarningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Earning::create([
        	'user_id' => 1000,
        	'earnable_id' => 1000,
        	'earnable_type' => 'App\ProvideHelp',
        	'description' => 'Initial System starter',
        	'initial_amount' => 2000000,
        	'current_amount' => 2000000,
        	'claimed_amount' => 0,
        	'growable' => false,
        	'frozen' => false,
        	'percentage' => 0,
        	'growth_end' => Carbon::now(),
        	'releasable' => Carbon::now(),
        	'expiry' => Carbon::now()->addMonth(),
    	]);
    }
}
