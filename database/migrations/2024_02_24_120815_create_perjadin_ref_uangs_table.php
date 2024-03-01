<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjadinRefUangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadin_ref_uangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perjadin_id');
            $table->foreign('perjadin_id')->references('id')->on('perjadins')->onDelete('cascade');
            $table->enum('dinas_ke', ["1", "2"]);
            $table->double('uang_harian')->nullable();
            $table->double('uang_penginapan')->nullable();
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
        Schema::dropIfExists('perjadin_ref_uangs');
    }
}
