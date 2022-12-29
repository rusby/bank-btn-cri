<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;

class File extends Model
{
    use HasFactory, HasUuid;
    protected $casts = [
        'id' => 'string'
    ];
    protected $hidden  = ['created_by', 'updated_by', 'created_at', 'updated_at'];

    protected $guarded = [];
}