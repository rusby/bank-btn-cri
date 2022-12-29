<?php

namespace App\Http\Controllers\api\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Provinsi as ProvinsiModel;

class Provinsi extends Controller
{
	public function main(Request $request) {
        $data = $request->all();

		$table = ProvinsiModel::select( 'id', 'provinsi' )->orderby('provinsi','asc');

		if ( isset($data['limit']) ) {
			$table->take($data['limit']);
			
			if ( isset($data['offset']) ) {
				$table->skip($data['offset']);
			}
		}

		if ( isset($data['filter']) ) {
			$table->where( "provinsi" , "LIKE" ,($data['filter'] ? '%'.$data['filter'].'%' : '%%') );
		}
		
		$table = $table->get();

		if (count($table) == 0 ) {
			return response()->json([
                'status_code' => 204,
                'data' => $table
            ],200);
		} else {
            return response()->json([
                'status_code' => 200,
                'data' => $table
            ],200);
		}
	}
}
