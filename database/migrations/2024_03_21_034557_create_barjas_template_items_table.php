<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarjasTemplateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barjas_template_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barjas_template_bagian_id');
            $table->foreign('barjas_template_bagian_id')->references('id')->on('barjas_template_bagians');
            $table->string('nama_dokumen');
            $table->integer('urutan');

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
        Schema::dropIfExists('barjas_template_items');
    }
}
