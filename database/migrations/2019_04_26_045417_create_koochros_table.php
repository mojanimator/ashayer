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
            $table->string('type', 1)->nullable()->default('-'); //s=sayyar n=nime sayyar
            $table->string('address_yeylagh', 150)->nullable()->default('نامشخص');
            $table->string('loc_yeylagh', 50)->nullable()->default(null);
            $table->integer('fasele_az_shahrestan_yeylagh')->unsigned()->nullable()->default(null);

            $table->string('address_gheshlagh', 150)->nullable()->default('نامشخص');
            $table->string('loc_gheshlagh', 50)->nullable()->default(null);
            $table->integer('fasele_az_shahrestan_gheshlagh')->unsigned()->nullable()->default(null);

            $table->text('masire_kooch')->nullable()->default(null);
            $table->integer('masafate_kooch')->unsigned()->nullable()->default(null);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
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
