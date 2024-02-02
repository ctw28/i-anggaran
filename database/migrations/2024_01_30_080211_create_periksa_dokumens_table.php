<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_dokumens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_sesi_id');
            $table->foreign('periksa_sesi_id')->references('id')->on('periksa_sesis');
            $table->unsignedBigInteger('periksa_daftar_id');
            $table->foreign('periksa_daftar_id')->references('id')->on('periksa_daftars');
            $table->boolean('is_valid')->default(false);
            $table->string('catatan');

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
        Schema::dropIfExists('periksa_dokumens');
    }
}
