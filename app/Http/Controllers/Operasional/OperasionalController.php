<?php

namespace App\Http\Controllers\Operasional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection\CollectionFile;
use Illuminate\Support\Facades\Validator;
use App\Models\Operasional\{
    DataDiri,
    DataPasangan,
    AnalisaFinansial,
    DataAgunan,
    UjiDataFlpp
};
use DB;

class OperasionalController extends Controller
{
    public function store(Request $request)
    {
        if (base64_decode($request->file_ktp, true)) {
            return response()->json([
                'status'    => "fail",
                'messages'  => "Format file harus base 64 !",
            ],422);
        }

        $validator = Validator::make($request->all(),
            [
                'file_ktp' => 'required',
            ]);

        if($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages'  => $validator->errors()->first(),
            ],422);
        }

        $name = \Helper::storeFile('tester', $request->file_ktp);

        return response()->json([
            'status'    => "ok",
            'messages'  => "Berhasil mengupload file",
            'file'      =>  $name
        ], 200);
    }

    public function storeDataDiri(Request $request, $id){
        return \ApiHelper::apiDataDiri($request, $id);
    }

    public function storeAnalisaFinansial(Request $request, $id){
        return \ApiHelper::apiAnalisaFinansial($request, $id);        
    }

    public function storeAgunan(Request $request, $id){
        return \ApiHelper::apiAgunan($request, $id);        
    }

    public function storeUjiFlpp(Request $request, $id){
        return \ApiHelper::apiUjiFlpp($request, $id);        
    }
}
