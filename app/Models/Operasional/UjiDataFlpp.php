<?php

namespace App\Models\Operasional;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Jamesh\Uuid\HasUuid;

class UjiDataFlpp extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'uji_data_flpp';
    protected $guarded = [];
    protected $hidden  = ['createdBy', 'updatedBy', 'created_at', 'updated_at'];
}
