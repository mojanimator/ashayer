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
            $table->string('address', 150)->nullable()->default('نامشخص');
            $table->string('loc', 50)->nullable()->default(null);
            $table->integer('fasele_az_shahrestan')->unsigned()->nullable()->default(null);
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
        Schema::dropIfExists('saabets');
    }
}
