<?php

namespace App\Models\Operasional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;
use App\Models\Operasional\{
    DataPasangan,
    AnalisaFinansial,
    DataAgunan,
    UjiDataFlpp
};
use App\Models\Kelurahan;

class DataDiri extends Model
{
    use HasFactory, HasUuid;
    
    protected $table = 'data_diri';
    protected $guarded = [];
    protected $hidden  = ['createdBy', 'updatedBy', 'created_at', 'updated_at'];
    protected $appends = ['wilayah'];

    public function pasangan(){
    	return $this->hasOne(DataPasangan::class, 'data_diri_id', 'id');
    }

    public function analisaFinansial(){
    	return $this->hasOne(AnalisaFinansial::class, 'data_diri_id', 'id');
    }

    public function agunan(){
    	return $this->hasOne(DataAgunan::class, 'data_diri_id', 'id');
    }

    public function ujiFlpp(){
    	return $this->hasOne(UjiDataFlpp::class, 'data_diri_id', 'id');
    }

    public function kelurahan(){
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function getWilayahAttribute(){
        return [
            'kelurahan' => [
                'id'          => $this->kelurahan()->exists() ? $this->kelurahan->id : '-',
                'nama'        => $this->kelurahan()->exists() ? $this->kelurahan->kelurahan : '-'
            ],
            'kode_pos' => [
                'id'          => $this->kelurahan()->exists() ? $this->kelurahan->kodePos->id : '-',
                'nama'        => $this->kelurahan()->exists() ? $this->kelurahan->kodePos->kode_pos : '-'
            ],
            'kecamatan' => [
                'id'          => $this->kelurahan()->exists() ? $this->kelurahan->kecamatan->id : '-',
                'nama'        => $this->kelurahan()->exists() ? $this->kelurahan->kecamatan->kecamatan : '-'
            ],
            'kota' => [
                'id'          => $this->kelurahan()->exists() ? $this->kelurahan->kecamatan->kota->id : '-',
                'nama'        => $this->kelurahan()->exists() ? $this->kelurahan->kecamatan->kota->kota : '-'
            ],
            'provinsi' => [
                'id'          => $this->kelurahan()->exists() ? $this->kelurahan->kecamatan->kota->provinsi->id : '-',
                'nama'        => $this->kelurahan()->exists() ? $this->kelurahan->kecamatan->kota->provinsi->provinsi : '-'
            ]
        ];
    }
}
