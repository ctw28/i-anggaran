<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminOrganisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_organisasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_role_id');
            $table->foreign('user_role_id')->references('id')->on('user_roles')->onDelete('cascade');
            $table->unsignedBigInteger('organisasi_id');
            $table->foreign('organisasi_id')->references('id')->on('organisasis')->onDelete('cascade');
            $table->string('sebutan');

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
        Schema::dropIfExists('admin_organisasis');
    }
}
