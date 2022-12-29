<?php

namespace App\Models\Berkas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenUtama extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden  = ['created_at', 'updated_at'];
    protected $appends = ['extension'];

    public function dokumenUtamaLainnya(){
        return $this->hasMany(DokumenLainnya::class, 'dokumen_utama_id', 'id');
    }

    public function dokumenKualifikasi(){
    	return $this->hasOne(DokumenUtamaKualifikasi::class, 'dokumen_utama_id', 'id');
    }    

    public function getExtensionAttribute(){
        return [
            'ktp_pengajuan' => \Helper::checkExtension($this->ktp_pengajuan),
            'ktp_pasangan' => \Helper::checkExtension($this->ktp_pasangan),
            'npwp' => \Helper::checkExtension($this->npwp),
            'kartu_keluarga' => \Helper::checkExtension($this->kartu_keluarga),
            'akta_nikah' => \Helper::checkExtension($this->akta_nikah),
            'keterangan_belum_nikah' => \Helper::checkExtension($this->keterangan_belum_nikah),
            'form_permohonan_kpr' => \Helper::checkExtension($this->form_permohonan_kpr),
            'copy_sk_pegawai_tetap' => \Helper::checkExtension($this->copy_sk_pegawai_tetap),
            'asli_sk_aktif_bekerja' => \Helper::checkExtension($this->asli_sk_aktif_bekerja),
            'asli_slip_gaji' => \Helper::checkExtension($this->asli_slip_gaji),
            'asli_rekening_koran' => \Helper::checkExtension($this->asli_rekening_koran),
            'spr_dari_developer' => \Helper::checkExtension($this->spr_dari_developer),
            'surat_keterangan_usaha' => \Helper::checkExtension($this->surat_keterangan_usaha),
            'tabungan_3bulan_terakhir' => \Helper::checkExtension($this->tabungan_3bulan_terakhir),
            'spt_pajak_penghasilan' => \Helper::checkExtension($this->spt_pajak_penghasilan),
            'surat_pernyataan_pengajuan_fasilitas_tapera' => \Helper::checkExtension($this->surat_pernyataan_pengajuan_fasilitas_tapera),
            'surat_pernyataan_kesanggupan_potonggaji' => \Helper::checkExtension($this->surat_pernyataan_kesanggupan_potonggaji),
            'surat_pernyataan_kepemilikan_rumah' => \Helper::checkExtension($this->surat_pernyataan_kepemilikan_rumah),
            'surat_pernyataan_tidak_menerima_rumah_subsidi' => \Helper::checkExtension($this->surat_pernyataan_tidak_menerima_rumah_subsidi),
            'surat_pernyataan_pemohon_dana_bp2bt' => \Helper::checkExtension($this->surat_pernyataan_pemohon_dana_bp2bt),
            'dokumen_struktur_beton_rumah' => \Helper::checkExtension($this->dokumen_struktur_beton_rumah),
            'surat_pernyataan_kelayakan_fungsi_bangunan_rumah' => \Helper::checkExtension($this->surat_pernyataan_kelayakan_fungsi_bangunan_rumah),
            'memiliki_lahan' => \Helper::checkExtension($this->memiliki_lahan),
            'pas_foto' => \Helper::checkExtension($this->pas_foto),
            'surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu' => \Helper::checkExtension($this->surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu),
            'foto_fisik_bangunan_psu' => \Helper::checkExtension($this->foto_fisik_bangunan_psu),
            'foto_rumah_kondisi_awal' => \Helper::checkExtension($this->foto_rumah_kondisi_awal),
            'rab_pembangunan_rumah_dan_renovasi_rumah' => \Helper::checkExtension($this->rab_pembangunan_rumah_dan_renovasi_rumah),
            'surat_izin_profesi' => \Helper::checkExtension($this->surat_izin_profesi),
            'izin_usaha' => \Helper::checkExtension($this->izin_usaha),
            'akta_pendirian_perusahaan' => \Helper::checkExtension($this->akta_pendirian_perusahaan),
            'dokumen_pengajuan_sikasep' => \Helper::checkExtension($this->dokumen_pengajuan_sikasep),
            'surat_kematian_pasangan' => \Helper::checkExtension($this->surat_kematian_pasangan),
            'surat_cerai' => \Helper::checkExtension($this->surat_cerai)
        ];
    }
}
