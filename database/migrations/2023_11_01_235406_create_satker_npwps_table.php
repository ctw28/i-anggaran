<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatkerNpwpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satker_npwps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('satker_id');
            $table->foreign('satker_id')->references('id')->on('satkers');
            $table->string('npwp_nomor');
            $table->string('npwp_alamat');

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
        Schema::dropIfExists('satker_npwps');
    }
}
