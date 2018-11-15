<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubkategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subkategoris', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('filename');
            $table->string('originalName');
            $table->timestamps();
        });

        Schema::create('kategoris_subkategoris', function (Blueprint $table) {
            $table->unsignedInteger('kategori_id');
            $table->unsignedInteger('subkategori_id');

            $table->foreign('kategori_id')
                ->references('id')->on('kategoris')
                ->onDelete('cascade');
            $table->foreign('subkategori_id')
                ->references('id')->on('subkategoris')
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
        Schema::dropIfExists('kategoris_subkategoris');
        Schema::dropIfExists('subkategoris');
    }
}
