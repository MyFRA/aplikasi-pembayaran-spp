<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pembayaran', function (Blueprint $table) {
            $table->string('id_log_pembayaran', 30);
            $table->string('id_pembayaran', 30);
            $table->unsignedBigInteger('id_petugas');
            $table->date('tgl_bayar');
            $table->integer('jumlah_bayar');
            $table->timestamps();

            $table->foreign('id_pembayaran')->references('id_pembayaran')->on('pembayaran');
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas');
            $table->primary('id_log_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_pembayaran');
    }
}
