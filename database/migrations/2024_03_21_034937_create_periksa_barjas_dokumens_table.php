<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaBarjasDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_barjas_dokumens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_barjas_sesi_id');
            $table->foreign('periksa_barjas_sesi_id')->references('id')->on('periksa_barjas_sesis');
            $table->unsignedBigInteger('periksa_barjas_list_id');
            $table->foreign('periksa_barjas_list_id')->references('id')->on('periksa_barjas_lists');
            $table->boolean('status')->default(true);
            $table->string('tanggal_dokumen');

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
        Schema::dropIfExists('periksa_barjas_dokumens');
    }
}
