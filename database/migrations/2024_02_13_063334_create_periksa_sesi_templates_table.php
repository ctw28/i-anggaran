<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaSesiTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_sesi_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_sesi_id');
            $table->foreign('periksa_sesi_id')->references('id')->on('periksa_sesis');
            $table->unsignedBigInteger('periksa_template_id');
            $table->foreign('periksa_template_id')->references('id')->on('periksa_templates');

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
        Schema::dropIfExists('periksa_sesi_templates');
    }
}
