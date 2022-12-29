<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKantorCabangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kantor_cabangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('kota_id')->nullable();
            $table->string('nama');
            $table->integer('kode');
            $table->integer('cust_provinsi_id')->nullable();
            $table->boolean('is_aktif')->default(1); //aktif atau tidak
            $table->integer('kc_id')->nullable(); //ini kalau punya parent, berarti dia kcp
            $table->boolean('is_kck')->default(false);
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
        Schema::dropIfExists('kantor_cabangs');
    }
}
