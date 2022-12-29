<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection\{
	CollectionFile,
	CollStatusHistory
};
use Auth;

class DashboardController extends Controller
{
	public function getDashboard(){
		$user = \Auth::user()->userBri;
		if(Auth::user()->hasRole('Kantor Pusat') || Auth::user()->hasRole('Kantor Wilayah') || Auth::user()->hasRole('Kantor Cabang') || Auth::user()->hasRole('Kantor Cabang Pembantu') || Auth::user()->hasRole('Kantor Cabang Khusus')){
			$data['data'] = CollectionFile::with('unitKerja')
			->when($user->kanwil_id, function($q) use($user){
				$q->whereHas('unitKerja.kantorWilayah', function($query)use($user){
					$query->whereId($user->kanwil_id);
				});
			})
			->when($user->kanca_kode, function($q) use($user){
				$q->whereHas('unitKerja', function($query)use($user){
					$query->where('kc_id', $user->kanca_kode)
					->orWhere('id', $user->kanca_kode);
				});
			})
			->when($user->kcp_kode, function($q) use($user){
				$q->whereHas('unitKerja', function($query)use($user){
					$query->whereKode($user->kcp_kode);
				});
			})
			->when($user->is_kck, function($q) use($user){
				$q->where('uker_kode', 1039);
			})
			->where('status_id', '>', 9)
			->orderBy('updated_at', 'DESC')->limit(10)
			->get();
		}else if(Auth::user()->hasRole('operasional verifikator')){
			$data['data'] = CollectionFile::whereNotIn('status_id', [1,2,3,5])->where('is_pengajuan', true)->orderBy('updated_at', 'DESC')->limit(10)->get();
		}else if(Auth::user()->hasRole('operasional')){
			$data['data'] = CollectionFile::whereNotIn('status_id', [6,7,8,9])->orderBy('updated_at', 'DESC')->limit(10)->get();
		}else if(Auth::user()->hasRole('superadmin')){
			$data['data'] = CollectionFile::whereNotIn('status_id', [6,7,8,9])->orderBy('updated_at', 'DESC')->limit(10)->get();
		}else if(Auth::user()->hasRole('admin bri')){
			$data['data'] = CollectionFile::where('status_id', '>', 9)->orderBy('updated_at', 'DESC')->limit(10)->get();
		}else if(Auth::user()->hasRole('admin cri')){
			$data['data'] = CollectionFile::orderBy('updated_at', 'DESC')->limit(10)->get();
		}else{
			$data['data'] = CollectionFile::where('is_pengajuan', true)->where('createdBy', \Auth::user()->id)->orderBy('updated_at', 'DESC')->limit(10)->get();
		}
		$data['role'] =  Auth::user()->getRoleNames()->first();
		return view('dashboard')->with($data);
	}
}
