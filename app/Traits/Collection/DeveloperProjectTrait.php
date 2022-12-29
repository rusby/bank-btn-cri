<?php

namespace App\Traits\Collection;
use App\Models\Collection\DeveloperProjectFiles;
use DB;

trait DeveloperProjectTrait {
	public function storeDevProject($request){
		
		$validator = \Validator::make($request->all(), 
			[ 
				'project_name'   => ['required', 'string', 'max:255'],
				'no_sertifikat'  => ['required', 'string', 'max:255'],
				'tgl_sertifikat' => ['required', 'string', 'max:255'],
				'no_imb' 		 => ['required', 'string', 'max:255'],
				'tgl_imb'		 => ['required', 'string', 'max:255']
			]);
		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}
		if ($request->total_file > 0 && !isset($request->dokumen_lainnya)) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Dokumen lainnya harus diupload semua.",
			],422);
		}

		if (isset($request->dokumen_lainnya)) {
			if ($request->total_file > count($request->dokumen_lainnya)) {
				return response()->json([
					'status'    => "fail",
					'messages'  => "Masih ada dokumen lainnya yang belum diupload.",
				],422);
			}
		}		

		DB::beginTransaction();
		try {
			$project = $this->create($request->except('_token', 'dokumen_lainnya', 'total_file'));

			if (isset($request->dokumen_lainnya)) {
				foreach ($request->file('dokumen_lainnya') as $file) {
					$filename = \Helper::storeFile('collection/project', $file);
					$reqFiles['developer_project_id'] =  $project->id;
					$reqFiles['name'] = $filename;
					$reqFiles['path'] =  'collection/project';
					$reqFiles['created_by'] =  \Auth::user()->id;
					DeveloperProjectFiles::create($reqFiles);	
				}		
			}
			DB::commit();

			return response()->json([
				'status'       => "ok",
				'messages'     => "Berhasil menambahkan project",
				'data'         =>  $request->all()
			], 200);
		} catch (Exception $e) {
			DB::rollback();
			return response()->json([
				'status'    => "fail",
				'messages'  => "Ada kesalahan dalam input data",
			],422);
		}
	}
}