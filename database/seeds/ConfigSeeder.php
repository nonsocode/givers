<?php

use App\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::create([
            'name'=> 'ph_max',
            'value' => '2000000'
        ]);
        Config::create([
            'name'=> 'ph_daily_growth',
            'value' => '1.71'
        ]);
        Config::create([
            'name'=>  'ph_limit',
            'value' => '5',
        ]);
        Config::create([
            'name'=> 'gh_max',
            'value' => '500000'
        ]);
        Config::create([
            'name'=>  'gh_limit',
            'value' => '5',
        ]);
    }
}
