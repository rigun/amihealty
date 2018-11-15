<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('barang_id');
            $table->integer('warna_id')->nullable()->unsigned();
            $table->integer('ukuran_id')->nullable()->unsigned();
            $table->unsignedInteger('pemilik_id');
            $table->integer('status');
            $table->integer('jumlah');
            $table->double('harga');

            $table->foreign('pemilik_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
       
            $table->foreign('barang_id')
                ->references('id')->on('barangs')
                ->onDelete('cascade');
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
        Schema::dropIfExists('bags');
    }
}
