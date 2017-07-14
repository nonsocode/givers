<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvideHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provide_helps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->decimal('amount',10,2);
<<<<<<< HEAD
            $table->decimal('amount_paid',10,2)->default(0);
            $table->decimal('current_worth',10,2)->default(0);
            $table->tinyInteger('status')->default(0);
            $table->datetime('unfreezes')->nullable();
=======
            $table->decimal('amount_matched',10,2)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('very_first')->default(0);
            $table->boolean('urgent')->default(false);
>>>>>>> redesign
            $table->softDeletes();
            $table->timestamps();
        });
        DB::update("ALTER TABLE provide_helps AUTO_INCREMENT = 1000;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provide_helps');
    }
}
