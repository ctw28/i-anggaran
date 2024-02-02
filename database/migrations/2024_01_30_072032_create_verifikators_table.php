<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifikatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisasi_jabatan_sesi_id');
            $table->foreign('organisasi_jabatan_sesi_id')->references('id')->on('organisasi_jabatan_sesis')->onDelete('cascade');;
            $table->string('sebutan_jabatan')->nullable();
            $table->boolean('is_aktif')->default(true);
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
        Schema::dropIfExists('verifikators');
    }
}
