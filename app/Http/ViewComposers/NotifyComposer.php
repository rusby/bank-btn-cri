<?php

namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Models\Collection\CollectionFile;


class NotifyComposer
{
	public function compose(View $view)
	{
		$role = \Auth::user()->getRoleNames()->first();
		$collection = CollectionFile::when($role == "operasional", function($q){
			$q->whereIn('status_id', [1, 3, 6]);
		})
		->when($role == "Kantor Pusat" || $role == "Kantor Wilayah" || $role == "admin bri" || $role == "Kantor Cabang" || $role == "Kantor Cabang Pembantu", function($q){
			$q->where('status_id', '>', 9);
		})
		->when($role == "operasional verifikator", function($q){
			$q->whereIn('status_id', [7,8]);
		})
		->when($role == "sales lepas" || $role == "sales developer", function($q){
			$q->whereIn('status_id', [2,12])
              ->where('createdBy', \Auth::user()->id);
		})
		->where('is_pengajuan', true)
		->limit(10)
		->orderBy('updated_at', 'DESC')
		->get();
		$view->with(['notif_data' => $collection]);
	}
}