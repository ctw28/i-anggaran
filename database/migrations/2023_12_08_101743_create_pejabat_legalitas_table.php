<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePejabatLegalitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pejabat_legalitas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('organisasi_jabatan_sesi_id');
            $table->foreign('organisasi_jabatan_sesi_id')->references('id')->on('organisasi_jabatan_sesis');
            $table->string('sk_nomor')->nullable();
            $table->string('sk_tanggal')->nullable();
            $table->string('sk_file')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
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
        Schema::dropIfExists('pejabat_legalitas');
    }
}
