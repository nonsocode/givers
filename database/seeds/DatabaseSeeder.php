<?php

use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        $this->call('UserSeeder');
        $this->call('ConfigSeeder');
        $this->call('BankSeeder');
        $this->call('PhoneSeeder');
        $this->call('SupportCategory');
        $this->call('Ticket');
        $this->call('ProvideHelpSeeder');
        $this->call('EarningSeeder');

        Model::reguard();
    }
}
