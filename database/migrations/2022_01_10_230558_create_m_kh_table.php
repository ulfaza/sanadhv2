<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMKhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_kh', function (Blueprint $table) {
            $table->increments('kh_id');   
            $table->string('kh_nama');
            $table->string('singkatan');                     
            $table->integer('kkm');
            $table->string('aspek1');
            $table->string('aspek2');
            $table->string('aspek3');
            $table->string('aspek4');
            $table->double('max_a1', 6, 2);
            $table->double('max_a2', 6, 2);
            $table->double('max_a3', 6, 2);
            $table->double('max_a4', 6, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_kh');
    }
}
