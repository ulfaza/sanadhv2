<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUjiKhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uji_kh', function (Blueprint $table) {
            $table->increments('uji_id');
            $table->integer('kh_id')->unsigned();
            $table->string('penguji')->nullable();
            $table->string('penguji_laju')->nullable();
            $table->integer('k_id')->unsigned();
            $table->integer('ta_id')->unsigned();
        });
        Schema::table('uji_kh', function($table){
            $table->foreign('kh_id')
                ->references('kh_id')
                ->on('m_kh')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('uji_kh', function($table){
            $table->foreign('k_id')
                ->references('k_id')
                ->on('m_kelas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('uji_kh', function($table){
            $table->foreign('ta_id')
                ->references('ta_id')
                ->on('m_th_ajar')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uji_kh');
    }
}
