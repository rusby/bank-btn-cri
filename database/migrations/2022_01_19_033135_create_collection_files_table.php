<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_ktp', 20)->nullable();
            $table->string('nama_calon_debitur')->nullable();
            $table->string('nama_developer')->nullable();
            $table->string('no_telp_developer')->nullable();
            $table->string('nama_project')->nullable();
            $table->string('alamat_project')->nullable();
            $table->enum('status_pernikahan', ['Menikah', 'Belum Menikah', 'Cerai']);
            $table->boolean('is_pasangan_meninggal')->default(false);
            $table->enum('jenis_pekerjaan', ['Pegawai', 'Profesional', 'Wiraswasta'])->nullable();
            $table->unsignedInteger('uker_kode'); //ini nanti kantor cabang mana
            $table->unsignedInteger('uker_kode_baru')->nullable();
            $table->string('jenis_kredit');
            $table->string('jenis_sub_kredit')->nullable();
            $table->string('tgl_terkirim')->nullable();
            $table->boolean('is_pengajuan')->default(false);
            $table->string('alasan_tolak')->nullable();
            $table->string('sanggah_tolak')->nullable(); //diisi olleh bagian collection, setelah melengkapi kembali semua data yang ditolak operasional
            $table->string('alasan_tolak_verifikasi')->nullable();
            $table->string('sanggah_tolak_verifikasi')->nullable();
            $table->smallInteger('status_id')->default(1);
            $table->string('jumlah_permohonan_kredit')->nullable();
            $table->integer('nominal_cair')->nullable();
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
        Schema::dropIfExists('collection_files');
    }
}
