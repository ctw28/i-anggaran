<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaksanaanDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaksanaan_dokumens', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pelaksanaan_id');
            $table->foreign('pelaksanaan_id')->references('id')->on('pelaksanaans');
            // $table->string('flag');
            $table->string('nama_dokumen');
            $table->string('file_path');
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
        Schema::dropIfExists('pelaksanaan_dokumens');
    }
}
