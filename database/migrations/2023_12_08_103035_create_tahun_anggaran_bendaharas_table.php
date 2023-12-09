<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAnggaranBendaharasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_anggaran_bendaharas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_anggaran_id');
            $table->foreign('tahun_anggaran_id')->references('id')->on('tahun_anggarans');
            $table->unsignedBigInteger('pegawai_id'); //tetap simpan id pegawainya bendaharanya
            $table->foreign('pegawai_id')->references('id')->on('pegawais');
            $table->string('bendahara_nama'); //namanya tetap disimpan karena pegawai bisa gelarnya bertambah, jd tetap aman jika nanti berubah gelarnya
            // $table->string('bendahara_nip');
            $table->boolean('is_aktif')->default(true); //jika ada perubahan bendahara, ini jadi flagnya
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
        Schema::dropIfExists('tahun_anggaran_bendaharas');
    }
}
