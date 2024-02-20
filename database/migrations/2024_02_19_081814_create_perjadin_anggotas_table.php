<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjadinAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadin_anggotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perjadin_id');
            $table->foreign('perjadin_id')->references('id')->on('perjadins');
            $table->string('nama');
            $table->string('id_anggota');
            $table->string('jabatan');
            $table->double('representaif')->nullable();

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
        Schema::dropIfExists('perjadin_anggotas');
    }
}
