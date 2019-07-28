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
            $table->string('schoolable_type', 20)->nullable()->default(null);
            $table->boolean('is_roozane')->nullable()->default(true);
            $table->string('name', 100)->index();
            $table->integer('code_madrese')->unsigned()->nullable()->default(null);
            $table->integer('code_faza')->unsigned()->nullable()->default(null);
            $table->smallInteger('sale_tasis')->unsigned()->nullable()->default(null);
            $table->string('doore', 10)->nullable()->default(null); //ebtedaei=0 motevasete1=1 motevasete2=2
            $table->integer('tedad_daneshamooz')->unsigned()->nullable()->default(null);
            $table->string('vaziat', 50)->nullable()->default(null); //m=mostaghel d$1=zamime darad (child id= 1) a$1=zamime ast (parent id= 1)
            $table->string('jensiat', 1)->nullable()->default(null); //b g a=mokhtalet
            $table->smallInteger('tedad_paye_tahsili')->unsigned()->nullable()->default(null);
            $table->mediumInteger('tedad_hamkaran')->unsigned()->nullable()->default(null);
            $table->string('noe_fazaye_amoozeshi', 10)->nullable()->default(null); //'c', 's', 'k' chador sakhteman kaneks
            $table->integer('hooze_namayandegi_id')->unsigned()->nullable()->default(null)->index();;

            $table->timestamp('created_at');
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
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
