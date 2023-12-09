<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrganisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_organisasis', function (Blueprint $table) {
            $table->id();
            //jika dia role nya sebagai user yang mau buat dokumen pencairan, maka di cek tabel ini, lembaga apa yang dia mau buatkan dokumen
            //bisa jadi 1 user lebih dari 1 organisasi
            $table->unsignedBigInteger('user_role_id');
            $table->foreign('user_role_id')->references('id')->on('user_roles')->onDelete('cascade');
            $table->unsignedBigInteger('organisasi_id');
            $table->foreign('organisasi_id')->references('id')->on('organisasis')->onDelete('cascade');
            $table->boolean('is_aktif')->default(true); //digunakan untuk jika nanti orangnya pindah organisasi, jadi dinonaktifkan sj

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
        Schema::dropIfExists('user_organisasis');
    }
}
