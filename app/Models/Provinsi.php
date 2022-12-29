<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    //
    protected $table = 'provinsi';

    protected $fillable = [
        'provinsi','kode','updated_by'
    ];

    public function kota()
    {
        return $this->hasMany('App\Models\Kota', 'id_provinsi', 'id');
    }
}
