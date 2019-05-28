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
            $table->integer('province_id')->unsigned();
            $table->integer('schoolable_id')->unsigned()->default('0');
            $table->string('schoolable_type', 20);
            $table->string('name', 100);
            $table->integer('code_madrese')->unsigned();
            $table->integer('code_faza')->unsigned();
            $table->string('sale_tasis', 20);
            $table->string('doore', 1); //ebtedaei=0 motevasete1=1 motevasete2=2
            $table->integer('tedad_daneshamooz')->unsigned();
            $table->string('vaziat', 50); //m=mostaghel d$1=zamime darad (child id= 1) a$1=zamime ast (parent id= 1)
            $table->string('jensiat', 1); //b g a=mokhtalet
            $table->smallInteger('tedad_paye_tahsili')->unsigned();
            $table->mediumInteger('tedad_hamkaran')->unsigned();
            $table->string('noe_fazaye_amoozeshi');
            $table->mediumInteger('hooze_namayandegi_id')->unsigned();
            $table->integer('fasele_az_shahrestan')->unsigned();
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
        Schema::dropIfExists('schools');
    }
}
