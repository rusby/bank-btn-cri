<?php

namespace App\Http\Controllers\BTN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubmissionController extends Controller
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

    function initialEntry(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "id_properti"=>"",
            "type_pengajuan"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/initial-entry:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/initial-entry';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    function personalInformation(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>"",
            "nama_lengkap"=>"",
            "no_ktp"=>"",
            "tempat_lahir"=>"",
            "tgl_lahir"=>"",
            "alamat"=>"",
            "rt"=>"",
            "rw"=>"",
            "kode_pos"=>"",
            "id_provinsi"=>"",
            "id_kota"=>"",
            "id_kecamatan"=>"",
            "id_kelurahan"=>"",
            "no_telp"=>"",
            "no_hp1"=>"",
            "email"=>"",
            "status_nikah"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/personal-information:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/personal-information';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    function spouseInformation(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>"",
            "nama_lengkap_pasangan"=>"",
            "no_ktp_pasangan"=>"",
            "tempat_lahir_pasangan"=>"",
            "tgl_lahir_pasangan"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/spouse-information:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/spouse-information';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    function jobInformation(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>"",
            "nama_perusahaan"=>"",
            "jenis_pekerjaan"=>"",
            "penghasilan"=>"",
            "jenis_pekerjaan_pasangan"=>"",
            "penghasilan_pasangan"=>"",
            "biaya_rumah_tangga"=>"",
            "pengeluaran"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/job-information:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/job-information';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    function loanApplication(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>"",
            "id_cabang"=>"",
            "harga_jual"=>"",
            "uang_muka"=>"",
            "nilai_pembiayaan"=>"",
            "jangka_waktu"=>"",
            "jenis_suku_bunga"=>"",
            "bunga"=>"",
            "angsuran"=>"",
            "total_angsuran"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/loan-application:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/loan-application';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    function uploadDocument(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "extension"=>"",
            "jenis_file"=>"",
            "file"=>""
        ));
        
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/upload-document:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/upload-document';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    function removeDocument(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "file_name"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/remove-document:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/remove-document';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    function confirmDocument(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "file_name"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/confirm-document:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/confirm-document';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    function submitFinal(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/final:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/final';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }

    function entryDetail(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/entry-detail:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/entry-detail';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
    }
    
    function entryTracking(){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>""
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/submission/entry-tracking:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/submission/entry-tracking';
        $array_header = array(
            "Authorization: Bearer {$token}",
            "X-EXTERNAL-ID: {$externalid}",
            "X-PARTNER-ID: {$partnerid}",
            "X-SIGNATURE: {$signature}",
            "X-TIMESTAMP: {$timestamps}",
            "CHANNEL-ID: API",
            'Content-Type: application/json'
        );
        // print_r($array_header);die;
        $response = $this->callAPI($method, $url, $requestbody, $array_header, $timestamps);
        $result = json_decode($response);
        echo "<pre>";
        print_r($result);
        echo "<pre>";
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
