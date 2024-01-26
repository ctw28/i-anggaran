<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('organisasi_rpd_id')->nullable();
            $table->foreign('organisasi_rpd_id')->references('id')->on('organisasi_rpds')->nullOnDelete();

            //untuk kalau mau masukkan detail
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('kegiatans')->nullOnDelete();
            $table->unsignedBigInteger('kode_akun_id')->nullable();
            $table->foreign('kode_akun_id')->references('id')->on('kode_akuns');

            //contoh sub kegiatan 2132.BGC.002.051.ME, dipecah, bisa kosong untuk untuk detail kegiatan
            $table->string('sub_kegiatan_kode1')->nullable(); //2132
            $table->string('sub_kegiatan_kode2')->nullable(); //BGC
            $table->string('sub_kegiatan_kode3')->nullable(); //002
            $table->string('sub_kegiatan_kode4')->nullable(); //051
            $table->string('sub_kegiatan_kode5')->nullable(); //ME

            $table->string('kegiatan_nama');
            $table->double('volume')->nullable();
            $table->double('satuan')->nullable();
            $table->double('jumlah_biaya');

            $table->string('sumber_dana')->nullable(); //RM atau PNBP
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
        Schema::dropIfExists('kegiatans');
    }
}
