<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->char('nisn', 10);
            $table->unsignedBigInteger('id_kelas');
            $table->char('nis', 8);
            $table->string('nama', 50);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('no_telp', 16);
            $table->string('photo')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();

            $table->primary('nisn');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
