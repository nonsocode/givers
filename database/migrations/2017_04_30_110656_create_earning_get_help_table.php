<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEarningGetHelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earning_get_help', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('earning_id');
            $table->bigInteger('get_help_id');
            $table->decimal('amount',10,2);
            $table->timestamps();
            $table->unique(['earning_id','get_help_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('earning_get_help');
    }
}
