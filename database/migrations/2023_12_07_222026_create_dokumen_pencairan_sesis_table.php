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
            $table->foreign('pelaksanaan_id')->references('id')->on('pelaksanaans')->onDelete('cascade');
            $table->unsignedBigInteger('pelaksanaan_dasar_id');
            $table->foreign('pelaksanaan_dasar_id')->references('id')->on('pelaksanaan_dasars')->onDelete('cascade');
            $table->unsignedBigInteger('kode_akun_id');
            $table->foreign('kode_akun_id')->references('id')->on('kode_akuns')->onDelete('cascade');

            $table->unsignedBigInteger('ppk')->nullable();
            $table->foreign('ppk')->references('id')->on('organisasi_jabatan_sesis')->onDelete('set null');
            $table->unsignedBigInteger('bendahara')->nullable();
            $table->foreign('bendahara')->references('id')->on('organisasi_jabatan_sesis')->onDelete('set null');
            //ini kombinasi dari nama kegiatan dan SK/ST dan lainnya
            $table->string('pencairan_nama');

            $table->date('tanggal_dokumen');
            $table->date('tanggal_lunas')->nullable();
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
