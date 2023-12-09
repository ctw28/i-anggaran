<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKodeAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kode_akuns', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama_akun');
            $table->string('keterangan');
            $table->enum('jenis_kuitansi', [1, 2]);
            $table->boolean('is_pajak');
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
        Schema::dropIfExists('kode_akuns');
    }
}
