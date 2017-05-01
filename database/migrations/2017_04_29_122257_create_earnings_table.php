<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->bigInteger('earnable_id');
            $table->string('earnable_type');
            $table->decimal('initial_amount',10,2);
            $table->decimal('current_amount',10,2);
            $table->decimal('claimed_amount',10,2)->default(0);
            $table->boolean('growable')->default(false);
            $table->boolean('frozen')->default(false);
            $table->decimal('percentage',5,2)->default(0);
            $table->dateTime('growth_end')->nullable();
            $table->dateTime('releasable')->nullable();
            $table->dateTime('expiry')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('earnings');
    }
}
