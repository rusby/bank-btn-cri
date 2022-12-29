<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenTambahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_tambahans', function (Blueprint $table) {
            $table->id();
            $table->uuid('collection_id');
            $table->string('folder', 255)->nullable();            
            $table->string('surat_pernyataan_belum_memiliki_rumah', 255)->nullable(); //flpp
            $table->string('surat_pernyataan_pemohon', 255)->nullable(); //flpp
            $table->string('surat_status_kepemilikan_rumah', 255)->nullable(); //flpp
            $table->string('surat_pernyataan_penghasilan', 255)->nullable(); //flpp
            $table->string('surat_pernyataan_verifikasi', 255)->nullable(); //flpp
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
        Schema::dropIfExists('dokumen_tambahans');
    }
}
