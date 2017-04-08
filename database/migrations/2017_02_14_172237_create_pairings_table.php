<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePairingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('provide_help_id');
            $table->uuid('get_help_id');
            $table->boolean('gher_confirm')->default(0);
            $table->float('amount',10,2);
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
        Schema::dropIfExists('pairings');
    }
}
