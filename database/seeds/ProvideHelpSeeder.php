<?php

use App\ProvideHelp;
use Illuminate\Database\Seeder;

class ProvideHelpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProvideHelp::create([
        	'user_id' => 1000,
        	'amount' => 2000000,
        	'amount_matched' => 2000000,
        	'status' => 4,
    	]);
    }
}
