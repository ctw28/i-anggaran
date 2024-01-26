<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarNominalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_nominals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokumen_pencairan_sesi_id');
            $table->foreign('dokumen_pencairan_sesi_id')->references('id')->on('dokumen_pencairan_sesis')->onDelete('cascade');;

            $table->string('pegawai_nomor_induk')->nullable();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('golongan');
            $table->integer('jumlah');
            $table->double('honor');
            $table->string('satuan');
            $table->double('total');
            $table->double('pph');
            $table->double('diterima');
            $table->string('no_rek')->default('Nomor Rekening');
            $table->string('bank')->default('Bank');
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
        Schema::dropIfExists('daftar_nominals');
    }
}
