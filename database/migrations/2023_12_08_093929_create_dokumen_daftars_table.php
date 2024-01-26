<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenDaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_daftars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokumen_pencairan_sesi_id');
            $table->foreign('dokumen_pencairan_sesi_id')->references('id')->on('dokumen_pencairan_sesis')->onDelete('cascade');;

            $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->foreign('pegawai_id')->references('id')->on('pegawais');

            $table->string('nama');
            $table->string('jabatan');
            $table->string('golongan');
            $table->string('no_rek')->nullable();
            $table->string('bank')->nullable();
            $table->double('harga');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->double('total');
            $table->double('pph');
            $table->double('diterima');
            $table->smallInteger('urutan');
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
        Schema::dropIfExists('dokumen_daftars');
    }
}
