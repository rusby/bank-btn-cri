<?php

namespace App\Http\Controllers\api\BTN;

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

    function initialEntry(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
        $requestbody =  json_encode(array(
            "id_properti"=>$request->id_properti,
            "type_pengajuan"=>$request->type_pengajuan,
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

    function personalInformation(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>"232132131",
            "nama_lengkap"=>$request->nama_lengkap,
            "no_ktp"=>$request->no_ktp,
            "tempat_lahir"=>$request->tempat_lahir,
            "tgl_lahir"=>$request->tgl_lahir,
            "alamat"=>$request->alamat,
            "rt"=>$request->rt,
            "rw"=>$request->rw,
            "kode_pos"=>$request->kodepos,
            "id_provinsi"=>$request->i_prop,
            "id_kota"=>$request->i_city,
            "id_kecamatan"=>$request->i_district,
            "id_kelurahan"=>$request->i_subdistrict,
            "no_telp"=>$request->no_telp,
            "no_hp1"=>$request->nohp1,
            "email"=>$request->email,
            "status_nikah"=>$request->status_nikah,
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

    function spouseInformation(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>"1",
            "nama_lengkap_pasangan"=>$request->nama_lengkap_pasangan,
            "no_ktp_pasangan"=>$request->no_ktp_pasangan,
            "tempat_lahir_pasangan"=>$request->tempat_lahir_pasangan,
            "tgl_lahir_pasangan"=>$request->tgl_lahir_pasangan
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

    function jobInformation(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>"10",
            "nama_perusahaan"=>$request->nama_perusahaan,
            "jenis_pekerjaan"=>$request->jenis_pekerjaan,
            "penghasilan"=>$request->penghasilan,
            "jenis_pekerjaan_pasangan"=>$request->jenis_pekerjaan_pasangan,
            "penghasilan_pasangan"=>$request->penghasilan_pasangan,
            "biaya_rumah_tangga"=>$request->biaya_rumah_tangga,
            "pengeluaran"=>$request->pengeluaran
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

    function loanApplication(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>"221321321",
            "id_cabang"=>$request->cabang,
            "harga_jual"=>$request->harga_jual,
            "uang_muka"=>$request->uang_muka,
            "nilai_pembiayaan"=>$request->nilai_pembiyaan,
            "jangka_waktu"=>$request->jangka_waktu,
            "jenis_suku_bunga"=>$request->jenis_suku_bunga,
            "bunga"=>$request->bunga,
            "angsuran"=>$request->angsuran,
            "total_angsuran"=>$request->total_angsuran
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

    function uploadDocument(Request $request){
         if ($_FILES['document_file']['size'] != 0)
        {
            $file_document = $request->file('document_file');
            $dataFile = $this->uploadFileSubmission($file_document);
            $fl_ktp = $dataFile['fileBase64'];
            $ext_fl_ktp = $dataFile['extFile'];

            $getdatatoken = $this->getDataToken();
            $token  =  $getdatatoken['tokendata']; 
            $timestamps  =  $getdatatoken['timestamps']; 
            $dataclient = config('app')['token'];
            $partnerid = $dataclient['x-partner-id'];
            $secretkey = $dataclient['secret_key'];

            $data = '1234567891011121314151617';
            $externalid = str_shuffle($data);
            $requestbody =  json_encode(array(
                "extension"=>$ext_fl_ktp,
                "jenis_file"=>"jenis",
                "file"=>$fl_ktp,
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

    function confirmDocument(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $file_ktp = $request->file('file_ktp');
        $dataFileKtp = $this->uploadFileSubmission($file_ktp);
        $fl_ktp = $dataFileKtp['fileBase64'];

        $file_slip_gaji = $request->file('file_slip_gaji');
        $dataFileGaji = $this->uploadFileSubmission($file_slip_gaji);
        $fl_gaji = $dataFileGaji['fileBase64'];

        $file_rek_koran = $request->file('file_rek_koran');
        $dataFileKoran = $this->uploadFileSubmission($file_rek_koran);
        $fl_koran = $dataFileKoran['fileBase64'];

        $file_pas_foto = $request->file('file_pas_foto');
        $dataFileFoto = $this->uploadFileSubmission($file_pas_foto);
        $fl_foto = $dataFileFoto['fileBase64'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "kpr_id"=>"1321321",
            "file_ktp"=>$fl_ktp,
            "file_slip_gaji"=>$fl_gaji,
            "file_rek_koran"=>$fl_koran,
            "file_pas_foto"=>$fl_foto,
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

    public function uploadFileSubmission($fileNameupload){
        if (!\File::exists(public_path("upload/submission"))) {
			\File::makeDirectory(public_path("upload/submission"), 0755, true, true);
		}

        $fileBase64 = base64_encode(file_get_contents($fileNameupload->path()));
        $extFile  = $fileNameupload->getClientOriginalExtension();
        $fileOriginalName = $fileNameupload->getClientOriginalName();
        $originalName    = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $fileNameToStore    = $originalName.'_'.time().'.'.$extFile;
        $fileNameupload->move(public_path("upload/submission"), $fileNameToStore);
        $dataArr = array(
            "fileBase64" => $fileBase64,
            "extFile" => $extFile,
            "fileNameToStore" => $fileNameToStore,
        );
        return $dataArr; 
    }
}
