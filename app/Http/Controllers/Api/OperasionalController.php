<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperasionalController extends Controller
{
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
