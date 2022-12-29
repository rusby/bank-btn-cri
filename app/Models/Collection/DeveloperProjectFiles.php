<?php

namespace App\Models\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jamesh\Uuid\HasUuid;

class DeveloperProjectFiles extends Model
{
    use HasFactory, HasUuid;
	protected $casts = [
		'id' => 'string'
	];
	protected $guarded = [];
	protected $hidden  = ['created_at', 'updated_at', 'created_by', 'updated_by'];
}
