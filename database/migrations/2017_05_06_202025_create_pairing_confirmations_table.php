<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePairingConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairing_confirmations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pairing_id');
            $table->string('url');
            $table->dateTime('pher_stamp');
            $table->dateTime('fake')->nullable();
            $table->dateTime('gher_confirm')->nullable();
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
        Schema::dropIfExists('pairing_confirmations');
    }
}
