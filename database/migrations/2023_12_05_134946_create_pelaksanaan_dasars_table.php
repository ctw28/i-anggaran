<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaksanaanDasarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaksanaan_dasars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelaksanaan_id');
            $table->foreign('pelaksanaan_id')->references('id')->on('pelaksanaans');
            $table->enum('jenis_data', ['sk', 'st', 'rab', 'tor']);
            // $table->string('flag');
            $table->string('nomor')->nullable();
            $table->date('tanggal');
            $table->string('path_file');
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
        Schema::dropIfExists('pelaksanaan_dasars');
    }
}
