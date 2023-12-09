<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisasiJabatanSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisasi_jabatan_sesis', function (Blueprint $table) {
            $table->id();
            //tahun anggaran kapan
            $table->unsignedBigInteger('tahun_anggaran_id');
            $table->foreign('tahun_anggaran_id')->references('id')->on('tahun_anggarans');
            //organisasinya apa
            $table->unsignedBigInteger('organisasi_id');
            $table->foreign('organisasi_id')->references('id')->on('organisasis');
            //jabatannya apa
            $table->unsignedBigInteger('organisasi_jabatan_id');
            $table->foreign('organisasi_jabatan_id')->references('id')->on('organisasi_jabatans');
            //nginduk ke jabatan mana, untuk keperluan struktur organisasi
            $table->unsignedBigInteger('jabatan_parent_sesi')->nullable();
            $table->foreign('jabatan_parent_sesi')->references('id')->on('organisasi_jabatan_sesis');
            //siapa pegawainya
            $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->foreign('pegawai_id')->references('id')->on('pegawais');

            $table->string('nama_pejabat', 100);
            $table->string('jabatan_sesi_nama', 100);
            $table->string('jabatan_sesi_singkatan', 20);
            $table->integer('jabatan_urutan'); //urutan mana lebih tinggi jabatannya
            $table->string('jabatan_keterangan', 200)->nullable();
            $table->boolean('is_aktif')->default(true);

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
        Schema::dropIfExists('organisasi_jabatan_sesis');
    }
}
