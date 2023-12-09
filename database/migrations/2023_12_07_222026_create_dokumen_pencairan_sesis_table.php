<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenPencairanSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_pencairan_sesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelaksanaan_id');
            $table->foreign('pelaksanaan_id')->references('id')->on('pelaksanaans');
            //ini kombinasi dari nama kegiatan dan SK/ST dan lainnya
            $table->string('dokumen_pencairan_nama');

            $table->date('tanggal_dokumen');
            $table->date('tanggal_lunas');
            $table->string('penerima_nama');
            $table->string('penerima_jabatan');
            $table->string('penerima_nomor')->nullable();
            $table->string('kuitansi_nomor');
            $table->string('sptjb_nomor');
            // $table->string('no_bukti');
            //SPTJK penanggung jawab kegiatan
            $table->string('sptjk_nama');
            $table->string('sptjk_nip');
            $table->string('sptjk_jabatan');

            $table->boolean('is_selesai')->default(false);
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
        Schema::dropIfExists('dokumen_pencairan_sesis');
    }
}
