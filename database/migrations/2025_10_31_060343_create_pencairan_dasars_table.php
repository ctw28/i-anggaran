<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePencairanDasarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('pencairan_dasars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pencairan_detail_id');
            $table->foreign('pencairan_detail_id')->references('id')->on('pencairan_details')->onDelete('cascade');;
            $table->boolean('isKuitansi')->default(false);
            $table->boolean('isSK')->default(false);
            $table->boolean('isSuratTugas')->default(false);

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
        Schema::dropIfExists('pencairan_dasars');
    }
}
