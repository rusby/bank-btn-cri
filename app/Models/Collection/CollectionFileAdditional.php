<?php

namespace App\Models\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class CollectionFileAdditional extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function files(){
    	return $this->hasOne(File::class, 'id', 'file_id');
    }
}
