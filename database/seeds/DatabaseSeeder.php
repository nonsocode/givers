<?php

use App\Config;
use App\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'first_name' => 'Chinonso',
        'last_name' => 'Chukwuogor',
        'email' => 'nonso4yoo@gmail.com',
        // 'phone' => '07012903451',
        'parent_id' => 0,
        'password' => bcrypt('access'),
        'remember_token' => str_random(10),
        '_lft' => 0,
        '_rgt' => 0,
        ]);
        User::create([
        'first_name' => 'Super',
        'last_name' => 'admin',
        // 'phone' => '07039841303',
        'email' => 'superadmin@givers.app',
        'parent_id' => 0,
        'password' => bcrypt('access'),
        'remember_token' => str_random(10),
        '_lft' => 0,
        '_rgt' => 0,
        ]);
    	factory(User::class,50)->create();
        // $this->call(UsersTableSeeder::class);
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
