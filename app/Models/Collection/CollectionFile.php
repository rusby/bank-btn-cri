<?php

namespace App\Models\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Operasional\DataDiri;
use App\Models\KantorCabang as UnitKerja;
use App\Traits\Collection\CollectionFileTrait;
use Jamesh\Uuid\HasUuid;
use App\Models\Berkas\{
    DokumenUtama,
    DokumenTambahan
};
use App\Models\User;
use App\Models\Operasional\AnalisaFinansial;
use Carbon\Carbon;

class CollectionFile extends Model
{
    use HasFactory, HasUuid, CollectionFileTrait;
    protected $casts = [
        'id' => 'string'
    ];
    protected $appends = ['uker', 'status', 'created_at'];
    protected $hidden  = ['createdBy', 'updatedBy', 'created_at'];
    protected $guarded = [];

    //hasone kalau dari parent ke child, belongsto kalo dari child ke parent
    public function dataDiri(){
        return $this->hasOne(DataDiri::class, 'collection_files_id', 'id');
    }

    public function developer(){
        return $this->hasOne(Developer::class, 'collection_id', 'id');
    }

    public function unitKerja(){
        return $this->hasOne(UnitKerja::class, 'kode', 'uker_kode');
    }

    public function unitKerjaBaru(){
        return $this->hasOne(UnitKerja::class, 'kode', 'uker_kode_baru');
    }

    public function dokumenUtama(){
        return $this->hasOne(DokumenUtama::class, 'collection_id', 'id');
    }

    // public function getDokUtamaAttribute(){
    //     if ($this->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)' || $this->jenis_kredit == 'KPR Komersial (Baru atau Secondary)') {
    //         return $this->dokumenUtama;
    //     }else{
    //         return $this->dokumenUtama;
    //     }      
    // }

    // public function getDokUtamaTambahanAttribute(){
    //     if ($this->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)' || $this->jenis_kredit == 'KPR Komersial (Baru atau Secondary)') {
    //         return $this->dokumenUtamaTambahan;
    //     }else{
    //         return $this->dokumenUtamaTambahan;
    //     }              
    // }

    public function dokumenUtamaTambahan(){
        return $this->hasOne(DokumenTambahan::class, 'collection_id', 'id');
    }

    public function collectionStatus(){
        return $this->hasOne(CollectionStatus::class, 'id', 'status_id');
    }

    public function userCreated(){
        return $this->hasOne(User::class, 'id', 'createdBy');
    }

    public function historyStatus(){
        return $this->hasMany(CollStatusHistory::class, 'collection_id', 'id');
    }

    public function getUkerAttribute(){
        if ($this->uker_kode == 1039) {
            return [
                'provinsi' => [
                    'id' => 6,
                    'nama' => 'DKI Jakarta'
                ],
                'kantor_cabang' => [
                    'id' => 1039,
                    'nama' => 'Kantor Cabang Khusus',
                    'kode' => 1039
                ]
            ];
        }else{
            return [
                'provinsi' => [
                    'id'          => $this->unitKerja->provinsi->id,
                    'nama'        => $this->unitKerja->provinsi->provinsi
                ],
                'kantor_wilayah' => [
                    'id'          => $this->unitKerja->kantorWilayah->id,
                    'nama'        => $this->unitKerja->kantorWilayah->kota
                ],
                'kantor_cabang' => [
                    'kode'       => $this->unitKerja->kode,
                    'nama'       => $this->unitKerja->nama
                ]
            ];
        }        
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s');
    }
    
    public function getUpdatedAtAttribute($value) {
        return Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s');
    }

    public function getTglTerkirimAttribute($value)
    {
        // return Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s');
        return ($value ? Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') : '-');
    }

    public function getStatusAttribute(){
        return $this->is_pengajuan ? $this->collectionStatus->nama : 'Draft';
    }

    public function getJenisKreditAttribute($value){
        if (\Auth::user()->getRoleNames()->first() != "sales lepas" && \Auth::user()->getRoleNames()->first() != "sales developer") {
            return $this->jenis_sub_kredit ? "{$value} - {$this->jenis_sub_kredit}" : $value;   
        }
        return $value;
    }
}
