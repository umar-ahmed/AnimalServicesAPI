<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('code')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('dog_user', function (Blueprint $table) {

            // Create user key and if the entry is deleted on the users table, delete the entry here
            $table->integer('user_id')->unsigned()->index();
            $table->integer('dog_id')->unsigned()->index();
            $table->primary(['dog_id', 'user_id'], 'dog_user');
                        
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
        Schema::dropIfExists('dog_user');
    }
}
