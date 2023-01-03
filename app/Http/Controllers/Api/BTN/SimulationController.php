<?php

namespace App\Http\Controllers\Api\BTN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Spatie\Crypto\Rsa\KeyPair;
use DataTables;

class SimulationController extends Controller
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

    function simulationHousingLoanConventional(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "jenis_simulasi"=>$request->jenis_simulasi,
            "jenis_suku_bunga"=>$request->jenis_suku_bunga,
            "sub_or_nonsub"=>$request->sub_or_nonsub,
            "harga"=>$request->harga,
            "uang_muka"=>$request->uang_muka,
            "suku_bunga"=>$request->suku_bunga,
            "lama_pinjaman"=>$request->lama_pinjaman,
            "ms_kredit_fix"=>$request->ms_kredit_fix,
            "sk_bga_flting"=>$request->sk_bga_flting
        ));

        // var_dump($requestbody);die;

        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/conventional/housing-loan-simulation:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/conventional/housing-loan-simulation';
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
            $data =$result->Data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    } 

    function simulationHousingLoanSharia(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array( 
            "jenis_simulasi"=>$request->jenis_simulasi,
            "jenis_suku_bunga"=>$request->jenis_suku_bunga,
            "sub_or_nonsub"=>$request->sub_or_nonsub,
            "harga"=>$request->harga,
            "uang_muka"=>$request->uang_muka,
            "suku_bunga"=>$request->suku_bunga,
            "lama_pinjaman"=>$request->lama_pinjaman,
            "margin_total"=>$request->margin_total          
        ));
        // var_dump($requestbody);die;
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/sharia/housing-loan-simulation:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/sharia/housing-loan-simulation';
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
            $data =$result->Data; 
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
}
