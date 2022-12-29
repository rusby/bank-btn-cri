<?php

namespace App\Models\Operasional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;

class AnalisaFinansial extends Model
{
    use HasFactory, HasUuid;
    
    protected $table = 'data_analisa_finansial';
    protected $guarded = [];
    protected $hidden  = ['createdBy', 'updatedBy', 'created_at', 'updated_at'];
}
