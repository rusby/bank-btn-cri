<?php

namespace App\Models\Berkas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class DokumenLainnya extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden  = ['created_at', 'updated_at'];

    public function files(){
    	return $this->hasOne(File::class, 'id', 'file_id');
    }
}
