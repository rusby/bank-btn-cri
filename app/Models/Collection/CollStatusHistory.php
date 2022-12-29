<?php

namespace App\Models\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Collection\CollectionFile;

class CollStatusHistory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden  = ['id', 'status_id', 'user_id', 'updated_at']; 

    public function getCreatedAtAttribute($value)
    {
        return ($value ? Carbon::parse($value)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') : '-');
    }

    public function storeStatus($colId, $statusId){
    	$this->create([
    		'collection_id' => $colId,
    		'user_id'   	=> \Auth::user()->id,
    		'status_id' 	=> $statusId
    	]);
    }

    public function status(){
    	return $this->belongsTo(CollectionStatus::class, 'status_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function collection(){
        return $this->belongsTo(CollectionFile::class, 'collection_id', 'id');
    }
}
