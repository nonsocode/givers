<?php

use App\Bank;
use App\BankAccount;
use App\User;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
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

    	Bank::create(['name' => 'Access Bank']);
    	Bank::create(['name' => 'Citibank']);
    	Bank::create(['name' => 'Diamond Bank']);
    	Bank::create(['name' => 'Dynamic Standard Bank']);
    	Bank::create(['name' => 'Ecobank Nigeria']);
    	Bank::create(['name' => 'Fidelity Bank Nigeria']);
    	Bank::create(['name' => 'First Bank of Nigeria']);
    	Bank::create(['name' => 'First City Monument Bank']);
    	Bank::create(['name' => 'Guaranty Trust Bank']);
    	Bank::create(['name' => 'Heritage Bank plc']);
    	Bank::create(['name' => 'Keystone Bank Limited']);
    	Bank::create(['name' => 'Providus Bank plc ']);
    	Bank::create(['name' => 'Skye Bank']);
    	Bank::create(['name' => 'Stanbic IBTC Bank Nigeria Limited']);
    	Bank::create(['name' => 'Standard Chartered Bank']);
    	Bank::create(['name' => 'Sterling Bank']);
    	Bank::create(['name' => 'Suntrust Bank Nigeria Limited']);
    	Bank::create(['name' => 'Union Bank of Nigeria']);
    	Bank::create(['name' => 'United Bank for Africa']);
    	Bank::create(['name' => 'Unity Bank plc']);
    	Bank::create(['name' => 'Wema Bank']);
    	Bank::create(['name' => 'Zenith Bank']);

        BankAccount::create([
            'name'    => 'Chinonso Chukwuogor Obiora',
            'number'  => '6172235393',
            'primary' => true,
            'user_id' => 1000,
            'bank_id' => 6,
        ]);
        BankAccount::create([
            'name'    => 'Supper admin man',
            'number'  => '0393944828',
            'primary' => true,
            'bank_id' => 3,
            'user_id' => 1001,
        ]);
    }
}
