<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KantorCabang extends Model
{
    use HasFactory;

	protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

	public function kantorWilayah(){
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public function kanca(){
        return $this->belongsTo(KantorCabang::class, 'kc_id', 'id');        
    }

    public function kcp(){
        return $this->hasMany(KantorCabang::class, 'kc_id', 'id');
    }

    // all uker now have a provinsi
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'cust_provinsi_id', 'id');
    }

    public function getNamaAttribute($value){
    	return $this->kc_id ? "KCP - {$value}" : $value ;
    }
}
