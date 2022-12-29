<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KantorCabang as UnitKerja;

class UserBri extends Model
{
	use HasFactory;
	protected $guarded = [];

	public function kantorWilayah(){
		return $this->hasOne(Kota::class, 'id', 'kanwil_id');
	}

	public function unitKerja(){
		return $this->hasOne(UnitKerja::class, 'kode', 'kanca_kode');
	}

	public function unitKerja2(){
		return $this->hasOne(UnitKerja::class, 'id', 'kanca_kode');
	}

	public function cabangPembantu(){
		return $this->hasOne(UnitKerja::class, 'kode', 'kcp_kode');
	}
}
