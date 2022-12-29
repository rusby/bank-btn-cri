<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Collection\{
    CollectionFile,
    CollectionFileKeterangan,
    CollectionFileAdditional
};
use App\Models\Berkas\{
    DokumenUtamaKualifikasi,
    DokumenLainnya,
    DokumenTambahanLainnya,
    DokumenTambahanKualifikasi
};
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CollectionTabulasiExport;
use Carbon\Carbon;
use DB;

class CollectionController extends Controller
{
    public function index()
    {
        return view('pages.collection.aplikasi.index');
    }

    public function create()
    {
        return view('pages.collection.aplikasi.create');
    }

    public function edit($id)
    {
        $collection = CollectionFile::findOrFail($id);
        // dd($collection->dataDiri);
        // dd($collection->dokumenUtama->extension['form_permohonan_kpr']);
        return view('pages.collection.aplikasi.edit', compact('collection'));
    }

    public function show($id)
    {
        $collection = CollectionFile::findOrFail($id);
        $isShow     = true;
        // dd($collection->developer->project);
        // dd($collection->dokumenUtama->extension['form_permohonan_kpr']);
        return view('pages.collection.aplikasi.edit', compact('collection', 'isShow'));
    }

    public function store(Request $request)
    {
        //
    }

    public function getDatatble(Request $request){
        if ($request->ajax()) {
            $data = CollectionFile::with('unitKerja')->where('createdBy', \Auth::user()->id)
            ->when($request->filter_status, function($q) use($request){
                $q->whereStatusId($request->filter_status);
            })
            ->when($request->filter_jenis_kpr, function($q) use($request){
                $q->whereJenisKredit($request->filter_jenis_kpr);
            })
            ->when($request->filter_tanggal_mulai && $request->filter_tanggal_selesai, function($q) use($request){
                $q->whereBetween('updated_at', [$request->filter_tanggal_mulai." 00:00:00", $request->filter_tanggal_selesai." 23:59:59"]);
            })
            ->orderBy('updated_at', 'DESC');
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if (!$row->is_pengajuan) {
                    return \Helper::badgeStatus(0);
                }
                return \Helper::badgeStatus($row->status_id);
            })
            ->addColumn('nama_uker', function($row){
                return $row->uker_kode == 1039 ? "DKI Jakarta - Kantor Cabang Khusus" : "{$row->unitKerja->kantorWilayah->kota} - {$row->unitKerja->nama}";
            })
            ->addColumn('action', function($row){
                $actionBtn='';
                if ($row->status_id == 1 && !$row->is_pengajuan) {
                    $actionBtn = '<a href="'.route('collection.aplikasi.edit', $row->id).'" class="edit btn btn-warning btn-sm mr-1">Lanjutkan</a>';
                }elseif($row->status_id == 2 || $row->status_id == 6 || $row->status_id == 12){
                    $actionBtn = '<a href="'.route('collection.aplikasi.edit', $row->id).'" class="edit btn btn-warning btn-sm mr-1">Perbaikan Berkas</a>';
                }
                $actionBtn .= '<a href="'.route('collection.aplikasi.custom_detail', $row->id).'" class="edit btn btn-info btn-sm mr-1">Lihat Aplikasi</a>';
                $actionBtn .= '<a href="javascript:void(0)" class="btn btn-success btn-sm mb-1" id="btnHistory" data-id="'.$row->id.'">History Status</a>';
                return $actionBtn;
            })
            ->editColumn('updated_at', function($data){
                // $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->format('d-m-Y');
                return $data->is_pengajuan ? $data->updated_at : '-';
                
            })
            ->rawColumns(['action', 'status', 'nama_uker'])
            ->make(true);
        }
    }

    public function storeMappingName(Request $request){
        return \ApiHelper::mappingName($request);
    }


    public function storeKelengkapanBerkas(Request $request){
        return \ApiHelper::kelengkapanBerkas($request);
    }

    public function storeTambahanKelengkapanBerkas(Request $request){
        return \ApiHelper::tambahanKelengkapanBerkas($request);
    }

    public function storeDeveloperFile(Request $request){
        return \ApiHelper::developerFile($request);
    }

    public function listCollection(Request $request){
        $data = CollectionFile::with('dokumenUtama.dokumenUtamaLainnya.files', 'dokumenUtamaTambahan.dokumenTambahanLainnya.files', 'dokumenUtama.dokumenUtamaLainnya.files')
        ->when($request->id, function($q) use ($request){
            $q->where('id', $request->id);
        })
        // ->with(['historyStatus.status', 'historyStatus.user', 'developer.project.filesLainnya', 'dataDiri.pasangan', 'dataDiri.analisaFinansial', 'dataDiri.agunan', 'dataDiri.ujiFlpp'])
        ->where('createdBy', \Auth::user()->id)
        ->first();
        return response()->json([
            'status'    => "ok",
            'messages'  => "Berhasil mendapatkan data",
            'data'      =>  $data
        ], 200);
    }

    public function exportTabulasiSales(Request $req){
        $data = CollectionFile::orderBy('created_at', 'ASC')
        ->when($req->filter_status, function($q) use($req){
            $q->whereStatusId($req->filter_status);
        })
        ->when($req->filter_jenis_kpr, function($q) use($req){
            $q->whereJenisKredit($req->filter_jenis_kpr);
        })
        ->with(['unitKerja.kantorWilayah', 'userCreated'])
        ->where('createdBy', \Auth::user()->id)
        ->get();
        return Excel::download(new CollectionTabulasiExport($data), date('d-M-Y')."-tabulasi.xlsx");
    }
}
