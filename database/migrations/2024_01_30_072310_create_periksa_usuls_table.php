<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaUsulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_usuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pencairan_id');
            $table->foreign('pencairan_id')->references('id')->on('pencairans')->onDelete('cascade');
            $table->boolean('is_finish')->default(false);
            $table->string('catatan')->nullable();
            $table->enum('pemeriksa', ['ppk', 'spi']);
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
        Schema::dropIfExists('periksa_usuls');
    }
}
