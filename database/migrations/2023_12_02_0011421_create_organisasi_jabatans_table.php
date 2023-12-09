<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisasiJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisasi_jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan_nama', 100);
            $table->string('jabatan_singkatan', 20);
            $table->string('jabatan_untuk', 200);
            $table->string('jabatan_flag', 50); //sebagai pengenal yg bisa digunakan untuk keperluan aplikasi
            $table->string('jabatan_keterangan', 200)->nullable();
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
        Schema::dropIfExists('organisasi_jabatans');
    }
}
