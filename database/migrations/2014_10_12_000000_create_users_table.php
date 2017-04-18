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
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->integer('cred_score')->default(100);
            $table->boolean('activated')->default(false);
            $table->string('password');
            $table->integer('login_count')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('formalities')->default(0);
            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt');
            $table->uuid('parent_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
