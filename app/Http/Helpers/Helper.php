<?php
namespace App\Http\Helpers;
use App\Models\Collection\CollStatusHistory;
use App\Models\Collection\CollectionFile;
use Auth;

class Helper {

	public static function showImage($folder='', $file=''){
		if (env('APP_ENV') == 'local') {
			$fix = "uploaded_files/{$folder}/{$file}";
		}else{
			$fix = "../../appscollection/public/uploaded_files/{$folder}/{$file}";
		}
		return asset($fix);
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
		if ($status == 0) {
			return '<span class="badge badge-warning">Draft</span>';
		}else if ($status == 1) {
			return '<span class="badge badge-info">Belum dicek</span>';
		}else if($status == 2){
			return '<span class="badge badge-danger">Berkas Tidak Lengkap</span>';
		}else if($status == 3){
			return '<span class="badge badge-warning">Pengajuan Kembali Berkas</span>';
		}else if($status == 4){
			return '<span class="badge badge-success">Selesai Pengecekan Berkas</span>';
		}else if ($status == 5) {
			return '<span class="badge badge-info">Pengecekan Data Input</span>';
		}else if($status == 6){
			return '<span class="badge badge-danger">Ditolak Verifikasi</span>';
		}else if($status == 7){
			return '<span class="badge badge-warning">Pengajuan Kembali Verifikasi</span>';
		}else if($status == 8){
			return '<span class="badge badge-warning">Pending Verifikasi CRI</span>';
		}else if($status == 9){
			return '<span class="badge badge-success">Diterima Verifikasi CRI</span>';
		}else if($status == 10){
			return '<span class="badge badge-primary">Terkirim ke Uker BRI</span>';
		}else if($status == 11){
			return '<span class="badge badge-info">Sudah Didownload BRI</span>';
		}else if($status == 12){
			return '<span class="badge badge-warning">Perbaikan BRI</span>';
		}else if($status == 13){
			return '<span class="badge badge-info">Analisa dan Verifikasi BRI</span>';
		}else if($status == 14){
			return '<span class="badge badge-danger">Putus Tolak BRI</span>';
		}else if($status == 15){
			return '<span class="badge badge-success">Putus Terima BRI</span>';
		}else if($status == 16){
			return '<span class="badge badge-warning">Calon Debitur Membatalkan</span>';
		}else if($status == 17){
			return '<span class="badge badge-primary">Akad Kredit BRI</span>';
		}else if($status == 18){
			return '<span class="badge badge-success">Pencairan BRI</span>';
		}
	}

	public static function storeStatusHistory($collId, $statusId){
		$data = CollStatusHistory::where([
			['collection_id', $collId],
			['status_id', $statusId]
		])->count();
		$roles = Auth::user()->getRoleNames()->first();
		if ($statusId == 11 && $roles != "operasional" && $roles != "operasional verifikator" && $roles != "admin cri") {
			$new = new CollStatusHistory;
			$new->storeStatus($collId, $statusId);
		}elseif ($statusId != 11) {
			$new = new CollStatusHistory;
			$new->storeStatus($collId, $statusId);
		}
	}

	public function cutString($text, $limit=28){
		if (strlen($text) > $limit) {
			return substr($text, 0, $limit).'...';
		}else{
			return $text;
		}
	}

	public static function getTotal($status_id='', $is_private=true){
		if (\Auth::user()->userBri) {
			$user = \Auth::user()->userBri;
			return  CollectionFile::with('unitKerja')
			->when($user->kanwil_id, function($q) use($user){
				$q->whereHas('unitKerja.kantorWilayah', function($query)use($user){
					$query->whereId($user->kanwil_id);
				});
			})
			->when($user->kanca_kode, function($q) use($user){
				$q->whereHas('unitKerja', function($query)use($user){
					$query->where('kc_id', $user->kanca_kode)
					->orWhere('id', $user->kanca_kode);
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
// 			->where('status_id', $status_id)
            ->where([
				['status_id', $status_id],
				['is_pengajuan', 1]
			])
            ->where([
				['status_id', $status_id],
				['is_pengajuan', 1]
			])
			->count();
		}
		if($status_id == 0) {
			return CollectionFile::where([
				['status_id', 1],
				['is_pengajuan', 0]
			])
			->when($is_private, function($q){
				$q->where('createdBy', \Auth::user()->id);
			})
			->count();
		}elseif($status_id > 0 && $status_id < 20) {
			return CollectionFile::where([
				['status_id', $status_id],
				['is_pengajuan', 1]
			])
			->when($is_private, function($q){
				$q->where('createdBy', \Auth::user()->id);
			})
			->count();
		}else{
			return CollectionFile::when($is_private, function($q){
				$q->where('createdBy', \Auth::user()->id);
			})
			->count();
		}
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

	public static function rupiahFormat($rp){
		$rp = preg_replace('#\.#', '', $rp);
		return number_format( (float)$rp, 0, ",", ".");
	}
	
	public static function getLastTimeHistory($collId, $statusId){
		$data = CollStatusHistory::where([
			['collection_id', $collId],
			['status_id', $statusId]
		])->latest()->first();
		return $data ? $data->created_at : '-';
	}
}
