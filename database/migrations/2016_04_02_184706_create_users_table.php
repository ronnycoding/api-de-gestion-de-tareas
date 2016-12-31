<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("last_name");
            $table->string("company_name");
            $table->string("email");
            $table->string("password");
            $table->timestamps();

            $table->softDeletes();

            $table->unique("email");
            $table->index(['email', 'password']);

        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
