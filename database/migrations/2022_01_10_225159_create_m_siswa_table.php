<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_siswa', function (Blueprint $table) {
            $table->increments('s_id')->unique();                        
            $table->integer('k_id')->unsigned();
            $table->string('nis')->unique();
            $table->string('nisn')->unique()->nullable();
            $table->string('s_nama');
            $table->string('status');
            $table->string('transkrip_kh')->nullable(); 
            $table->string('th_lulus')->nullable(); 
            $table->string('alamat')->nullable(); 
            $table->string('status_lulus')->nullable(); 
            $table->string('tg_keuangan')->nullable(); 
            $table->string('ket_keuangan')->nullable(); 
            $table->string('tg_pondok')->nullable(); 
            $table->string('ket_pondok')->nullable(); 
            $table->string('tg_kh')->nullable(); 
            $table->string('ket_kh')->nullable(); 
            $table->string('tg_dzikrul')->nullable(); 
            $table->string('ket_dzikrul')->nullable(); 
            $table->string('tg_paper')->nullable(); 
            $table->string('ket_paper')->nullable(); 
            $table->string('tg_perpus')->nullable(); 
            $table->string('ket_perpus')->nullable(); 
            $table->string('status_ijazah')->nullable(); 
        });
        Schema::table('m_siswa', function($table){
            $table->foreign('k_id')
                ->references('k_id')
                ->on('m_kelas')
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
        Schema::dropIfExists('m_siswa');
    }
}
