<?php

namespace App\Http\Controllers\Operasional;

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
use Carbon\Carbon;
use DB;

class CollectionController extends Controller
{
    public function index()
    {
        return view('pages.operasional.collection.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $data = CollectionFile::findOrFail($id);

        if (substr($data->jenis_kredit, 0,10) == 'KPR Tapera' || $data->jenis_kredit == 'KPR BP2BT (Non Fix Income)') {
            return view('pages.operasional.collection.show-bptapera', compact('data'));
        }else{
            return view('pages.operasional.collection.show', compact('data'));
        }
    }

    public function edit($id)
    {
        $collection = CollectionFile::with('dokumenUtama')->where('status_id', '>', 3)->findOrFail($id);
        return view('pages.operasional.collection.edit', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $selCollection = CollectionFile::findOrFail($id);
        if ($request->status == "ditolak") {
            $validator = Validator::make($request->only(['alasan_tolak']), [
					'alasan_tolak' => 'required|max:255'
				]);
				if($validator->fails()) {
					return response()->json([
						'status'    => "fail",
						'messages'  => "Alasan perbaikan maksimal 255 karakter",
					],422);
				}
        }

        try {
            DB::beginTransaction();

            $data = CollectionFile::updateOrCreate(
                ['id'           => $id],
                [
                    'status_id'    => $request->status == "diterima" ? 4 : 2,
                    'alasan_tolak' => $request->alasan_tolak ?? null
                ]
            );
            \Helper::storeStatusHistory($data->id, $data->status_id);

            DokumenUtamaKualifikasi::updateOrCreate(
                    ['dokumen_utama_id' => $data->dokumenUtama->id],
                    [
                        'ktp_pengajuan'=> isset($request->keterangan_ktp_pengajuan) ? true : false,
                        'ktp_pasangan'=> isset($request->keterangan_ktp_pasangan) ? true : false,
                        'npwp'=> isset($request->keterangan_npwp) ? true : false,
                        'kartu_keluarga'=> isset($request->keterangan_kartu_keluarga) ? true : false,
                        'akta_nikah'=> isset($request->keterangan_akta_nikah) ? true : false,
                        'surat_cerai'=> isset($request->keterangan_surat_cerai) ? true : false,
                        'keterangan_belum_nikah'=> isset($request->keterangan_keterangan_belum_nikah) ? true : false,
                        'form_permohonan_kpr'=> isset($request->keterangan_form_permohonan_kpr) ? true : false,
                        'copy_sk_pegawai_tetap'=> isset($request->keterangan_copy_sk_pegawai_tetap) ? true : false,
                        'asli_sk_aktif_bekerja'=> isset($request->keterangan_asli_sk_aktif_bekerja) ? true : false,
                        'asli_slip_gaji'=> isset($request->keterangan_asli_slip_gaji) ? true : false,
                        'asli_rekening_koran'=> isset($request->keterangan_asli_rekening_koran) ? true : false,
                        'spr_dari_developer'=> isset($request->keterangan_spr_dari_developer) ? true : false,
                        'surat_keterangan_usaha'=> isset($request->keterangan_surat_keterangan_usaha) ? true : false,
                        'tabungan_3bulan_terakhir'=> isset($request->keterangan_tabungan_3bulan_terakhir) ? true : false,
                        'spt_pajak_penghasilan'=> isset($request->keterangan_spt_pajak_penghasilan) ? true : false,
                        'surat_pernyataan_pengajuan_fasilitas_tapera'=> isset($request->keterangan_surat_pernyataan_pengajuan_fasilitas_tapera) ? true : false,
                        'surat_pernyataan_kesanggupan_potonggaji'=> isset($request->keterangan_surat_pernyataan_kesanggupan_potonggaji) ? true : false,
                        'surat_pernyataan_kepemilikan_rumah'=> isset($request->keterangan_surat_pernyataan_kepemilikan_rumah) ? true : false,
                        'surat_pernyataan_tidak_menerima_rumah_subsidi'=> isset($request->keterangan_surat_pernyataan_tidak_menerima_rumah_subsidi) ? true : false,
                        'surat_pernyataan_pemohon_dana_bp2bt'=> isset($request->keterangan_surat_pernyataan_pemohon_dana_bp2bt) ? true : false,
                        'dokumen_struktur_beton_rumah'=> isset($request->keterangan_dokumen_struktur_beton_rumah) ? true : false,
                        'surat_pernyataan_kelayakan_fungsi_bangunan_rumah'=> isset($request->keterangan_surat_pernyataan_kelayakan_fungsi_bangunan_rumah) ? true : false,
                        'memiliki_lahan'=> isset($request->keterangan_memiliki_lahan) ? true : false,
                        'pas_foto'=> isset($request->keterangan_pas_foto) ? true : false,
                        'surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu'=> isset($request->keterangan_surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu) ? true : false,
                        'foto_fisik_bangunan_psu'=> isset($request->keterangan_foto_fisik_bangunan_psu) ? true : false,
                        'foto_rumah_kondisi_awal'=> isset($request->keterangan_foto_rumah_kondisi_awal) ? true : false,
                        'rab_pembangunan_rumah_dan_renovasi_rumah'=> isset($request->keterangan_rab_pembangunan_rumah_dan_renovasi_rumah) ? true : false,
                        'surat_izin_profesi'=> isset($request->keterangan_surat_izin_profesi) ? true : false,
                        'izin_usaha'=> isset($request->keterangan_izin_usaha) ? true : false,
                        'akta_pendirian_perusahaan'=> isset($request->keterangan_akta_pendirian_perusahaan) ? true : false,
                        'dokumen_pengajuan_sikasep'=> isset($request->keterangan_dokumen_pengajuan_sikasep) ? true : false,
                        'createdBy'    => \Auth::user()->id,
                        'updatedBy'    => \Auth::user()->id,
                        'updated_at'   => date('Y-m-d H:i:s')
                    ]
            );
            $notId = [];
            if (isset($request->dokumen_lain)) {
                foreach ($request->dokumen_lain as $key => $value) {
                    array_push($notId, $value);
                    DokumenLainnya::updateOrCreate(
                        ['id'    => $value],
                        ['lolos' => true]
                    );
                }
            }
            DokumenLainnya::whereNotIn('id', $notId)->where('dokumen_utama_id', $data->dokumenUtama->id)->update([
                'lolos' => false
            ]);

            if ($data->dokumenUtamaTambahan()->exists()) {
                DokumenTambahanKualifikasi::updateOrCreate(
                    ['dokumen_tambahan_id' => $data->dokumenUtamaTambahan->id],
                    [
                        'surat_pernyataan_belum_memiliki_rumah' => isset($request->keterangan_surat_pernyataan_belum_memiliki_rumah) ? true : false,
                        'surat_pernyataan_pemohon' => isset($request->keterangan_surat_pernyataan_pemohon) ? true : false,
                        'surat_status_kepemilikan_rumah' => isset($request->keterangan_surat_status_kepemilikan_rumah) ? true : false,
                        'surat_pernyataan_penghasilan' => isset($request->keterangan_surat_pernyataan_penghasilan) ? true : false,
                        'surat_pernyataan_verifikasi' => isset($request->keterangan_surat_pernyataan_verifikasi) ? true : false,
                        'createdBy'             => \Auth::user()->id,
                        'updatedBy'             => \Auth::user()->id,
                        'updated_at'             => date('Y-m-d H:i:s')
                    ]
                );

                $notId = [];
                if (isset($request->dokumen_tambahan_lain)) {
                    foreach ($request->dokumen_tambahan_lain as $key => $value) {
                        array_push($notId, $value);
                        DokumenTambahanLainnya::updateOrCreate(
                            ['id'    => $value],
                            ['lolos' => true]
                        );
                    }
                }
                DokumenTambahanLainnya::whereNotIn('id', $notId)->where('dokumen_tambahan_id', $data->dokumenUtamaTambahan->id)->update([
                    'lolos' => false
                ]);
            }
            DB::commit();

            return response()->json([
                'status'    => "ok",
                'messages'  => $request->status == "diterima" ? "Berhasil menerima data" : "Berhasil menolak data" ,
                'data'      => $request->all()
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status'    => "fail",
                'messages'  => "Ada kesalahan dalam input data",
            ],422);
        }
    }

    public function custDelete($id)
    {
        try {
            DB::beginTransaction();

            $col = CollectionFile::findOrFail($id);
            if ($col->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)') {
                if ($col->dataDiri()->exists()) {
                    if ($col->dataDiri->analisaFinansial()->exists()) {
                        $col->dataDiri->analisaFinansial()->delete();
                    }
                    if ($col->dataDiri->agunan()->exists()) {
                        $col->dataDiri->agunan()->delete();
                    }
                    if ($col->dataDiri->ujiFlpp()->exists()) {
                        $col->dataDiri->ujiFlpp()->delete();
                    }
                    if ($col->dataDiri->pasangan()->exists()) {
                        $col->dataDiri->pasangan()->delete();
                    }
                    $col->dataDiri()->delete();
                }                
            }
            if ($col->historyStatus()->exists()) {
                $col->historyStatus()->delete();
            }
            $col->delete();

            DB::commit();

            return response()->json([
                'data' => $id,
                'status'    => "ok",
                'messages'  => "Berhasil menghapus data"
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status'    => "fail",
                'messages'  => "Ada kesalahan dalam menghapus data",
            ],422);
        }
    }



    public function getDatatble(Request $request){
        $role = \Auth::user()->getRoleNames()->first();
        // return $request->filter_status;
        if ($request->ajax()) {
            $data = CollectionFile::with('unitKerja')
            ->when($role == "superadmin", function($q){
                $q->where('status_id', '<', 10);
            })
            ->when($role != "superadmin", function($q){
                $q->where([
                    ['is_pengajuan', true],
                    ['status_id', '<=', 10]
                ]);
            })            
            ->when($request->filter_status != '' && $request->filter_status == 0, function($q) use($request){                
                $q->where([
                    ['is_pengajuan', false],
                    ['status_id', 1]
                ]);
            })
            ->when($request->filter_status != '' && $request->filter_status != 0, function($q) use($request){
                $q->where([
                    ['is_pengajuan', true],
                    ['status_id', $request->filter_status]
                ]);
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
                // return \Helper::badgeStatus($row->status_id);
                if (!$row->is_pengajuan) {
                    return \Helper::badgeStatus(0);
                }
                return \Helper::badgeStatus($row->status_id);
            })
            ->addColumn('nama_uker', function($row){
                return $row->uker_kode == 1039 ? "DKI Jakarta - Kantor Cabang Khusus" : "{$row->unitKerja->kantorWilayah->kota} - {$row->unitKerja->nama}";
            })
            ->addColumn('action', function($row){
                $actionBtn = '';
                if ($row->status_id == 1 && $row->is_pengajuan) {
                    $actionBtn = '<a href="'.route('operasional.collection.show', $row->id).'" class="edit btn btn-info btn-sm mr-1">Cek Dokumen</a>';
                }elseif($row->status_id == 2 || $row->status_id == 3 && $row->is_pengajuan){
                    $actionBtn = '<a href="'.route('operasional.collection.show', $row->id).'" class="edit btn btn-warning btn-sm mr-1">Cek Dokumen</a>';
                }else{
                    // $actionBtn = '<a href="javascript:void" class="edit btn btn-info btn-sm mr-1" disabled>Cek Dokumen</a>';
                }
                if ($row->status_id > 3 && $row->status_id < 8 && $row->status_id != 7 && $row->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)' && $row->is_pengajuan) {
                    $actionBtn .= '<a href="'.route('operasional.collection.edit', $row->id).'" class="edit btn btn-primary btn-sm">Cek Data</a>';
                }else{
                    // $actionBtn .= '<a href="javascript:void" class="edit btn btn-primary btn-sm" disabled>Cek Data</a>';
                }
                $actionBtn .= '<a href="'.route('collection.aplikasi.custom_detail', $row->id).'" class="btn btn-info btn-sm" target="_blank">Lihat Aplikasi</a>';
                if ($row->is_pengajuan) {
                    $actionBtn .= '<a href="'.route('operasional.collection.cust_delete', $row->id).'" class="edit btn btn-danger btn-sm" id="btnHapusCollection">Hapus Data</a>';
                }                
                return $actionBtn;
            })
            ->editColumn('updated_at', function($data){
                // $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->format('d-m-Y');
                // return $data->is_pengajuan ? $formatedDate : '-'; 
                return $data->is_pengajuan ? $data->updated_at : '-';
                })
            ->rawColumns(['action', 'status', 'nama_uker'])
            ->make(true);
        }
    }
}
