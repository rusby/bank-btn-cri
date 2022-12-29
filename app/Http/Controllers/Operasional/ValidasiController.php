<?php

namespace App\Http\Controllers\Operasional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Collection\{
    CollectionFile,
    CollectionFileKeterangan,
    CollectionFileAdditional
};

class ValidasiController extends Controller
{
    public function index()
    {
        return view('pages.operasional.validasi.index');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $collection = CollectionFile::with('dokumenUtama')->findOrFail($id);
        $cD = \Schema::getColumnListing('data_diri');
        unset($cD[0], $cD[1]);
        for ($i=29; $i <= 32; $i++) {
            unset($cD[$i]);
        }
        $colDataDiri = [];
        foreach ($cD as $value) {
            if(strpos($value, "_") !== false){
                $a = explode("_", $value);
                if (count($a) == 2) {
                    array_push($colDataDiri, ucfirst($a[0]).' '.$a[1].'-'.$value);
                }else if(count($a) == 3){
                    array_push($colDataDiri, ucfirst($a[0]).' '.$a[1].' '.$a[2].'-'.$value);
                }else if(count($a) == 4){
                    array_push($colDataDiri, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].'-'.$value);
                }
            }else{
                array_push($colDataDiri, ucfirst($value).'-'.$value);
            }
        }

        if (substr($collection->jenis_kredit, 0,10) == 'KPR Tapera' || $collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)')
        {
            // dd(11);
        }else
        {
            if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)') {
                $colDataPasangan = [];
                if ($collection->dataDiri->pasangan) {
                    $cP = \Schema::getColumnListing('data_pasangan');
                    unset($cP[0], $cP[1]);
                    for ($i=5; $i <= 9; $i++) {
                        unset($cP[$i]);
                    }
                    foreach ($cP as $value) {
                        if(strpos($value, "_") !== false){
                            $a = explode("_", $value);
                            if (count($a) == 2) {
                                array_push($colDataPasangan, ucfirst($a[0]).' '.$a[1].'-'.$value);
                            }else if(count($a) == 3){
                                array_push($colDataPasangan, ucfirst($a[0]).' '.$a[1].' '.$a[2].'-'.$value);
                            }else if(count($a) == 4){
                                array_push($colDataPasangan, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].'-'.$value);
                            }
                        }else{
                            array_push($colDataPasangan, ucfirst($value).'-'.$value);
                        }
                    }
                }

                $colAnalisaFinansial = [];
                if ($collection->dataDiri->analisaFinansial) {
                    $cAF = \Schema::getColumnListing('data_analisa_finansial');
                    unset($cAF[0], $cAF[1]);
                    for ($i=12; $i <= 15; $i++) {
                        unset($cAF[$i]);
                    }
                    foreach ($cAF as $value) {
                        if(strpos($value, "_") !== false){
                            $a = explode("_", $value);
                            if (count($a) == 2) {
                                array_push($colAnalisaFinansial, ucfirst($a[0]).' '.$a[1].'-'.$value);
                            }else if(count($a) == 3){
                                array_push($colAnalisaFinansial, ucfirst($a[0]).' '.$a[1].' '.$a[2].'-'.$value);
                            }else if(count($a) == 4){
                                array_push($colAnalisaFinansial, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].'-'.$value);
                            }else if(count($a) == 5){
                                array_push($colAnalisaFinansial, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].' '.$a[4].'-'.$value);
                            }
                        }else{
                            array_push($colAnalisaFinansial, ucfirst($value).'-'.$value);
                        }
                    }
                }

                $colAgunan = [];
                if ($collection->dataDiri->agunan) {
                    $cDA = \Schema::getColumnListing('data_agunan');
                    unset($cDA[0], $cDA[1]);
                    for ($i=24; $i <= 27; $i++) {
                        unset($cDA[$i]);
                    }
                    foreach ($cDA as $value) {
                        if(strpos($value, "_") !== false){
                            $a = explode("_", $value);
                            if (count($a) == 2) {
                                array_push($colAgunan, ucfirst($a[0]).' '.$a[1].'-'.$value);
                            }else if(count($a) == 3){
                                array_push($colAgunan, ucfirst($a[0]).' '.$a[1].' '.$a[2].'-'.$value);
                            }else if(count($a) == 4){
                                array_push($colAgunan, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].'-'.$value);
                            }else if(count($a) == 5){
                                array_push($colAgunan, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].' '.$a[4].'-'.$value);
                            }
                        }else{
                            array_push($colAgunan, ucfirst($value).'-'.$value);
                        }
                    }
                }

                $colFlpp = [];
                if ($collection->dataDiri->ujiFlpp) {
                    $cUF = \Schema::getColumnListing('uji_data_flpp');
                    // dd($cUF);
                    unset($cUF[0], $cUF[1]);
                    for ($i=17; $i <= 20; $i++) {
                        unset($cUF[$i]);
                    }
                    foreach ($cUF as $value) {
                        if(strpos($value, "_") !== false){
                            $a = explode("_", $value);
                            if (count($a) == 2) {
                                array_push($colFlpp, ucfirst($a[0]).' '.$a[1].'-'.$value);
                            }else if(count($a) == 3){
                                array_push($colFlpp, ucfirst($a[0]).' '.$a[1].' '.$a[2].'-'.$value);
                            }else if(count($a) == 4){
                                array_push($colFlpp, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].'-'.$value);
                            }else if(count($a) == 5){
                                array_push($colFlpp, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].' '.$a[4].'-'.$value);
                            }
                        }else{
                            array_push($colFlpp, ucfirst($value).'-'.$value);
                        }
                    }
                }
            }

            $f = \Schema::getColumnListing('flpp_files');
            unset($f[0], $f[1], $f[2], $f[15], $f[16]);
            $flpp = [];
            foreach ($f as $value) {
                if(strpos($value, "_") !== false){
                    $a = explode("_", $value);
                    if (count($a) == 2) {
                        array_push($flpp, ucfirst($a[0]).' '.$a[1].'-'.$value);
                    }else if(count($a) == 3){
                        array_push($flpp, ucfirst($a[0]).' '.$a[1].' '.$a[2].'-'.$value);
                    }else if(count($a) == 4){
                        array_push($flpp, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].'-'.$value);
                    }
                }else{
                    array_push($flpp, ucfirst($value).'-'.$value);
                }
            }

            $t = \Schema::getColumnListing('flpp_files_tambahans');
            unset($t[0], $t[1], $t[2], $t[9], $t[10]);

            $flppTambahan = [];
            foreach ($t as $value) {
                if(strpos($value, "_") !== false){
                    $a = explode("_", $value);
                    if (count($a) == 2) {
                        array_push($flppTambahan, ucfirst($a[0]).' '.$a[1].'-'.$value);
                    }else if(count($a) == 3){
                        array_push($flppTambahan, ucfirst($a[0]).' '.$a[1].' '.$a[2].'-'.$value);
                    }else if(count($a) == 4){
                        array_push($flppTambahan, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].'-'.$value);
                    }else if(count($a) == 5){
                        array_push($flppTambahan, ucfirst($a[0]).' '.$a[1].' '.$a[2].' '.$a[3].' '.$a[4].'-'.$value);
                    }
                }
            }
            if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)') {
                return view('pages.operasional.validasi.show', compact('collection', 'flpp', 'flppTambahan', 'colDataDiri', 'colDataPasangan', 'colAnalisaFinansial', 'colAgunan', 'colFlpp'));
            }else if($collection->jenis_kredit == 'KPR Komersial (Baru atau Secondary)'){
                return view('pages.operasional.validasi.show', compact('collection', 'flpp', 'flppTambahan'));
            }
        }
        return view('pages.operasional.validasi.show-bptapera', compact('collection'));
    }

    public function edit($id)
    {

    }

    public function customUpdate(Request $request, $id)
    {
        if ($request->status == "ditolak") {
            $validator = Validator::make($request->only(['alasan_tolak_verifikasi']), [
                'alasan_tolak_verifikasi' => 'required|max:255'
            ]);
            if($validator->fails()) {
                return response()->json([
                    'status'    => "fail",
                    'messages'  => "Alasan perbaikan verifikasi maksimal 255 karakter",
                ],422);
            }
        }
        try {
            DB::beginTransaction();
            $dataCol = CollectionFile::updateOrCreate(
                ['id' => $id],
                [
                    'status_id' => $request->status == "diterima" ? 9 : 6,
                    'alasan_tolak_verifikasi' => $request->alasan_tolak_verifikasi
                ]
            );
            \Helper::storeStatusHistory($dataCol->id, $dataCol->status_id);
            DB::commit();

            return response()->json([
                'status'    => "ok",
                'messages'  => $request->status == "diterima" ? "Berhasil verifikasi data" : "Berhasil menolak data" ,
                'data'      => $dataCol
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status'    => "fail",
                'messages'  => "Ada kesalahan dalam input data",
            ],422);
        }
    }

    public function destroy($id)
    {
        //
    }

    public function getDatatble(Request $request){
        if ($request->ajax()) {
            $data = CollectionFile::with('dataDiri')->whereIn('status_id', [4,6,7,8,9,10])
            ->when($request->filter_jenis_kpr, function($q) use($request){
                $q->whereJenisKredit($request->filter_jenis_kpr);
            })
            ->orderBy('updated_at', 'DESC');
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                return \Helper::badgeStatus($row->status_id);
            })
            ->addColumn('nama_uker', function($row){
                return $row->uker_kode == 1039 ? "DKI Jakarta - Kantor Cabang Khusus" : "{$row->unitKerja->kantorWilayah->kota} - {$row->unitKerja->nama}";
            })
            ->addColumn('action', function($row){
                // $actionBtn = '<a href="'.route('collection.aplikasi.custom_detail', $row->id).'" class="btn btn-info btn-sm my-1" target="_blank">Lihat Aplikasi</a>';
                $actionBtn = '';
                if ($row->jenis_kredit != 'KPR Subsidi FLPP (Fix Income)') {
                    if ($row->status_id == 4 || $row->status_id == 7) {
                        $actionBtn .= '<a href="'.route('v_detail', $row->id).'" class="edit btn btn-info btn-sm">Verifikasi</a>';
                    }else{
                        // $actionBtn .= '<a href="javascript::void" class="edit btn btn-info btn-sm" disabled>Verifikasi</a>';
                    }
                }elseif ($row->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)') {
                    if ($row->status_id == 8 || $row->status_id == 7) {
                        $actionBtn .= '<a href="'.route('v_detail', $row->id).'" class="edit btn btn-info btn-sm">Verifikasi</a>';
                    }else{
                        // $actionBtn .= '<a href="javascript::void" class="edit btn btn-info btn-sm" disabled>Verifikasi</a>';
                    }
                }
                if ($row->status_id != 9) {
                    $actionBtn .= '<a href="javascript::void(0)" class="btn btn-success btn-sm ml-1" data-toggle="modal" data-target="#exampleModal" id="btnShowModal" data-nama_debitur="'.$row->nama_calon_debitur.'" data-no_ktp="'.$row->no_ktp.'" data-nama_project="'.$row->nama_project.'" data-unit_kerja="'.($row->uker_kode == 1039 ? "Kantor Cabang Khusus" : $row->unitKerja->nama).'" disabled>Kirim</a>';
                }else{
                    $actionBtn .= '<a href="javascript::void(0)" class="btn btn-success btn-sm ml-1" data-toggle="modal" data-target="#modalKirimData" id="btnShowModal" data-collection_id="'.$row->id.'" data-nama_debitur="'.$row->nama_calon_debitur.'" data-no_ktp="'.$row->no_ktp.'" data-nama_project="'.$row->nama_project.'" data-unit_kerja="'.($row->uker_kode == 1039 ? "Kantor Cabang Khusus" : $row->unitKerja->nama).'" data-kanwil_id="'.( $row->uker_kode == 1039 ? 1039 : $row->unitKerja->kantorWilayah->id).'" data-cabang_kode="'.($row->uker_kode == 1039 ? 1039 : $row->unitKerja->kode).'" data-jenis_kredit="'.$row->jenis_kredit.'">Kirim</a>';
                }
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'nama_uker'])
            ->make(true);
        }
    }

    public function kirimData(Request $request){
        $dataCol = CollectionFile::findOrFail($request->collection_id);
        \Helper::storeStatusHistory($dataCol->id, 10);
        $dataCol->update([
            'status_id' => 10,
            'uker_kode' => $request->kantor_wilayah == 1039 ? 1039 : $request->kantor_cabang,
            'uker_kode_baru' => $request->kantor_wilayah == 1039 ? 1039 : $request->kantor_cabang,
            'tgl_terkirim' => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'status'    => "ok",
            'messages'  => "Berhasil mengirim data ke BRI",
            'data'      => $request->all()
        ], 200);
    }
}
