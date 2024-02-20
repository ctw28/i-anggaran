<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjadinRealCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadin_real_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perjadin_anggota_id');
            $table->foreign('perjadin_anggota_id')->references('id')->on('perjadin_anggotas');
            $table->string('item');
            $table->double('nilai');
            $table->enum('jenis', ['transport', 'penginapan']);

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
        Schema::dropIfExists('perjadin_real_costs');
    }
}
