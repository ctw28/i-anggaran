<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaKategoriListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_kategori_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_kategori_id');
            $table->foreign('periksa_kategori_id')->references('id')->on('periksa_kategoris');
            $table->unsignedBigInteger('periksa_list_id');
            $table->foreign('periksa_list_id')->references('id')->on('periksa_lists');
            $table->string('item');
            $table->integer('urutan');

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
        Schema::dropIfExists('periksa_kategori_lists');
    }
}
