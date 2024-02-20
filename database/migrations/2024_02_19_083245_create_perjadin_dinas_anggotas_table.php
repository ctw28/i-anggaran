<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjadinDinasAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadin_dinas_anggotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perjadin_dinas_id');
            $table->foreign('perjadin_dinas_id')->references('id')->on('perjadin_dinas');
            $table->unsignedBigInteger('perjadin_anggota_id');
            $table->foreign('perjadin_anggota_id')->references('id')->on('perjadin_anggotas');

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
        Schema::dropIfExists('perjadin_dinas_anggotas');
    }
}
