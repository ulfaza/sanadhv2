<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUjiPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uji_paper', function (Blueprint $table) {
            $table->increments('up_id');
            $table->string('tahun_ajar')->nullable(); 
            $table->string('gel')->nullable(); 
            $table->date('tgl')->nullable();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uji_paper');
    }
}
