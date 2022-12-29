<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPasangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pasangan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('data_diri_id');
            $table->string('nama_pasangan')->nullable();
            $table->string('no_ktp_pasangan')->nullable();
            $table->string('tgl_lahir_pasangan')->nullable();

            $table->uuid('createdBy');
            $table->uuid('updatedBy')->nullable();;
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
        Schema::dropIfExists('data_pasangan');
    }
}
