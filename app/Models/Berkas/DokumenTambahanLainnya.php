<?php

namespace App\Models\Berkas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class DokumenTambahanLainnya extends Model
{
    use HasFactory;
    protected $guarded = [];
	protected $hidden  = ['created_at', 'updated_at', 'lolos'];

	public function files(){
    	return $this->hasOne(File::class, 'id', 'file_id');
    }
}
