<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
        'parent_id' => 0,
        'formalities' => true,
        'activated' => true,
        'password' => 'access',
        'remember_token' => str_random(10),
        '_lft' => 0,
        '_rgt' => 0,
        ]);
        User::create([
        'first_name' => 'Super',
        'last_name' => 'admin',
        'email' => 'superadmin@givers.app',
        'parent_id' => 0,
        'formalities' => true,
        'activated' => true,
        'password' => 'access',
        'remember_token' => str_random(10),
        '_lft' => 0,
        '_rgt' => 0,
        ]);
    }
}
