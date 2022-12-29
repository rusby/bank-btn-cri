<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kodepos extends Model
{
    //
    protected $table = 'kode_pos';

    protected $fillable = [
        'kode_pos','id_kecamatan','updated_by'
    ];

    public function kelurahan()
    {
        return $this->belongsTo('App\Models\Kelurahan', 'id_kode_pos', 'id');
    }

    public function kecamatan()
    {
        return $this->hasOne('App\Models\Kecamatan', 'id', 'id_kecamatan');
    }
    
}
