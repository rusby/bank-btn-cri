<?php

namespace App\Http\Controllers\Api\BTN;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Spatie\Crypto\Rsa\KeyPair;
use DataTables;


class B2BController extends Controller
{
    public function getDataToken()
    {
        $pathToPublicKey = public_path('public.pem');
        $pathToPrivateKey = public_path('private.pem');        
        $tokens = config('app')['token'];
        $timestamps = date('c');
        $stringSign = $tokens['x-client-key']."|".$timestamps;
        $signature = \Spatie\Crypto\Rsa\PrivateKey::fromFile($pathToPrivateKey)->sign($stringSign);

        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/snap/v1/access-token/b2b';
        $array_header = array(
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "X-CLIENT-KEY: {$tokens['x-client-key']}",
            'Content-Type: application/json'
        );

       	$data =  array(
		      "grantType"        => "client_credentials",
		      "additionalInfo"   => array(),
		);
        $response = $this->callAPI($method, $url, json_encode($data), $array_header, $timestamps);
        $res = json_decode($response);
        $tokendata = $res->accessToken;
        $this->token = $tokendata;
        $this->timestamp = $timestamps;
        $getdatatoken = array(
            'tokendata' =>  $tokendata,
            'timestamps' =>  $timestamps,
        );
        return   $getdatatoken;
    }

    function financeType(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array("App_Key"=> "TXugSwyTQkBQNLWMcPgc"));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        // $plaintex = 'POST:/btnproperti/snap/v1/b2b/financing-type:QycXctOjLmCLjSa9bLxmcOf0A2MOW0KRH7O5mfzsfVvU49Twn2HKVb:ed311124cb8ef044b662c86fe4110b02e1ca65b09d9d9adc70d17116889dfc66:2022-12-10T10:12:06+07:006';
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/financing-type:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/financing-type';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->Output == 'Get data success') {
            if (!empty($result->Data)){
                $data =$result->Data; 
            }else{
                $data = []; 
            }
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function loanType(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array("App_Key"=> "TXugSwyTQkBQNLWMcPgc"));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/loan-type:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/loan-type';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->Output == 'Get data success') {
            $data =$result->Data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function employmentType(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array("App_Key"=> "TXugSwyTQkBQNLWMcPgc"));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/employment-type:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/employment-type';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->Output == 'Get data success') {
            $data =$result->Data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function searchProvince(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array("App_Key"=> "TXugSwyTQkBQNLWMcPgc"));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/search-province:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/search-province';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->Output == 'Get data success') {
            $data =$result->Data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }
    
    function searchCity(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array("App_Key"=> "TXugSwyTQkBQNLWMcPgc",  "i_prop"=>$request->i_prop));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/search-city:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/search-city';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->Output == 'Get data success') {
            $data =$result->Data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function searchDistrict(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array("App_Key"=> "TXugSwyTQkBQNLWMcPgc",  "i_kot"=>$request->i_kot));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/search-district:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/search-district';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->Output == 'Get data success') {
            $data =$result->Data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
        // echo "<pre>";
        // print_r($result);
        // echo "<pre>";
    }

    function searchSubDistrict(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array("App_Key"=> "TXugSwyTQkBQNLWMcPgc",  "i_kec"=>$request->i_kec));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/search-subdistrict:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/search-subdistrict';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        $result = json_decode($response);
        if ($result->Output == 'Get data success') {
            $data =$result->Data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function searchPostCodeLocation(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array("App_Key"=> "TXugSwyTQkBQNLWMcPgc",  "pos"=>$request->poscode));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/search-postcode-location:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/search-postcode-location';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->Output == 'Get data success') {
            $data =$result->Data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }
    
    function searchBranchOffice(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       
       	$requestbody =  json_encode(array(
            "App_Key"=> "TXugSwyTQkBQNLWMcPgc", 
            "id"=>$request->id,
            "pos"=>$request->poscode,
            "i_prop"=>$request->i_prop,
            "i_kot"=>$request->i_kot,
            "jns"=>$request->jns,
            "Sort"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/search-branch-office:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/search-branch-office';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->Output == 'Get data success') {
            $data =$result->Data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function housingLoanInsertApplicationNonstock(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];
        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);

        $fl_ktp = "";
        $ext_fl_ktp = "";
        $fl_slp_pghsln = "";
        $ext_fl_slp_pghsln = "";
        $fl_ps_ft = "";
        $ext_fl_ps_ft = "";
        $fl_rkng_krn = "";
        $ext_fl_rkng_krn = "";

        if (!empty($_FILES['file_ktp']['size']) && $_FILES['file_ktp']['error'] === UPLOAD_ERR_OK)
        {
            $file_ktp = $request->file('file_ktp');
            $dataFileKtp = $this->uploadFileLoan($file_ktp);
            $fl_ktp = $dataFileKtp['fileBase64'];
            $ext_fl_ktp = $dataFileKtp['extFile'];
        }

        if (!empty($_FILES['file_slip_penghasilan']['size']) && $_FILES['file_slip_penghasilan']['error'] === UPLOAD_ERR_OK)
        {
            $file_slip_penghasilan = $request->file('file_slip_penghasilan');
            $FilePenghasilan = $this->uploadFileLoan($file_slip_penghasilan);
            $fl_slp_pghsln = $FilePenghasilan['fileBase64'];
            $ext_fl_slp_pghsln = $FilePenghasilan['extFile'];
        }

        if (!empty($_FILES['file_pasphoto']['size']) && $_FILES['file_pasphoto']['error'] === UPLOAD_ERR_OK)
        {
            $file_pasphoto = $request->file('file_pasphoto');
            $FilePasPoto = $this->uploadFileLoan($file_pasphoto);
            $fl_ps_ft = $FilePasPoto['fileBase64'];
            $ext_fl_ps_ft = $FilePasPoto['extFile'];
        }

        if (!empty($_FILES['file_rekening_koran']['size']) && $_FILES['file_rekening_koran']['error'] === UPLOAD_ERR_OK)
        {
            $file_rekening_koran = $request->file('file_rekening_koran');
            $FileRekKoran = $this->uploadFileLoan($file_rekening_koran);
            $fl_rkng_krn = $FileRekKoran['fileBase64'];
            $ext_fl_rkng_krn = $FileRekKoran['extFile'];
        }
      
        // $requestbody =  json_encode(array( 
        //     "App_Key"=>"tkW3WMcuVteEo5GGJbZy",
        //     "ch"=>"CIRIUM",
        //     "i_prpt"=>"1384007",
        //     "url_prpt"=>"Megalord v2",
        //     "i_cbg"=>"00005",
        //     "typ_pgjn"=>"Konvensional",
        //     "jns_pgjn"=>"1",
        //     "nl_pgjn"=>"500000000",
        //     "nm_dpn"=>"FADELS",
        //     "nm_tgh"=>"",
        //     "nm_blk"=>"",
        //     "no_ktp"=>"8237382838090123",
        //     "tpt_lhr"=>"JAKARTA",
        //     "tgl_lhr"=>"1990-09-19",
        //     "almt"=>"JAKARTA SELATAN",
        //     "rt"=>"001",
        //     "rw"=>"03",
        //     "pos"=>"22384",
        //     "i_prop"=>"13",
        //     "i_kot"=>"1306",
        //     "i_kec"=>"130607",
        //     "i_kel"=>"1306072005",
        //     "no_telp"=>"",
        //     "no_hp1"=>"081823829398",
        //     "no_hp2"=>"",
        //     "no_hp3"=>"",
        //     "eml"=>"test.gmail@gmail.com",
        //     "nm_prshn"=>"PT. BCA INDONESIA",
        //     "jns_pkrjn"=>"20",
        //     "pghsln"=>"4000000",
        //     "bya_rmh_tng"=>"",
        //     "pgrln_ln"=>"",
        //     "fl_ktp"=>"AAXCBD",
        //     "ext_fl_ktp"=>"png",
        //     "fl_slp_pghsln"=>"AAXCBD",
        //     "ext_fl_slp_pghsln"=>"png",
        //     "fl_ps_ft"=>"AAXCBD",
        //     "ext_fl_ps_ft"=>"png",
        //     "fl_rkng_krn"=>"AAXCBD",
        //     "ext_fl_rkng_krn"=>"png"
        // ));

        $requestbody =  json_encode(array(  
            "app_key"=>$request->channel,
            "ch"=>$request->channel,
            "i_prpt"=>$request->properties,
            "url_prpt"=>$request->url_properties,
            "i_cbg"=>"00005",
            // "i_cbg"=>$request->cabang,
            "typ_pgjn"=>$request->type_pengajuan,
            "jns_pgjn"=>$request->jenis_pengajuan,
            "nl_pgjn"=>$request->nilai_pengajuan,
            "nm_dpn"=>$request->nama_depan,
            "nm_tgh"=>$request->nama_tengah,
            "nm_blk"=>$request->nama_belakang,
            "no_ktp"=>$request->nomor_ktp,
            "tpt_lhr"=>$request->tempat_lahir,
            "tgl_lhr"=>$request->tanggal_lahir,
            "almt"=>$request->alamat,
            "rt"=>$request->rt,
            "rw"=>$request->rw,
            "pos"=>$request->kodepos,
            "i_prop"=>$request->i_prop,
            "i_kot"=>$request->i_city,
            "i_kec"=>$request->i_district,
            "i_kel"=>$request->i_subdistrict,
            "no_telp"=>$request->no_telp,
            "no_hp1"=>$request->nohp1,
            "no_hp2"=>$request->nohp2,
            "no_hp3"=>$request->nohp3,
            "eml"=>$request->email,
            "nm_prshn"=>$request->nama_perusahaan,
            "jns_pkrjn"=>$request->jenis_pekerjaan,
            "pghsln"=>$request->penghasilan,
            "bya_rmh_tng"=>$request->biaya_rumahtangga,
            "pgrln_ln"=>$request->pengeluaran,
            "fl_ktp"=>$fl_ktp,
            "ext_fl_ktp"=>$ext_fl_ktp,
            "fl_slp_pghsln"=>$fl_slp_pghsln,
            "ext_fl_slp_pghsln"=>$ext_fl_slp_pghsln,
            "fl_ps_ft"=>$fl_ps_ft,
            "ext_fl_ps_ft"=>$ext_fl_ps_ft,
            "fl_rkng_krn"=>$fl_rkng_krn,
            "ext_fl_rkng_krn"=>$ext_fl_rkng_krn,
        ));


        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/housing-loan/insert-application/non-stock:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/housing-loan/insert-application/non-stock';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->message == 'Success - OK') {
            if(!empty($result->data)){
                $data = $result->data; 
            }else{
                $data = []; 
            }
        } else {
            $data = []; 
        }
    }

    function housingLoanApplicationList(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
        // channel: CIRIUM
        // app_key: tkW3WMcuVteEo5GGJbZy
        // app_secret: gPOdumEF8eAGFmp61gHcaqIaaAB5ih1J
       	$requestbody =  json_encode(array(
            "app_key"=> "tkW3WMcuVteEo5GGJbZy",
            "channel"=>$request->channel,
            "bulan"=>$request->bulan,
            "tahun"=>$request->tahun,
            "secret_key" => "gPOdumEF8eAGFmp61gHcaqIaaAB5ih1J",
        ));

        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/housing-loan/applicant-list:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/housing-loan/applicant-list';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );

        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->message == 'Success - OK') {
            if(!empty($result->data)){
                $data = $result->data; 
            }else{
                $data = []; 
            }
        } else {
            $data = []; 
        }

        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function smeLoanInsertApplication(Request $request){
        $foto_ktp = " ";
        $fKtp_ext = " ";
        $foto_debitur = " ";
        $fDebitur_ext = " ";
        $foto_npwp = " ";
        $fNpwp_ext = " ";
        $foto_izinUsaha = " ";
        $fIzinUsaha_ext = " ";

        if (!empty($_FILES['foto_ktp']['size']) && $_FILES['foto_ktp']['error'] === UPLOAD_ERR_OK)
        {
            $foto_ktp = $request->file('foto_ktp');
            $dataFileKtp = $this->uploadFileLoan($foto_ktp);
            $foto_ktp = $dataFileKtp['fileBase64'];
            $fKtp_ext = $dataFileKtp['extFile'];
        }

        if (!empty($_FILES['foto_debitur']['size']) && $_FILES['foto_debitur']['error'] === UPLOAD_ERR_OK)
        {
            $foto_debitur = $request->file('foto_debitur');
            $fileDebitur = $this->uploadFileLoan($foto_debitur);
            $foto_debitur = $fileDebitur['fileBase64'];
            $fDebitur_ext = $fileDebitur['extFile'];
        }

        if (!empty($_FILES['foto_npwp']['size']) && $_FILES['foto_npwp']['error'] === UPLOAD_ERR_OK)
        {
            $foto_npwp = $request->file('foto_npwp');
            $FileNPWP = $this->uploadFileLoan($foto_npwp);
            $foto_npwp = $FileNPWP['fileBase64'];
            $fNpwp_ext = $FileNPWP['extFile'];
        }

        if (!empty($_FILES['foto_izin_usaha']['size']) && $_FILES['foto_izin_usaha']['error'] === UPLOAD_ERR_OK)
        {
            $foto_izin_usaha = $request->file('foto_izin_usaha');
            $FileIzinUsaha = $this->uploadFileLoan($foto_izin_usaha);
            $foto_izinUsaha = $FileIzinUsaha['fileBase64'];
            $fIzinUsaha_ext = $FileIzinUsaha['extFile'];
        }

        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "access_key"=>$request->access_key,
            "channel"=>$request->channel,
            "cabang"=>$request->cabang,
            "jenis_kredit"=>$request->jenis_kredit,
            "ktp"=>$request->ktp,
            "nama"=>$request->nama,
            "tempat_lahir"=>$request->tempat_lahir,
            "tanggal_lahir"=>$request->tanggal_lahir,
            "jenis_kelamin"=>$request->jenis_kelamin,
            "hp"=>$request->nohp,
            "email"=>$request->email,
            "alamat_tt"=>$request->alamat,
            "rt_tt"=>$request->rt,
            "rw_tt"=>$request->rw,
            "kelurahan_tt"=>$request->i_subdistrict,
            "kecamatan_tt"=>$request->i_district,
            "kota_tt"=>$request->i_city,
            "provinsi_tt"=>$request->i_prop,
            "kodepos_tt"=>$request->kodepos,
            "status_tt"=>$request->status_tt,

            "alamat_u"=>$request->alamat_usaha,
            "rt_u"=>$request->rt_usaha,
            "rw_u"=>$request->rw_usaha,
            "kelurahan_u"=>$request->i_subdistrict_usaha,
            "kecamatan_u"=>$request->i_district_usaha,
            "kota_u"=>$request->i_city_usaha,
            "provinsi_u"=>$request->i_prop_usaha,
            "kodepos_u"=>$request->kodepos_usaha,
            "status_tu"=>$request->status_usaha,
            "lama_u"=>$request->lama_usaha,
            "nama_u"=>$request->nama_usaha,
            "sektor_u"=>$request->sektor_usaha,
            "omset_u"=>$request->omset_usaha,
            "plafon_kur"=>$request->plafon_kur,
            "tujuan_kur"=>$request->tujuan_kur,
            "tujuan_detail"=>$request->tujuan_detail,
            "jangka_waktu"=>$request->jangka_waktu,
            "foto_debitur"=>$request->foto_debitur,
            "fDebitur_ext"=>$request->fDebitur_ext,
            "foto_ktp"=>$request->foto_ktp,
            "fKtp_ext"=>$request->fKtp_ext,
            "foto_npwp"=>$request->foto_npwp,
            "fNpwp_ext"=>$request->fNpwp_ext,
            "foto_izinUsaha"=>$request->foto_izinUsaha,
            "fIzinUsaha_ext"=>$request->fIzinUsaha_ext,
            "status_menikah"=>$request->status_menikah,
            "nama_pasangan"=>$request->nama_pasangan,
            "ktp_pasangan"=>$request->ktp_pasangan,
            "tmptlhr_pasangan"=>$request->tempat_lahir_pasangan,
            "tgllhr_pasangan"=>$request->tanggal_lahir_pasangan,
            "hp_pasangan"=>$request->hp_pasangan,        
        ));

        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/b2b/sme-loan/insert-application:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/b2b/sme-loan/insert-application';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );

        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        if ($result->message == 'Success - OK') {
            if(!empty($result->data)){
                $data = $result->data; 
            }else{
                $data = []; 
            }
        } else {
            $data = []; 
        }

        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }   
    
    function callAPI($method, $url, $data, $headers = false,  $timestamps)
	{
	    $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
	}

    public function uploadFileLoan($fileNameupload){
        if (!\File::exists(public_path("upload/loan"))) {
			\File::makeDirectory(public_path("upload/loan"), 0755, true, true);
		}

        $fileBase64 = base64_encode(file_get_contents($fileNameupload->path()));
        $extFile  = $fileNameupload->getClientOriginalExtension();
        $fileOriginalName = $fileNameupload->getClientOriginalName();
        $originalName    = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $fileNameToStore    = $originalName.'_'.time().'.'.$extFile;
        $fileNameupload->move(public_path("upload/loan"), $fileNameToStore);
        $dataArr = array(
            "fileBase64" => $fileBase64,
            "extFile" => $extFile,
            "fileNameToStore" => $fileNameToStore,
        );
        return $dataArr; 
    }

    
}
