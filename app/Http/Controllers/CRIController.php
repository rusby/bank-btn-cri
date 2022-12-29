<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\File;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\User;
use App\Models\Collection\CollectionFile;
use DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\{
    CollectionFileExport,
    CollectionTabulasiExport
};
use App\Imports\{
    UkerImport,
    UserImport
};
use Spatie\Permission\Models\Role;

class CRIController extends Controller
{
    public function laporan()
    {
        $data['roles'] = Role::whereIn('name', ['sales developer', 'sales lepas', 'Marketing SFT BRI'])->get();

        return view('cri.laporan')->with($data);
    }

    public function datatableLaporan(Request $req){
        $data = CollectionFile::with('unitKerja')
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
            $q->where(function($q2)use($req){
                $q2->whereHas('unitKerja', function($query)use($req){
                    $query->whereKode($req->filter_kanca);
                });
                $q2->orWhereHas('unitKerja.kanca', function($query)use($req){
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
            $q->where('status_id', $req->filter_status);
        })
        ->when($req->filter_jenis_kpr, function($q) use($req){
            $q->whereJenisKredit($req->filter_jenis_kpr);
        })
        ->when($req->filter_tanggal_mulai && $req->filter_tanggal_selesai, function($q) use($req){
            $q->whereBetween('tgl_terkirim', [$req->filter_tanggal_mulai." 00:00:00", $req->filter_tanggal_selesai." 23:59:59"]);
        })
        ->when($req->filter_marketing, function($q) use($req){
            $q->whereHas('userCreated.roles', function($query)use($req){
                $query->whereId($req->filter_marketing);
            });
        })
        ->where('is_pengajuan', true)
        ->orderBy('updated_at', 'DESC');
        return \DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('status', function($row){
            return \Helper::badgeStatus($row->status_id);
        })
        ->addColumn('nama_uker', function($row){
            return $row->unitKerja->kode == 1039 ? "Kantor Cabang Khusus" : "{$row->unitKerja->kantorWilayah->kota} - {$row->unitKerja->nama}";
        })
        ->addColumn('action', function($row){
            $btn = '<div><a href="'.url('operasional/collection-download?collection_id='.$row->id.' ').'" class="btn btn-info btn-sm p-1 mr-1 mb-1" id="btn-download">Download Berkas</a>';
            if ($row->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)') {
                $btn .= '<a href="'.route('export.collection', $row->id).'" class="btn btn-info btn-sm p-1 mb-1">Download Inputan</a>';
            }
            $btn .= '</div>';
            $btn .= '<a href="'.route('collection.aplikasi.custom_detail', $row->id).'" class="btn btn-info btn-sm mr-1 p-1 mb-1" target="_blank">Lihat Aplikasi</a>';

            $btn .= '<a href="javascript:void(0)" class="btn btn-success btn-sm p-1 mb-1" id="btnHistory" data-id="'.$row->id.'">History Status</a>';
            $btn .= '<a href="'.route('operasional.collection.cust_delete', $row->id).'" class="edit btn btn-danger btn-sm p-1 mb-1" id="btnHapusCollection">Hapus Data</a>';

            return $btn;
        })
        ->editColumn('tgl_terkirim', function($row){
            if ($row->status_id > 9) {
                return $row->tgl_terkirim;
            }
            return '-';
        })
        ->rawColumns(['action', 'status', 'nama_uker'])
        ->make(true);
    }

    public function exportTabulasiCRI(Request $req){
        $data = CollectionFile::orderBy('created_at', 'ASC')
        ->when($req->filter_kanwil, function($q) use($req){
            $q->whereHas('unitKerja.kantorWilayah', function($query)use($req){
                $query->whereId($req->filter_kanwil);
            });
        })
        ->when($req->filter_kanca && $req->filter_kanwil, function($q) use($req){
            $q->where(function($q2)use($req){
                $q2->whereHas('unitKerja', function($query)use($req){
                    $query->whereKode($req->filter_kanca);
                });
                $q2->orWhereHas('unitKerja.kanca', function($query)use($req){
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
            $q->where('status_id', $req->filter_status);
        })
        ->when($req->filter_jenis_kpr, function($q) use($req){
            $q->whereJenisKredit($req->filter_jenis_kpr);
        })
        ->when($req->filter_tanggal_mulai && $req->filter_tanggal_selesai, function($q) use($req){
            $q->whereBetween('tgl_terkirim', [$req->filter_tanggal_mulai." 00:00:00", $req->filter_tanggal_selesai." 23:59:59"]);
        })
        ->with(['unitKerja.kantorWilayah', 'userCreated'])
        ->where('is_pengajuan', true)
        ->get();
        return Excel::download(new CollectionTabulasiExport($data), date('d-M-Y')."-tabulasi.xlsx");
    }
}
