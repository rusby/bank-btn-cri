<?php

namespace App\Http\Controllers;

use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\{
	CollectionFileExport,
	CollectionTabulasiExport
};
use App\Imports\{
	UkerImport,
	UserImport
};
use App\Models\Collection\CollectionFile;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
	public function exportCollection($id){
		$data = CollectionFile::findOrFail($id);
		return Excel::download(new CollectionFileExport($id), "{$data->nama_calon_debitur}-{$data->no_ktp}.xlsx");
	}

	public function exportTabulasi(Request $req){
        $user = \Auth::user()->userBri;
		$data = CollectionFile::orderBy('created_at', 'DESC')
		->when($user->kanwil_id, function($q) use($user){
			$q->whereHas('unitKerja.kantorWilayah', function($query)use($user){
				$query->whereId($user->kanwil_id);
			});
		})
		->when($user->kanca_kode, function($q) use($user){
			$q->whereHas('unitKerja', function($query)use($user){
				$query->where('kc_id', $user->kanca_kode);
				// 	  ->orWhere('id', $user->kanca_kode);
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
        ->when($req->filter_kanwil, function($q) use($req){
			$q->whereHas('unitKerja.kantorWilayah', function($query)use($req){
				$query->whereId($req->filter_kanwil);
			});
		})
		->when($req->filter_kanca && $req->filter_kanwil, function($q) use($req){
			$q->whereHas('unitKerja', function($query)use($req){
				$query->whereKode($req->filter_kanca);
			});
// 			$q->orWhereHas('unitKerja.kanca', function($query)use($req){
// 				$query->where('kode', $req->filter_kanca);
// 			});
		})
		->when($req->filter_kanca && !$req->filter_kanwil, function($q) use($req){
			$q->whereHas('unitKerja', function($query)use($req){
				$query->whereKode($req->filter_kanca);
			});
		})
		->when($req->filter_status, function($q) use($req){
			$q->whereStatusId($req->filter_status);
		})
		->when($req->filter_jenis_kpr, function($q) use($req){
			$q->whereJenisKredit($req->filter_jenis_kpr);
		})
		->when($req->filter_tanggal_mulai && $req->filter_tanggal_selesai, function($q) use($req){
			$q->whereBetween('tgl_terkirim', [$req->filter_tanggal_mulai." 00:00:00", $req->filter_tanggal_selesai." 23:59:59"]);
		})
		->with(['unitKerja.kantorWilayah', 'userCreated'])
		->where('status_id', '>', 9)
		->get();
		return Excel::download(new CollectionTabulasiExport($data), date('d-M-Y')."-tabulasi.xlsx");
	}

	public function importUker(){
		Excel::import(new UkerImport("kw"), public_path('/excel/import_kanwil.xlsx'));
		Excel::import(new UkerImport("kc"), public_path('/excel/import_kc.xlsx'));
		Excel::import(new UkerImport("kcp"), public_path('/excel/import_kcp.xlsx'));
	}

	public function importUser(){
		// Excel::import(new UserImport("kw"), public_path('/excel/user_kanwil.xlsx'));
		// Excel::import(new UserImport("kc"), public_path('/excel/user_kanca.xlsx'));
		Excel::import(new UserImport("kcp"), public_path('/excel/user_kcp.xlsx'));
	}

	
}
