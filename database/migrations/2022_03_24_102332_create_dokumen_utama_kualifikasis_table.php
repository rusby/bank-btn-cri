<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenUtamaKualifikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_utama_kualifikasis', function (Blueprint $table) {
            $table->id();
            $table->integer('dokumen_utama_id');
            $table->boolean('ktp_pengajuan')->default(false);
            $table->boolean('ktp_pasangan')->default(false);
            $table->boolean('npwp')->default(false);
            $table->boolean('kartu_keluarga')->default(false);
            $table->boolean('akta_nikah')->default(false);
            $table->boolean('surat_cerai')->default(false);
            $table->boolean('surat_kematian_pasangan')->default(false);
            $table->boolean('keterangan_belum_nikah')->default(false);
            $table->boolean('form_permohonan_kpr')->default(false);

            $table->boolean('copy_sk_pegawai_tetap')->default(false);
            $table->boolean('asli_sk_aktif_bekerja')->default(false);
            $table->boolean('asli_slip_gaji')->default(false);
            $table->boolean('asli_rekening_koran')->default(false);
            $table->boolean('spr_dari_developer')->default(false);

            $table->boolean('surat_keterangan_usaha')->default(false);
            $table->boolean('tabungan_3bulan_terakhir')->default(false);
            
            $table->boolean('spt_pajak_penghasilan')->default(false);

            $table->boolean('surat_pernyataan_pengajuan_fasilitas_tapera')->default(false);
            $table->boolean('surat_pernyataan_kesanggupan_potonggaji')->default(false);

            $table->boolean('surat_pernyataan_kepemilikan_rumah')->default(false);
            $table->boolean('surat_pernyataan_tidak_menerima_rumah_subsidi')->default(false);
            $table->boolean('surat_pernyataan_pemohon_dana_bp2bt')->default(false);
            
            $table->boolean('dokumen_struktur_beton_rumah')->default(false);
            $table->boolean('surat_pernyataan_kelayakan_fungsi_bangunan_rumah')->default(false);
            $table->boolean('memiliki_lahan')->default(false);
            $table->boolean('pas_foto')->default(false);

            $table->boolean('surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu')->default(false);
            $table->boolean('foto_fisik_bangunan_psu')->default(false);
            $table->boolean('foto_rumah_kondisi_awal')->default(false);
            $table->boolean('rab_pembangunan_rumah_dan_renovasi_rumah')->default(false);

            $table->boolean('surat_izin_profesi')->default(false);
            $table->boolean('izin_usaha')->default(false);
            $table->boolean('akta_pendirian_perusahaan')->default(false);
            $table->boolean('dokumen_pengajuan_sikasep')->default(false);
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
        Schema::dropIfExists('dokumen_utama_kualifikasis');
    }
}
