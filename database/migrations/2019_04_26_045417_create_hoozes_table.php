<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoozesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoozes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('parent')->unsigned();
            $table->timestamps();

            $table->foreign('parent')->references('id')->on('hoozes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoozes');
    }
}
