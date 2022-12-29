<?php

namespace App\Http\Controllers\api\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kota as KotaModel;
use App\Models\KantorCabang;
use Illuminate\Support\Arr;

class Kota extends Controller
{
	public function main(Request $request) {
		$data = $request->all();

		$table = KotaModel::select( 'id', 'kota' )->orderby('kota','asc')
		->when($request->is_kanwil, function($q){
			$q->where('is_kanwil', true);
		})
		->when($request->is_not_kanwil, function($q){
			$q->where('is_kanwil', false);
		});

		if ( isset($data['limit']) ) {
			$table->take($data['limit']);

			if ( isset($data['offset']) ) {
				$table->skip($data['offset']);
			}
		}

		if ( isset($data['id_provinsi']) ) {
			$table->where( "id_provinsi" , "LIKE" ,$data['id_provinsi'] );
		}

		if ( isset($data['filter']) ) {
			$table->where( "kota" , "LIKE" ,($data['filter'] ? '%'.$data['filter'].'%' : '%%') );
		}
		$table = $table->get();
		if ($request->adding_kck) {
			$table->push(['id' => 1039, 'kode' => 1039, 'kota' => 'Kantor Cabang Khusus']);
		}	

		if (count($table) == 0 ) {
			return response()->json([
				'status_code' => 204,
				'data' => $table
			],200);
		} else {
			return response()->json([
				'status_code' => 200,
				'data' => $table
			],200);
		}
	}

	public function kantorCabang(Request $request){
		$table = KantorCabang::leftJoin('kota', 'kantor_cabangs.kota_id', 'kota.id')
		->select(\DB::raw('CONCAT("Cabang ", kantor_cabangs.nama, " - Kanwil BRI ", kota.kota) AS nama'), 'kantor_cabangs.kode', 'kantor_cabangs.id', 'kantor_cabangs.kc_id')
		->when($request->search, function($q)use($request){
			$q->where('kantor_cabangs.nama', 'LIKE', "%{$request->search}%");
			  // ->orWhereHas('kcp', function($q2)use($request){
			  // 	$q2->where('nama', 'LIKE', "%{$request->search}%");
			  // });
		})
		->when($request->kota_id, function($q)use($request){
			$q->where('kantor_cabangs.kota_id', $request->kota_id);
		})
		->when($request->provinsi_id, function($q)use($request){
									// $q->whereHas('kantorWilayah.provinsi', function($q2)use($request){
									// 	$q2->where('id', $request->provinsi_id);
									// });
			$q->where('cust_provinsi_id', $request->provinsi_id);
		})
		->when(is_null($request->kanca_id), function($q)use($request){
			$q->whereNull('kc_id');
		})
		->when($request->kanca_id, function($q)use($request){
			$q->where('kantor_cabangs.kc_id', $request->kanca_id);
		})
		->where('kode', '!=', 1039)
		->with('kcp')
		->orderBy('kantor_cabangs.nama', 'ASC')
		->get();
		if ($request->provinsi_id == 6) {
			$table->push(['nama' => 'Kantor Cabang Khusus', 'id' => 1039, 'kode' => 1039, 'kc_id' => null, 'kcp' => []]);
		}
		if (count($table) == 0 ) {
			return response()->json([
				'status_code' => 204,
				'data' => $table
			],200);
		} else {
			return response()->json([
				'status_code' => 200,
				'data' => $table
			],200);
		}
	}

	public function data($data){

	}

	public function getKancaCustom(Request $request){
		$table = KantorCabang::whereNull('kc_id')
		->when($request->provinsi_id, function($q)use($request){
			$q->where('cust_provinsi_id', $request->provinsi_id);
		})
		->when($request->search, function($q)use($request){
			$q->where('nama', 'LIKE', "%{$request->search}%")
			   ->orWhereHas('kcp', function($q2)use($request){
			   		$q2->where('nama', 'LIKE', "%{$request->search}%");
			   });
		})
		->orderBy('nama', 'asc')
		->get();
		$arrangedKanca  = [];
		foreach ($table as $data) {
			$arrParent = [];
			$arrParent['id'] = $data->id;
			$arrParent['kode'] = $data->kode;
			// $arrParent['kc_id'] = $data->kc_id;
			$arrParent['cust_provinsi_id'] = $data->cust_provinsi_id;
			$arrParent['nama'] = "Cabang ". $data->nama;
			
			$child = KantorCabang::where('kc_id', $data->id)
			->when($request->search, function($q)use($request){
				$q->where('nama', 'LIKE', "%{$request->search}%");
			})
			->get();
			array_push($arrangedKanca, $arrParent);
			foreach ($child as $c) {
				$arrChild['id'] = $c->id;
				$arrChild['kode'] = $c->kode;
				$arrChild['kc_id'] = $c->kc_id;
				$arrChild['cust_provinsi_id'] = $c->cust_provinsi_id;
				$arrChild['nama'] = $c->nama;

				array_push($arrangedKanca, $arrChild);
			}
		}

		// $filteredArray = array_filter($arrangedKanca, function ($item) {
		// 	return $item["cust_provinsi_id"] == 6;
		// });
		// $ea = collect($arrangedKanca)->where('cust_provinsi_id', 6)->all();
		
		return response()->json([
			'status_code' => 200,
			'data' => $arrangedKanca
		],200);
	}
}
