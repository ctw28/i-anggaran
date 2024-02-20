<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjadinDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadin_dinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perjadin_id');
            $table->foreign('perjadin_id')->references('id')->on('perjadins');
            $table->enum('dinas_ke', ["1", "2"]);
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->double('uang_harian');
            $table->double('uang_penginapan');
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
        Schema::dropIfExists('perjadin_dinas');
    }
}
