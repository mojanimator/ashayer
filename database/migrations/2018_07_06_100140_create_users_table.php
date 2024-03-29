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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50);
            $table->string('email', 50);
            $table->string('phone_number', 50);
            $table->string('name', 50);
            $table->string('inline_role', 2)->nullable();
            $table->string('family', 100);
            $table->string('password', 255);
            $table->string('token')->nullable();
            $table->boolean('verified')->default(false);
//            $table->integer('role_id')->unsigned()->default(3); //default regular user
            $table->softDeletes();
            $table->rememberToken();
//            $table->string('created_at');
//            $table->string('updated_at');
            $table->dateTime('expires_at')->nullable()->default(null);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();


//            $table->foreign('role_id')->references('id')->on('roles');

//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('banner_types');
        Schema::dropIfExists('users');
    }
}
