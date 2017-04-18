<?php

use App\SupportCategory as Category;
use Illuminate\Database\Seeder;

class SupportCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'PH Issues']);
        Category::create(['name' => 'GH Issues']);
        Category::create(['name' => 'Account Suspended']);
        Category::create(['name' => 'Others']);
    }
}
