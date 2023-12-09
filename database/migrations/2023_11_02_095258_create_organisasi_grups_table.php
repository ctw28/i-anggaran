<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisasiGrupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisasi_grups', function (Blueprint $table) {
            $table->id();
            $table->string('grup_nama', 200);
            $table->string('grup_singkatan', 200);
            $table->string('grup_flag', 50);
            $table->string('pimpinan_sebutan', 200);
            $table->text('grup_keterangan');
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
        Schema::dropIfExists('organisasi_grups');
    }
}
