<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper', function (Blueprint $table) {
            $table->increments('p_id');
            $table->integer('siswa_s_id')->unsigned()->nullable();
            $table->string('judul')->nullable(); 
            $table->string('rumusan')->nullable();        
            $table->string('asesor')->nullable(); 
            $table->string('pembimbing')->nullable(); 
            $table->string('status_paper')->nullable();
            $table->string('bimbingan')->nullable();
            $table->date('tgl_ujian')->nullable();
            $table->string('penguji1')->nullable();
            $table->string('penguji2')->nullable();
            $table->double('penguasaan', 6, 2)->nullable();
            $table->double('sinkron', 6, 2)->nullable();
            $table->double('penulisan', 6, 2)->nullable();
            $table->double('adab', 6, 2)->nullable();
            $table->double('nilai', 6, 2)->nullable();
            $table->string('predikat')->nullable();
            $table->string('catatan')->nullable(); 
            $table->string('berkas')->nullable();  
            $table->string('jilid')->nullable();
            $table->string('ambil')->nullable(); 
            $table->string('nama_pengambil')->nullable();  
        });
        Schema::table('paper', function($table){
            $table->foreign('siswa_s_id')
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
        Schema::dropIfExists('paper');
    }
}
