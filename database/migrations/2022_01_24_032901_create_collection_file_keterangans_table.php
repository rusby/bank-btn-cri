<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionFileKeterangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_file_keterangans', function (Blueprint $table) {
            $table->id();
            $table->integer('collection_id');
            $table->boolean('ktp');
            $table->boolean('npwp');
            $table->boolean('kk');
            $table->boolean('slip_gaji');
            $table->boolean('spr');
            $table->boolean('imb_pbg');
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
        Schema::dropIfExists('collection_file_keterangans');
    }
}
