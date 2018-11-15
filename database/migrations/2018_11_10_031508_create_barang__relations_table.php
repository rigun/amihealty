<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang__relations', function (Blueprint $table) {
            $table->unsignedInteger('barang_id');
            $table->unsignedInteger('kategori_id');
            $table->unsignedInteger('subkategori_id');

            $table->timestamps();

            $table->foreign('barang_id')
                ->references('id')->on('barangs')
                ->onDelete('cascade');
            $table->foreign('kategori_id')
                ->references('id')->on('kategoris')
                ->onDelete('cascade');
            $table->foreign('subkategori_id')
                ->references('id')->on('subkategoris')
                ->onDelete('cascade');
        });
       
        Schema::create('barang_warna', function (Blueprint $table) {
            $table->unsignedInteger('warna_id');
            $table->unsignedInteger('barang_id');
            
            $table->foreign('warna_id')
                ->references('id')->on('warnas')
                ->onDelete('cascade');
            $table->foreign('barang_id')
                ->references('id')->on('barangs')
                ->onDelete('cascade');
        });
        Schema::create('barang_ukuran', function (Blueprint $table) {
            $table->unsignedInteger('ukuran_id');
            $table->unsignedInteger('barang_id');
            
            $table->foreign('ukuran_id')
                ->references('id')->on('ukurans')
                ->onDelete('cascade');
            $table->foreign('barang_id')
                ->references('id')->on('barangs')
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
        Schema::dropIfExists('barang_ukuran');
        Schema::dropIfExists('barang_warna');
        Schema::dropIfExists('barang__relations');
    }
}
