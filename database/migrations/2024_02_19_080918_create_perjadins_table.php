<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjadinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pencairan_id');
            $table->foreign('pencairan_id')->references('id')->on('pencairans')->onDelete('cascade');
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('kota_tujuan');
            $table->date('tanggal_dokumen');
            $table->string('no_surat_tugas');
            $table->date('tanggal_surat_tugas');

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
        Schema::dropIfExists('perjadins');
    }
}
