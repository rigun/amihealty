<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('originalName');
            $table->string('slug')->unique();
            $table->string('nama');
            $table->unsignedInteger('id_pemilik');
            $table->text('deskripsi');
            $table->double('berat');
            $table->double('harga')->nullable();
            $table->integer('stok')->default(0);
            $table->timestamps();

            $table->foreign('id_pemilik')
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
        Schema::dropIfExists('barangs');
    }
}
