<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominalPengaturansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //AMPRA
        Schema::create('nominal_pengaturans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pencairan_id');
            $table->foreign('pencairan_id')->references('id')->on('pencairans')->onDelete('cascade');;
            $table->boolean('is_peserta_luar')->default(false);
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
        Schema::dropIfExists('nominal_pengaturans');
    }
}
