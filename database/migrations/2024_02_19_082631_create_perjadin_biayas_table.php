<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjadinBiayasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadin_biayas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perjadin_anggota_id');
            $table->foreign('perjadin_anggota_id')->references('id')->on('perjadin_anggotas');
            $table->double('tiket_pergi');
            $table->double('tiket_pulang');
            $table->double('airport_tax_pergi');
            $table->double('airport_tax_pulang');
            $table->double('transport_kota_2');
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
        Schema::dropIfExists('perjadin_biayas');
    }
}
