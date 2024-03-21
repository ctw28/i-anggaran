<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaBarjasListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_barjas_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_barjas_kategori_id');
            $table->foreign('periksa_barjas_kategori_id')->references('id')->on('periksa_barjas_kategoris');
            $table->string('nama_dokumen');
            $table->text('keterangan)')->nullable();
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
        Schema::dropIfExists('periksa_barjas_lists');
    }
}
