<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaDaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_daftars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_template_id');
            $table->foreign('periksa_template_id')->references('id')->on('periksa_templates');
            $table->unsignedBigInteger('periksa_kategori_id');
            $table->foreign('periksa_kategori_id')->references('id')->on('periksa_kategoris');

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
        Schema::dropIfExists('periksa_daftars');
    }
}
