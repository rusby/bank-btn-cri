<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection\{
	CollectionFile,
	CollectionStatus,
	CollStatusHistory
};
use DB;
use App\Http\Controllers\CRIController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CollectionTabulasiExport;

class DebiturController extends Controller{

	public function totalCollection(Request $request){
		return response()->json([
			'status'    => "ok",
			'messages'  => "Berhasil mendapatkan data",
			'data' 		=> [
				[
					'id'   => 0,
					'nama' => "Draft",
					'total'=> \Helper::getTotal(0)
				],
				[
					'id'   => 1,
					'nama' => "Belum dicek",
					'total'=> \Helper::getTotal(1)
				],
				[
					'id'   => 2,
					'nama' => "Berkas Tidak Lengkap",
					'total'=> \Helper::getTotal(2)
				],
				[
					'id'   => 3,
					'nama' => "Pengajuan Kembali Berkas",
					'total'=> \Helper::getTotal(3)
				],
				[
					'id'   => 4,
					'nama' => "Selesai Pengecekan Berkas",
					'total'=> \Helper::getTotal(4)
				],
				[
					'id'   => 6,
					'nama' => "Ditolak Verifikasi",
					'total'=> \Helper::getTotal(6)
				],
				[
					'id'   => 10,
					'nama' => "Terkirim ke Uker BRI",
					'total'=> \Helper::getTotal(10)
				],
				[
					'id'   => 11,
					'nama' => "Diterima Uker BRI",
					'total'=> \Helper::getTotal(11)
				],
				[
					'id'   => 12,
					'nama' => "Perbaikan BRI",
					'total'=> \Helper::getTotal(12)
				],
				[
					'id'   => 13,
					'nama' => "Analisa dan Verifikasi BRI",
					'total'=> \Helper::getTotal(13)
				],
				[
					'id'   => 14,
					'nama' => "Putus Tolak BRI",
					'total'=> \Helper::getTotal(14)
				],
				[
					'id'   => 15,
					'nama' => "Putus Terima BRI",
					'total'=> \Helper::getTotal(15)
				],
				[
					'id'   => 16,
					'nama' => "Calon Debitur Membatalkan BRI",
					'total'=> \Helper::getTotal(16)
				],
				[
					'id'   => 17,
					'nama' => "Akad Kredit BRI",
					'total'=> \Helper::getTotal(17)
				],
				[
					'id'   => 18,
					'nama' => "Pencairan BRI",
					'total'=> \Helper::getTotal(18)
				],
				[
					'nama' => "Total",
					'total'=> \Helper::getTotal(99)
				]
			]
		], 200);
	}

	public function listCollection(Request $request){
		$data = CollectionFile::with('dokumenUtama.dokumenUtamaLainnya.files', 'dokumenUtamaTambahan.dokumenTambahanLainnya.files')
		->when($request->id, function($q) use ($request){
			$q->where('id', $request->id);
		})
		->when(!is_null($request->status_id) && $request->status_id == 0, function($q) use ($request){
			$q->where([
				['status_id', 1],
				['is_pengajuan', false]
			]);
		})
		->when($request->status_id != 0, function($q) use ($request){
			$q->where([
				['status_id', $request->status_id],
				['is_pengajuan', true]
			]);
		})
		->when($request->nama, function($q) use ($request){
			$q->where('nama_calon_debitur', 'like', "%{$request->nama}%");
		})
		->with(['historyStatus.status', 'historyStatus.user', 'developer.project.filesLainnya', 'dataDiri.pasangan', 'dataDiri.analisaFinansial', 'dataDiri.agunan', 'dataDiri.ujiFlpp'])
		->where('createdBy', \Auth::user()->id)
		->latest()
		->get();
// 		->paginate(10);
		return response()->json([
			'status'    => "ok",
			'messages'  => "Berhasil mendapatkan data",
			'data'      =>  $data
		], 200);
	}

	public function getStatus(Request $request){
// 		$data = CollectionStatus::when($request->status_id, function($q) use ($request){
// 			$q->where('id', '>', $request->status_id);
// 		})
		$data = CollectionStatus::when($request->status_id && $request->status_id == 13, function($q) use ($request){
			$q->where('id', '>=', 12);
		})
		->when($request->status_id && $request->status_id != 13, function($q) use ($request){
			$q->where('id', '>', $request->status_id);
		})
		->where('is_aktif', true)
		->whereIn('id', [1, 2, 3, 4, 6, 10, 11, 12, 13, 14, 15, 16, 17, 18])
		->get();
		// array_push($data, [
		// 	'id' => 0,
		// 	'nama' => 'Draft'
		// ]);
		// $id = array();
		// foreach ($data as $key => $row)
		// {
		// 	$id[$key] = $row['id'];
		// }
		// array_multisort($id, SORT_ASC, $data);

		return response()->json([
			'status'    => "ok",
			'messages'  => "Berhasil mendapatkan data",
			'data'      =>  $data
		], 200);
	}

	public function getStatusHistory(Request $request){
		$data = CollStatusHistory::when($request->collection_id, function($q) use ($request){
			$q->where('collection_id', $request->collection_id);
		})
		->with(['status', 'user'])
		->latest()
		->get();
		return response()->json([
			'status'    => "ok",
			'messages'  => "Berhasil mendapatkan data",
			'data'      =>  $data
		], 200);
	}

	public function getDokumen($type){
		if ($type == 'form-kpr') {
			$file = public_path(). "/zip/form-kpr.pdf";
		}else if ($type == 'manual-book') {
			$file = public_path(). "/zip/Manual-Book-Marketing.zip";
		}else if ($type == 'apk') {
			$file = public_path(). "/zip/apps-cri.apk";
		}else if($type == 'manual-book-bri'){
			$file = public_path(). "/zip/Manual-Book-BRI.pdf";
		} else{
			$file = public_path(). "/zip/{$type}.zip";
		}
		return response()->download($file);
	}

	public function exportExcel(Request $req){
		$collections = CollectionFile::orderBy('created_at', 'ASC')
		->when($req->filter_status, function($q) use($req){
			$q->where('status_id', $req->filter_status);
		})
		->where('createdBy', \Auth::user()->id)
		->get();
		return Excel::download(new CollectionTabulasiExport($collections), date('d-M-Y')."-tabulasi.xlsx");
	}
}