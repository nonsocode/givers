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
            'name'=>  'ph_limit',
            'value' => '500000'
        ]);
        Config::create([
            'name'=> 'ph_max',
            'value' => '5',
        ]);
        Config::create([
            'name'=>  'gh_limit',
            'value' => '500000'
        ]);
        Config::create([
            'name'=> 'gh_max',
            'value' => '5',
        ]);
        Config::create([
            'name'=> 'gh_weekday_expiry',
            'value' => '172800',
        ]);
        Config::create([
            'name'=> 'gh_weekend_expiry',
            'value' => '259200',
        ]);
    }
}
