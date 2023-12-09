<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAnggaranDipasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_anggaran_dipas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_anggaran_id');
            $table->foreign('tahun_anggaran_id')->references('id')->on('tahun_anggarans');
            $table->date('dipa_tgl');
            $table->string('dipa_nomor', 100);
            $table->double('dipa_pagu');
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
        Schema::dropIfExists('tahun_anggaran_dipas');
    }
}
