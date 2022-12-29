<?php

namespace App\Traits\Collection;
use DB;

trait DeveloperTrait {
	public function storeDeveloper($request){
		$validator = \Validator::make($request->all(), 
			[ 
				'developer_name' => ['required', 'string', 'max:255']
			]);   

		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}
		DB::beginTransaction();
		try {
			$user = $this->create($request->only('developer_name'));
			DB::commit();

			return response()->json([
				'status'       => "ok",
				'messages'     => "Berhasil menambahkan developer",
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