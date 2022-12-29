<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\File;
use Illuminate\Http\Request;
use ZipArchive;
use File as Files;
use App\Models\Collection\CollectionFile;

class FileController extends Controller
{
    public function download($id)
    {
        $file = File::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app/' . $file->path);

        return response()->download($pathToFile, $file->name);
    }

    public function open($id){
        $file = File::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app/' . $file->path);

        return response()->file($pathToFile);
    }

    public function getZip(Request $req){
        $selCollection = CollectionFile::findOrFail($req->collection_id);
        $namaFile = $selCollection->nama_calon_debitur.'-'.$selCollection->no_ktp;
        $zip_file = $namaFile.'.zip';
        
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $path = public_path("uploaded_files/collection/{$selCollection->no_ktp}");
        if (!Files::exists($path)) {
            $path = public_path("uploaded_files/collection/{$selCollection->nama_developer}/{$selCollection->nama_calon_debitur}");
            // dd($path);
        }
        if (!Files::exists($path)) {
            return back()->with(['err-get_file' => 'Ada kesalahan dalam mendownload file zip.']);
        }
        if ($selCollection->status_id == 10) {
            \Helper::storeStatusHistory($req->collection_id, 11);
        }
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file)
        {
            // We're skipping all subfolders
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();

                $relativePath =  "{$namaFile}/".substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();

        $roles = Auth::user()->getRoleNames()->first();
        if ($roles != "operasional" && $roles != "operasional verifikator" && $roles != "admin cri") {
            if ($selCollection->status_id == 10) {
                $selCollection->update([
                    'status_id'    => 11
                ]);
            }
        }
        return response()->download($zip_file);
    }

    public function testUpload(Request $req){
        $file = \Helper::custStoreFile('folder1', $req->test_file, 'nama1', '1648439873.jpg');
        return $file;
    }
}
