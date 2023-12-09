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
            $table->unsignedBigInteger('dokumen_pencairan_sesi_id');
            $table->foreign('dokumen_pencairan_sesi_id')->references('id')->on('dokumen_pencairan_sesis');
            // $table->string('jabatan');
            // $table->string('bayaran');
            // $table->integer('bayaran_pengali');
            // $table->string('satuan');
            $table->boolean('is_non_satker')->default(true);
            // $table->boolean('is_pajak')->default(false);
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
