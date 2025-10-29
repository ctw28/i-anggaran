<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarjasTemplateBagiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barjas_template_bagians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barjas_template_id');
            $table->foreign('barjas_template_id')->references('id')->on('barjas_templates');
            $table->string('nama_bagian');
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
        Schema::dropIfExists('barjas_template_bagians');
    }
}
