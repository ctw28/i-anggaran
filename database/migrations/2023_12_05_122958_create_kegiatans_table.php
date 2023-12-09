<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tahun_anggaran_id');
            $table->foreign('tahun_anggaran_id')->references('id')->on('tahun_anggarans');

            $table->unsignedBigInteger('organisasi_id');
            $table->foreign('organisasi_id')->references('id')->on('organisasis');

            //untuk kalau mau masukkan detail
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('kegiatans');
            $table->unsignedBigInteger('kode_akun_id')->nullable();
            $table->foreign('kode_akun_id')->references('id')->on('kode_akuns');

            //contoh sub kegiatan 2132.BGC.002.051.ME, dipecah, bisa kosong untuk untuk detail kegiatan
            $table->string('sub_kegiatan_kode1')->nullable(); //2132
            $table->string('sub_kegiatan_kode2')->nullable(); //BGC
            $table->string('sub_kegiatan_kode3')->nullable(); //002
            $table->string('sub_kegiatan_kode4')->nullable(); //051
            $table->string('sub_kegiatan_kode5')->nullable(); //ME

            $table->string('kegiatan_nama');
            $table->double('volume')->nullable();
            $table->double('satuan')->nullable();
            $table->double('jumlah_biaya');

            $table->double('sumber_dana')->nullable(); //RM atau PNBP


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
        Schema::dropIfExists('kegiatans');
    }
}
