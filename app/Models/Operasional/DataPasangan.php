<?php

namespace App\Models\Operasional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;

class DataPasangan extends Model
{
    use HasFactory, HasUuid;
    
    protected $table = 'data_pasangan';
    protected $guarded = [];
    protected $hidden  = ['createdBy', 'updatedBy', 'created_at', 'updated_at'];
}
