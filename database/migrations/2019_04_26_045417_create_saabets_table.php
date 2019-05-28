<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaabetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saabets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address', 150);

            $table->string('loc_yeylagh', 50);
            $table->string('address_gheshlagh', 150);
            $table->string('loc_gheshlagh', 50);
            $table->text('masire_kooch');
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
        Schema::dropIfExists('saabets');
    }
}
