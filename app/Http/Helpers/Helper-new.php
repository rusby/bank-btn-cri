<?php
namespace App\Http\Helpers;
use App\Models\Collection\CollStatusHistory;
use App\Models\Collection\CollectionFile;

class Helper {
	public static function showImage($folder='', $file=''){
		if (env('APP_ENV') == 'local') {
			$fix = "uploaded_files/{$folder}/{$file}";			
		}else{
			$fix = "../../appscollection/public/uploaded_files/{$folder}/{$file}";
		}
		// return $fix;
		if(\File::exists(public_path($fix))){
			return asset($fix);	
		}else{
			return asset("uploaded_files/default.png");
		}
	}

	public static function storeBase64File($folder, $file, $namaFile='', $oldFile=null){
		if (!\File::exists(public_path("uploaded_files/{$folder}"))) {
			\File::makeDirectory(public_path("uploaded_files/{$folder}"), 0755, true, true);
		}
		if (substr($file, 0, 5) == "data:") {
			$ext       = explode('/', mime_content_type($file))[1];
			$image     = str_replace("data:image/{$ext};base64,", '', $file);
			$image     = str_replace(' ', '+', $image);
			if($namaFile){
                $imageName = $namaFile.'.'.$ext;
            }else{
                $imageName = strtotime("now").'.'.$ext;
            }
			$path      = public_path()."/uploaded_files/{$folder}/".$imageName;
			if (!is_null($oldFile)) {
				self::deleteFile($folder, $oldFile);
			}
			\File::put($path, base64_decode($image));
			return $imageName;
		}else{
			return self::storeFile($folder, $file, $namaFile, $oldFile);
		}
	}

	public static function deleteFile($folder, $oldFile){
		if (env('APP_ENV') == 'local') {
			if (file_exists(public_path("uploaded_files/{$folder}/").$oldFile)) {
				unlink("uploaded_files/{$folder}/{$oldFile}");
			}
		}else{
			if (file_exists(public_path("../appscollection/public/uploaded_files/{$folder}/").$oldFile)) {
				unlink("../appscollection/public/uploaded_files/{$folder}/{$oldFile}");
			}
		}			
	}

	public static function storeFile($folder, $file, $namaFile='', $oldFile=null){	
		if ($file) {
			if (!is_null($oldFile)) {
				self::deleteFile($folder, $oldFile);
			}
			$filename = "{$namaFile}.{$file->getClientOriginalExtension()}";
			$file->move(public_path("uploaded_files/{$folder}"), $filename);
		// return $filename;	
			return $filename;
		}		
	}

	public static function badgeStatus($status=1){
		if ($status == 1) {
			return '<span class="badge badge-info">Belum dicek</span>';
		}else if($status == 2){
			return '<span class="badge badge-danger">Berkas Tidak Lengkap</span>';
		}else if($status == 3){
			return '<span class="badge badge-warning">Pengajuan Kembali Berkas</span>';
		}else if($status == 4){
			return '<span class="badge badge-success">Selesai Pengecekan Berkas</span>';
		}else if ($status == 5) {
			return '<span class="badge badge-info">Proses Input Data</span>';
		}else if($status == 6){
			return '<span class="badge badge-danger">Ditolak Verifikasi</span>';
		}else if($status == 7){
			return '<span class="badge badge-warning">Pengajuan Kembali Verifikasi</span>';
		}else if($status == 8){
			return '<span class="badge badge-warning">Pending Verifikasi</span>';
		}else if($status == 9){
			return '<span class="badge badge-success">Diterima Verifikasi</span>';
		}else if($status == 10){
			return '<span class="badge badge-primary">Terkirim ke Uker BRI</span>';
		}else if($status == 11){
			return '<span class="badge badge-info">Sudah Didownload BRI</span>';
		}else if($status == 12){
			return '<span class="badge badge-info">Analisa dan Verifikasi BRI</span>';
		}else if($status == 13){
			return '<span class="badge badge-danger">Ditolak BRI</span>';
		}else if($status == 14){
			return '<span class="badge badge-success">Diterima BRI</span>';
		}else if($status == 15){
			return '<span class="badge badge-warning">Calon Debitur Membatalkan</span>';
		}else if($status == 16){
			return '<span class="badge badge-primary">Akad Kredit BRI</span>';
		}else if($status == 17){
			return '<span class="badge badge-success">Pencairan BRI</span>';
		}
	}

	public static function storeStatusHistory($collId, $statusId){
		$new = new CollStatusHistory;
		$new->storeStatus($collId, $statusId);
	}

	public function cutString($text, $limit=28){
		if (strlen($text) > $limit) {
			return substr($text, 0, $limit).'...';
		}else{
			return $text;
		}
	}

	public static function getTotal($status_id='', $is_private=true){
		return CollectionFile::when($status_id, function($q)use($status_id){
			$q->where('status_id', $status_id);
		})
		->when($is_private, function($q){
			$q->where('createdBy', \Auth::user()->id);
		})
		->where('is_pengajuan', true)
		->count();
	}

	public static function checkExtension($data){
        // ngecek datanya ada atau nggak, dan cek formatnya
        if ($data && count(explode(".", $data)) > 1) {
            return explode(".", $data)[1];
        }
        return '-';
    }

    public function generateRandString(){
    	return substr(strtotime('now'), 5, 9).substr(md5(mt_rand()), 0, 5);
    }
}
