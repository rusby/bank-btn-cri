<?php

namespace App\Traits\Collection;
use App\Models\Collection\CollectionFile;
use Illuminate\Http\Request;
use DB;

trait CollectionFileTrait {
	public function datatableCollection(Request $req){
		$user = \Auth::user()->userBri;
		$data = CollectionFile::with('unitKerja')
		->when($user->kanwil_id, function($q) use($user){
			$q->whereHas('unitKerja.kantorWilayah', function($query)use($user){
				$query->whereId($user->kanwil_id);
			});
		})
		->when($user->kanca_kode, function($q) use($user){
			$q->where(function($qq)use($user){
				$qq->whereHas('unitKerja', function($query)use($user){
					$query->where('kc_id', $user->kanca_kode)
					->orWhere('id', $user->kanca_kode);
				});
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
		->when($req->filter_kanwil == 1039 , function($q) use($req){
			$q->whereHas('unitKerja', function($query)use($req){
				$query->whereKode($req->filter_kanwil);
			});
		})
		->when($req->filter_kanwil && $req->filter_kanwil != 1039, function($q) use($req){
			$q->whereHas('unitKerja.kantorWilayah', function($query)use($req){
				$query->whereId($req->filter_kanwil);
			});
		})
		->when($req->filter_kanca && $req->filter_kanwil, function($q) use($req){
			$q->where(function($qq)use($req){
				$qq->whereHas('unitKerja', function($query)use($req){
					$query->whereKode($req->filter_kanca);
				});
				$qq->orWhereHas('unitKerja.kanca', function($query)use($req){
					$query->where('kode', $req->filter_kanca);
				});
			});			
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
		->where('status_id', '>', 9)
		->latest();
		return \DataTables::of($data)
		->addIndexColumn()
		->addColumn('status', function($row){
			return \Helper::badgeStatus($row->status_id);
		})
		->addColumn('nama_uker', function($row){
			return $row->unitKerja->kode == 1039 ? "Kantor Cabang Khusus" : "{$row->unitKerja->kantorWilayah->kota} - {$row->unitKerja->nama}";
		})
		->addColumn('action', function($row){
			$btn = '';
			if($row->status_id != 12 && $row->status_id != 14 && $row->status_id != 16 && $row->status_id != 18) {
				$btn = '<div><a href="'.url('operasional/collection-download?collection_id='.$row->id.' ').'" class="btn btn-info btn-sm p-1 mr-1 mb-1" id="btn-download">Download Berkas</a>';
				if ($row->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)') {
					$btn .= '<a href="'.route('export.collection', $row->id).'" class="btn btn-info btn-sm p-1 mb-1">Download Inputan</a>';
				}
				$btn .= '</div>';
			}

			if ($row->status_id > 10 && $row->status_id < 18) {
				if ($row->status_id != 12 && $row->status_id != 14) {
					$btn .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm p-1 mr-1 mb-1" data-toggle="modal" data-target="#modalUbahStatus" id="btnShowModal" data-collection_id="'.$row->id.'" data-status_id="'.$row->status_id.'" data-nama_debitur="'.$row->nama_calon_debitur.'" data-no_ktp="'.$row->no_ktp.'" data-nama_project="'.$row->nama_project.'" data-kanca="'.$row->unitKerja->nama.'" data-kanwil="'.( $row->uker_kode == 1039 ? 'Kantor Cabang Khusus' : $row->unitKerja->kantorWilayah->kota ?? $row->unitKerja->kantorWilayah->kota).'" data-nominal_cair="'.$row->nominal_cair.'">Ubah Status</a>';
				}else{
					// $btn .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm p-1 mr-1 mb-1" disabled>Ubah Status</a>';
				}
			}else{
				// $btn .= '<a href="javascript:void(0)" class="btn btn-warning btn-sm p-1 mr-1 mb-1" disabled>Ubah Status</a>';
			}
			$btn .= '<a href="'.route('collection.aplikasi.custom_detail', $row->id).'" class="btn btn-info btn-sm mr-1 p-1 mb-1" target="_blank">Lihat Aplikasi</a>';

			$btn .= '<a href="javascript:void(0)" class="btn btn-success btn-sm p-1 mb-1" id="btnHistory" data-id="'.$row->id.'">History Status</a>';

			return $btn;
		})
		->rawColumns(['action', 'status', 'nama_uker'])
		->make(true);
	}
}
