<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenTambahanKualifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_tambahan_kualifikasis', function (Blueprint $table) {
            $table->id();
            $table->integer('dokumen_tambahan_id');
            $table->boolean('surat_pernyataan_belum_memiliki_rumah')->default(false);
            $table->boolean('surat_pernyataan_pemohon')->default(false);
            $table->boolean('surat_status_kepemilikan_rumah')->default(false);
            $table->boolean('surat_pernyataan_penghasilan')->default(false);
            $table->boolean('surat_pernyataan_verifikasi')->default(false);
            $table->uuid('createdBy');
            $table->uuid('updatedBy')->nullable();
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
        Schema::dropIfExists('dokumen_tambahan_kualifikasis');
    }
}
