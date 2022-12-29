<?php

namespace App\Models\Operasional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;
use App\Models\Kelurahan;

class DataAgunan extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'data_agunan';
    protected $guarded = [];
    protected $appends = ['wilayah'];
    protected $hidden  = ['createdBy', 'updatedBy', 'created_at', 'updated_at'];

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
