<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenUtamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_utamas', function (Blueprint $table) {
            $table->id();
            $table->uuid('collection_id');
            $table->string('folder', 255)->nullable();
            $table->string('ktp_pengajuan', 255)->nullable();
            $table->string('ktp_pasangan', 255)->nullable();
            $table->string('npwp', 255)->nullable();
            $table->string('kartu_keluarga', 255)->nullable();
            $table->string('akta_nikah', 255)->nullable();
            $table->string('keterangan_belum_nikah', 255)->nullable();
            $table->string('surat_cerai', 255)->nullable();
            $table->string('surat_kematian_pasangan', 255)->nullable();
            $table->string('form_permohonan_kpr', 255)->nullable();

            $table->string('copy_sk_pegawai_tetap', 255)->nullable();
            $table->string('asli_sk_aktif_bekerja', 255)->nullable();
            $table->string('asli_slip_gaji', 255)->nullable();
            $table->string('asli_rekening_koran', 255)->nullable();
            $table->string('spr_dari_developer', 255)->nullable();

            $table->string('surat_keterangan_usaha', 255)->nullable();
            $table->string('tabungan_3bulan_terakhir', 255)->nullable();
            
            $table->string('spt_pajak_penghasilan', 255)->nullable();

            $table->string('surat_pernyataan_pengajuan_fasilitas_tapera', 255)->nullable();
            $table->string('surat_pernyataan_kesanggupan_potonggaji', 255)->nullable();

            $table->string('surat_pernyataan_kepemilikan_rumah', 255)->nullable();
            $table->string('surat_pernyataan_tidak_menerima_rumah_subsidi', 255)->nullable();
            $table->string('surat_pernyataan_pemohon_dana_bp2bt', 255)->nullable();
            
            $table->string('dokumen_struktur_beton_rumah', 255)->nullable();
            $table->string('surat_pernyataan_kelayakan_fungsi_bangunan_rumah', 255)->nullable();
            $table->string('memiliki_lahan', 255)->nullable();
            $table->string('pas_foto', 255)->nullable();

            $table->string('surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu', 255)->nullable();
            $table->string('foto_fisik_bangunan_psu', 255)->nullable();
            $table->string('foto_rumah_kondisi_awal', 255)->nullable();
            $table->string('rab_pembangunan_rumah_dan_renovasi_rumah', 255)->nullable();

            $table->string('surat_izin_profesi', 255)->nullable();
            $table->string('izin_usaha', 255)->nullable();
            $table->string('akta_pendirian_perusahaan', 255)->nullable();
            $table->string('dokumen_pengajuan_sikasep', 255)->nullable();
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
        Schema::dropIfExists('dokumen_utamas');
    }
}
