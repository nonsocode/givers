<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->integer('cred_score')->default(100);
            $table->boolean('activated')->default(false);
            $table->string('password');
            $table->integer('login_count')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('formalities')->default(0);
            $table->unsignedBigInteger('_lft');
            $table->unsignedBigInteger('_rgt');
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('guider_id')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        DB::update("ALTER TABLE users AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
