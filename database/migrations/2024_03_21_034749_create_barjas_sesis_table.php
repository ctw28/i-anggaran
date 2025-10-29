<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarjasSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barjas_sesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('verifikator_id');
            $table->foreign('verifikator_id')->references('id')->on('verifikators');
            $table->unsignedBigInteger('barjas_template_id');
            $table->foreign('barjas_template_id')->references('id')->on('barjas_templates');
            $table->string('satker');
            $table->string('barjas_nama');
            $table->string('ppk');
            $table->string('pejabat_pengadaan');
            $table->string('rekanan');
            $table->string('metode');
            $table->date('tanggal_kontrak');
            $table->string('nilai');
            $table->string('kode_akun');
            $table->date('tanggal_periksa');
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
        Schema::dropIfExists('barjas_sesis');
    }
}
