<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->bigIncrements('id_kelas');
            $table->unsignedBigInteger('id_kompetensi_keahlian');
            $table->string('nama_kelas', 30)->unique();
            $table->timestamps();

            $table->foreign('id_kompetensi_keahlian')->references('id_kompetensi_keahlian')->on('kompetensi_keahlian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
