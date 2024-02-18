<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekapKhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_kh', function (Blueprint $table) {
            $table->increments('r_id');
            $table->integer('uji_id')->unsigned();
            $table->integer('s_id')->unsigned()->nullable();
            $table->double('nilai_a1', 6, 2)->nullable();
            $table->double('nilai_a2', 6, 2)->nullable();
            $table->double('nilai_a3', 6, 2)->nullable();
            $table->double('nilai_a4', 6, 2)->nullable();
            $table->double('total', 6, 2)->nullable();
            $table->string('kriteria')->nullable(); 
            $table->string('nama_penguji')->nullable();            
        });
        Schema::table('rekap_kh', function($table){
            $table->foreign('uji_id')
                ->references('uji_id')
                ->on('uji_kh')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('rekap_kh', function($table){
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
        Schema::dropIfExists('rekap_kh');
    }
}
