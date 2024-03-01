<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjadinRinciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadin_rincians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perjadin_id');
            $table->foreign('perjadin_id')->references('id')->on('perjadins');
            $table->unsignedBigInteger('perjadin_anggota_id');
            $table->foreign('perjadin_anggota_id')->references('id')->on('perjadin_anggotas');
            $table->date('tanggal_pergi');
            $table->date('tanggal_pulang');
            $table->double('uang_harian1');
            $table->double('uang_harian1_hari');
            $table->double('uang_harian2');
            $table->double('uang_harian2_hari');
            $table->double('penginapan1');
            $table->double('penginapan1_malam');
            $table->double('penginapan2');
            $table->double('penginapan2_malam');
            $table->double('representatif')->default(0);
            $table->double('representatif_hari')->default(0);
            $table->double('tiket_pulang');
            $table->double('tiket_pergi');
            $table->double('airport_tax_pergi');
            $table->double('airport_tax_pulang');
            $table->double('transport_kota_2');
            $table->double('transport2')->default(0);
            $table->double('kantor_bst')->default(0);
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
        Schema::dropIfExists('perjadin_rincians');
    }
}
