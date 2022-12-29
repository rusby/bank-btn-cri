<?php

namespace App\Models\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Jamesh\Uuid\HasUuid;
use App\Traits\Collection\DeveloperTrait;

class Developer extends Model
{
	use HasFactory, HasUuid, DeveloperTrait;
	protected $casts = [
		'id' => 'string'
	];

	protected $guarded = [];
	protected $hidden  = ['created_at', 'updated_at'];

	public function project(){
        return $this->hasOne(DeveloperProject::class, 'developer_id', 'id');
    }

    public function collection(){
        return $this->belongsTo(CollectionFile::class, 'collection_id', 'id');
    }
}
