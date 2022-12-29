<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Collection\{
	CollectionFile,
	DeveloperProjectFiles,
	DeveloperProject,
	Developer
};
use App\Models\Berkas\{
	DokumenUtama,
	DokumenLainnya,
	DokumenTambahan,
	DokumenTambahanLainnya
};
use App\Models\File;
use App\Models\Operasional\AnalisaFinansial;

use DB;

class CollectionController extends Controller
{
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
}
