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
            $table->bigIncrements('id');
            $table->bigInteger('provide_help_id');
            $table->bigInteger('get_help_id');
            $table->boolean('gher_confirm')->default(0);
            $table->string('pher_confirm')->nullable();
            $table->decimal('amount',10,2);
            $table->datetime('expiry');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::update("ALTER TABLE pairings AUTO_INCREMENT = 1000;");
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
