<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    //
    protected $table = 'kelurahan';

    protected $fillable = [
        'kelurahan','id_kecamatan','id_kode_pos','updated_by'
    ];

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan', 'id_kecamatan', 'id');
    }

    public function kodePos()
    {
        return $this->hasOne('App\Models\Kodepos', 'id', 'id_kode_pos');
    }
}
