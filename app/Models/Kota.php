<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    //
    protected $table = 'kota';

    protected $fillable = [
        'kota','id_provinsi','updated_by', 'kabupaten'
    ];

    public function kecamatan()
    {
        return $this->hasMany('App\Models\Kecamatan', 'id_kota', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Provinsi', 'id_provinsi', 'id');
    }
}
