<?php

namespace App\Models\Berkas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenTambahan extends Model
{
    use HasFactory;
    protected $guarded = [];
	protected $hidden  = ['created_at', 'updated_at'];
	protected $appends = ['extension'];

    public function dokumenTambahanKualifikasi(){
    	return $this->hasOne(DokumenTambahanKualifikasi::class, 'dokumen_tambahan_id', 'id');
    }

    public function dokumenTambahanLainnya(){
        return $this->hasMany(DokumenTambahanLainnya::class, 'dokumen_tambahan_id', 'id');
    }

    public function getExtensionAttribute(){
        return [
            'surat_pernyataan_pemohon' => \Helper::checkExtension($this->surat_pernyataan_pemohon),
            'surat_status_kepemilikan_rumah' => \Helper::checkExtension($this->surat_status_kepemilikan_rumah),
            'surat_pernyataan_penghasilan' => \Helper::checkExtension($this->surat_pernyataan_penghasilan),
            'surat_pernyataan_verifikasi' => \Helper::checkExtension($this->surat_pernyataan_verifikasi),
            'surat_pernyataan_belum_memiliki_rumah' => \Helper::checkExtension($this->surat_pernyataan_belum_memiliki_rumah)
        ];
    }
}
