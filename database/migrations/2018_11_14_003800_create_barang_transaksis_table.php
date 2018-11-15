<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_transaksis', function (Blueprint $table) {
            $table->unsignedInteger('transaksi_id');
            $table->unsignedInteger('barang_id');
            $table->unsignedInteger('warna_id');
            $table->unsignedInteger('ukuran_id');
            
            $table->foreign('warna_id')
                ->references('id')->on('warnas');
            $table->foreign('ukuran_id')
                ->references('id')->on('ukurans');
            $table->foreign('transaksi_id')
                ->references('id')->on('transaksis');
            $table->foreign('barang_id')
                ->references('id')->on('barangs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_transaksis');
    }
}
