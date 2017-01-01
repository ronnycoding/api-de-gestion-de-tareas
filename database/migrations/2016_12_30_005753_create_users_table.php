<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users',function(Blueprint $table)
        {
	        $table->increments('id');
	        $table->string('firstname');
	        $table->string('lastname');
	        $table->string('email');
	        $table->string('password');
	        $table->boolean('admin');
	        $table->timestamps();

	        $table->softDeletes();

	        $table->unique('email');
	        $table->index(['email', 'password']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExist('users');
    }
}
