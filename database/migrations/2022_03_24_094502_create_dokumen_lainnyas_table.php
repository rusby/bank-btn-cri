<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenLainnyasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_lainnyas', function (Blueprint $table) {
            $table->id();
            $table->integer('dokumen_utama_id');
            $table->uuid('file_id');
            $table->string('nama_file');
            $table->boolean('lolos')->default(false);
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_lainnyas');
    }
}
