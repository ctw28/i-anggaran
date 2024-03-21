<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaBarjasSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_barjas_sesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('verifikator_id');
            $table->foreign('verifikator_id')->references('id')->on('verifikators');
            $table->unsignedBigInteger('periksa_barja_id');
            $table->foreign('periksa_barja_id')->references('id')->on('periksa_barjas');
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
        Schema::dropIfExists('periksa_barjas_sesis');
    }
}
