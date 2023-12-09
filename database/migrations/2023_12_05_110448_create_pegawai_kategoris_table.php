<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('pegawai_kategori_nama');
            $table->string('singkatan');
            $table->string('sebutan_nomor_pegawai');
            $table->boolean('is_asn');
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
        Schema::dropIfExists('pegawai_kategoris');
    }
}
