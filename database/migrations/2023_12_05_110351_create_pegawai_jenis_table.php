<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_jenis', function (Blueprint $table) {
            $table->id();
            $table->string('pegawai_jenis_nama');
            $table->string('singkatan');
            $table->string('alias');
            $table->boolean('is_dosen');
            $table->boolean('if_asn');
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
        Schema::dropIfExists('pegawai_jenis');
    }
}
