<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
        });
        Schema::create('bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_id');
            $table->integer('bonus_type_id')->nullable();
            $table->decimal('amount',10,2);
            $table->decimal('claimed',10,2)->default(0);
            $table->datetime('unfreezes')->nullable();
            $table->datetime('date_claimed')->nullabele();
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
        Schema::dropIfExists('bonuses');
        Schema::dropIfExists('bonus_types');
    }
}
