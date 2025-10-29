<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpds', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('kegiatan_id');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')->onDelete('cascade');;
            $table->date('tanggal_pencairan')->nullable();
            $table->double('rencana_jumlah');
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
        Schema::dropIfExists('rpds');
    }
}
