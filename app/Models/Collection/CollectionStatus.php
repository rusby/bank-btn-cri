<?php

namespace App\Models\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionStatus extends Model
{
    use HasFactory;
    protected $hidden = ['is_aktif', 'created_at', 'updated_at'];
}
