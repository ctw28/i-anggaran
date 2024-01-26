<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_sesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisasi_rpd_id');
            $table->foreign('organisasi_rpd_id')->references('id')->on('organisasi_rpds')->onDelete('cascade');
            $table->boolean('is_rpd_kirim')->default(false);
            $table->enum('status', [0, 1, 2])->default(0); //2 itu tidak valid, 1 valid, 0 proses

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
        Schema::dropIfExists('rencana_sesis');
    }
}
