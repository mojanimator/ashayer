<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id')->unsigned()->default('1');
            $table->integer('schoolable_id')->unsigned()->default('0');
            $table->string('schoolable_type', 20);
            $table->boolean('is_roozane')->nullable();
            $table->string('name', 100);
            $table->integer('code_madrese')->unsigned();
            $table->integer('code_faza')->unsigned();
            $table->smallInteger('sale_tasis')->unsigned()->nullable()->default(null);
            $table->string('doore', 10); //ebtedaei=0 motevasete1=1 motevasete2=2
            $table->integer('tedad_daneshamooz')->unsigned();
            $table->string('vaziat', 50)->default("m"); //m=mostaghel d$1=zamime darad (child id= 1) a$1=zamime ast (parent id= 1)
            $table->string('jensiat', 1); //b g a=mokhtalet
            $table->smallInteger('tedad_paye_tahsili')->unsigned();
            $table->mediumInteger('tedad_hamkaran')->unsigned();
            $table->string('noe_fazaye_amoozeshi', 10); //'c', 's', 'k' chador sakhteman kaneks
            $table->integer('hooze_namayandegi_id')->unsigned();
            $table->integer('fasele_az_shahrestan')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('hooze_namayandegi_id')->references('id')->on('hoozes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
