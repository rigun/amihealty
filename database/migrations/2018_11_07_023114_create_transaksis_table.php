<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_pembeli');
            $table->double('totalPembelian');
            $table->text('alamatTujuan');
            $table->dateTime('tanggalPembelian');
            $table->dateTime('tanggalPembayaran')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('id_pembeli')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
