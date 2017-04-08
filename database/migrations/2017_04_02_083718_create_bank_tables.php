<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();          
            $table->timestamps();
        });
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_id');
            $table->uuid('bank_id');
            $table->string('account_name');
            $table->string('account_number',10)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('banks');
    }
}
