<?php

namespace App\Http\Controllers\BRI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection\CollectionFile;

class DashboardController extends Controller
{
	public function pusatIndex(){
		$data['curRole'] = \Auth::user()->getRoleNames()->first();
		return view('pages.pusat.index')->with($data);
	}

	public function pusatWilayah(){
		$data['curRole'] = \Auth::user()->getRoleNames()->first();
		$data['curKotaId'] = \Auth::user()->userBri->kantorWilayah->id;
		return view('pages.wilayah.index')->with($data);
	}

	public function pusatCabang(){
		$data['curRole'] = \Auth::user()->getRoleNames()->first();
		// $data['curKancaId'] = \Auth::user()->userBri->unitKerja->id;
		$data['curKancaId'] = \Auth::user()->userBri->kanca_kode;
		$data['kanca'] = \Auth::user()->userBri->unitKerja2;
		// dd($data['curKancaId']);
		return view('pages.cabang.index')->with($data);
	}

	public function pusatCabangPembantu(){
		$data['curRole'] = \Auth::user()->getRoleNames()->first();
		$data['curKancaId'] = \Auth::user()->userBri->cabangPembantu->id;
		return view('pages.cabang_pembantu.index')->with($data);
	}

	public function pusatCabangKhusus(){
		$data['curRole'] = \Auth::user()->getRoleNames()->first();
		return view('pages.cabang_khusus.index')->with($data);
	}

	public function getDatatableBRI(Request $request){
		if ($request->ajax()) {
			$data = new CollectionFile();
			return $data->datatableCollection($request);
		}
	}

	public function ubahStatus(Request $request){
		$dataCol = CollectionFile::findOrFail($request->collection_id);

		if ($request->status == 18 && is_null($request->nominal_cair)) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Nominal plafond kredit harus diisi.",
			],422);
		}

		if ($request->status == 18 && is_null($request->norek_kredit)) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Norek kredit harus diisi.",
			],422);
		}

		if ($request->status == 18 && strlen($request->norek_kredit) != 15) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Norek kredit harus 15 digit.",
			],422);
		}

		if ($request->status == 12 && is_null($request->alasan_perbaikan_bri)) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Alasan perbaikan harus diisi.",
			],422);
		}

		if (strlen($request->alasan_perbaikan_bri) > 254) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Maksimal karakter alasan perbaikan bri hanya 255 karakter.",
			],422);
		}

		if ($request->status == 14 && is_null($request->alasan_tolak_bri)) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Alasan tolak harus diisi.",
			],422);
		}

		if (strlen($request->alasan_tolak_bri) > 254) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Maksimal karakter alasan tolak bri hanya 255 karakter.",
			],422);
		}

		$dataCol->update([
			'status_id'    => $request->status,
			'nominal_cair' => $request->nominal_cair ? str_replace(".", "", $request->nominal_cair) : null,
			'norek_kredit' => $request->norek_kredit ?? null,
			'alasan_perbaikan_bri' => $request->alasan_perbaikan_bri ?? null,
			'alasan_tolak_bri' => $request->alasan_tolak_bri ?? null
		]);
		\Helper::storeStatusHistory($dataCol->id, $request->status);
		return response()->json([
			'status'    => "ok",
			'messages'  => "Berhasil mengubah status data",
			'data' => $dataCol
		], 200);
	}
}
