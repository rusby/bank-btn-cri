<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAgunansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_agunan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('data_diri_id');

            $table->string('lokasi_tanah')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->string('jarak_agunan')->nullable();
            $table->string('batas_utara_tanah')->nullable();
            $table->string('batas_timur_tanah')->nullable();
            $table->string('batas_selatan_tanah')->nullable();
            $table->string('batas_barat_tanah')->nullable();
            $table->string('bentuk_tanah')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('jarak_terhadap_jalan')->nullable();
            $table->string('permukaan_tanah')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('jenis_no_surat_tanah')->nullable();
            $table->string('tgl_surat_tanah')->nullable();
            $table->string('atas_nama_surat_tanah')->nullable();
            $table->string('jenis_kepemilikan')->nullable();
            $table->string('nama_kantor_bpn')->nullable();
            $table->string('no_imb')->nullable();
            $table->string('tgl_imb')->nullable();
            $table->string('luas_bangunan')->nullable();
            $table->string('tahun_mendirikan_bangunan')->nullable();

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
        Schema::dropIfExists('data_agunan');
    }
}
