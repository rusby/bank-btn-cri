<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\File;
use Illuminate\Http\Request;
use ZipArchive;
use App\Models\User;
use App\Models\Collection\CollectionFile;

class DraftController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CollectionFile::where([
                ['is_pengajuan', false],
                ['status_id', 1]
            ])
            ->orderBy('updated_at', 'DESC');
            return \DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                return \Helper::badgeStatus(0);
            })
            ->addColumn('nama_uker', function($row){
                return $row->unitKerja->kode == 1039 ? "Kantor Cabang Khusus" : "{$row->unitKerja->kantorWilayah->kota} - {$row->unitKerja->nama}";
            })
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('collection.aplikasi.custom_detail', $row->id).'" class="btn btn-info btn-sm mr-1 p-1 mb-1" target="_blank">Lihat Aplikasi</a>';
                return $btn;
            })
            ->rawColumns(['action', 'status', 'nama_uker'])
            ->make(true);

            return $data;
        }
        return view('draft.index');
    }
}
