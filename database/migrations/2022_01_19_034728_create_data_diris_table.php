<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDirisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_diri', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('collection_files_id');
            $table->string('no_ktp', 17)->nullable();
            $table->string('nama_debitur')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('program_pemasaran')->nullable();

            $table->string('jenis_debitur')->nullable();
            $table->string('gelar_pendidikan')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('alamat_domisili')->nullable();
            $table->unsignedInteger('lama_menetap')->default(0);
            $table->unsignedInteger('lama_berkerja')->default(0);
            $table->string('no_npwp')->nullable();
            $table->string('nama_gadis_ibu_kandung')->nullable();
            $table->string('tanggal_kadaluarsa_ktp')->default("Seumur Hidup");
            $table->string('no_telp')->nullable();
            $table->string('kelurahan_id')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('kepemilikan_tempat_tinggal')->nullable();

            $table->string('status_kepegawaian')->nullable();
            $table->string('jenis_pekerjaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('no_sk_kenaikan_pangkat')->nullable();
            $table->string('usia_masa_persiapan_pensiun')->nullable();
            $table->string('sumber_penghasilan')->nullable();
            $table->string('nama_keluarga_dekat')->nullable();
            $table->string('no_telp_keluarga_dekat')->nullable();
            $table->string('memiliki_simpanan_bri')->nullable();

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
        Schema::dropIfExists('data_diri');
    }
}
