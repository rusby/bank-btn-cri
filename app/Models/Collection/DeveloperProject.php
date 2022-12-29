<?php

namespace App\Models\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jamesh\Uuid\HasUuid;
use App\Traits\Collection\DeveloperProjectTrait;

class DeveloperProject extends Model
{
	use HasFactory, HasUuid, DeveloperProjectTrait;
	protected $casts = [
		'id' => 'string'
	];
	protected $guarded = [];
	protected $hidden  = ['created_at', 'updated_at'];
	protected $appends = ['extension'];

    public function filesLainnya(){
    	return $this->hasMany(DeveloperProjectFiles::class, 'developer_project_id', 'id');
    }

    public function getExtensionAttribute(){
        return [
            'files_imb' => \Helper::checkExtension($this->files_imb),
            'files_sertifikat' => \Helper::checkExtension($this->files_sertifikat),
            'files_slf' => \Helper::checkExtension($this->files_slf),
            'files_pbb' => \Helper::checkExtension($this->files_pbb)
        ];
    }
}
