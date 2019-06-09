<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKoochrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koochros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 1); //s=sayyar n=nime sayyar
            $table->string('address_yeylagh', 150);
            $table->string('loc_yeylagh', 50);
            $table->string('address_gheshlagh', 150);
            $table->string('loc_gheshlagh', 50);
            $table->text('masire_kooch');
            $table->integer('masafate_kooch')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('koochros');
    }
}
