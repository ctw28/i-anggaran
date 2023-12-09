<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenSesiBelanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_sesi_belanjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokumen_pencairan_sesi_id');
            $table->foreign('dokumen_pencairan_sesi_id')->references('id')->on('dokumen_pencairan_sesis');

            $table->string('npwp_nomor');
            $table->string('npwp_nama');
            $table->string('npwp_alamat');

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
        Schema::dropIfExists('dokumen_sesi_belanjas');
    }
}
