<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarjasSesiPeriksasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barjas_sesi_periksas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barjas_sesi_id');
            $table->foreign('barjas_sesi_id')->references('id')->on('barjas_sesis')->onDelete('cascade');
            $table->unsignedBigInteger('barjas_template_item_id');
            $table->foreign('barjas_template_item_id')->references('id')->on('barjas_template_items');
            $table->date('tanggal_dokumen')->nullable();
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
        Schema::dropIfExists('barjas_sesi_periksas');
    }
}
