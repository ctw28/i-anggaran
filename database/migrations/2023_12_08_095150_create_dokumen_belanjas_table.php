<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenBelanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_belanjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pencairan_id');
            $table->foreign('pencairan_id')->references('id')->on('pencairans')->onDelete('cascade');;

            $table->string('item');
            $table->double('nilai');
            $table->double('ppn');
            $table->double('pph');
            $table->string('jenis');
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
        Schema::dropIfExists('dokumen_belanjas');
    }
}
