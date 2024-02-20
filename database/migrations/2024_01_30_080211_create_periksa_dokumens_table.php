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
            $table->unsignedBigInteger('periksa_kategori_list_id');
            $table->foreign('periksa_kategori_list_id')->references('id')->on('periksa_kategori_lists');
            $table->boolean('is_valid')->default(false);
            $table->string('catatan')->nullable();

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
