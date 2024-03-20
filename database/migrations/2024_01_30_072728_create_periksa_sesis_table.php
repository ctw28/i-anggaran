<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_sesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_usul_id');
            $table->foreign('periksa_usul_id')->references('id')->on('periksa_usuls');
            $table->unsignedBigInteger('verifikator_id');
            $table->foreign('verifikator_id')->references('id')->on('verifikators');
            $table->enum('status', [0, 1, 2, 3])->default(0); //0 proses, 1 perbaikan, 2 ditolak, 3 sesuai
            $table->text('catatan')->nullable();
            $table->string('sumber_dana')->nullable();
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
        Schema::dropIfExists('periksa_sesis');
    }
}
