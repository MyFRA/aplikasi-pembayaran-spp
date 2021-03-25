<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('id_pembayaran', 30);
            $table->char('nisn', 10);
            $table->unsignedBigInteger('id_spp');
            $table->enum('bulan_spp', ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agusutus', 'September', 'Oktober', 'November', 'Desember']);
            $table->integer('total_bayar');
            $table->enum('status', ['Lunas', 'Belum Lunas']);
            $table->timestamps();

            $table->foreign('nisn')->references('nisn')->on('siswa');
            $table->foreign('id_spp')->references('id_spp')->on('spp');
            $table->primary('id_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
