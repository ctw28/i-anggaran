<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpdRealisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpd_realisasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rpd_id');
            $table->foreign('rpd_id')->references('id')->on('rpds');
            $table->unsignedBigInteger('pencairan_id');
            $table->foreign('pencairan_id')->references('id')->on('pencairans')->onDelete('cascade');
            $table->double('realisasi');

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
        Schema::dropIfExists('rpd_realisasis');
    }
}
