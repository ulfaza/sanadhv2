<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTanggunganSmtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggungan_smt', function (Blueprint $table) {
            $table->increments('tg_id');
            $table->integer('ta_id')->unsigned();
            $table->integer('s_id')->unsigned()->nullable();
            $table->string('keuangan')->nullable(); 
            $table->string('ket_keu')->nullable();        
            $table->string('k_hijau')->nullable(); 
            $table->string('ket_k_h')->nullable(); 
            $table->string('paper')->nullable();
            $table->string('ket_ppr')->nullable(); 
            $table->string('kartu_aksi')->nullable();
            $table->string('ketuntasan')->nullable();
            $table->string('ujian')->nullable();
            $table->string('osis')->nullable();
            $table->string('da')->nullable();
            $table->string('pmr')->nullable();    
        });
        Schema::table('tanggungan_smt', function($table){
            $table->foreign('ta_id')
                ->references('ta_id')
                ->on('m_th_ajar')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('tanggungan_smt', function($table){
            $table->foreign('s_id')
                ->references('s_id')
                ->on('m_siswa')
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
        Schema::dropIfExists('tanggungan_smt');
    }
}
