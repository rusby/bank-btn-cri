<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
    protected $table = 'kecamatan';

    protected $fillable = [
        'kecamatan','id_kota','updated_by'
    ];

    public function kelurahan()
    {
        return $this->hasMany('App\Models\Kelurahan', 'id_kelurahan', 'id');
    }

    public function kota()
    {
        return $this->belongsTo('App\Models\Kota', 'id_kota', 'id');
    }
}
