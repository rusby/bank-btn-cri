<?php

namespace App\Http\Controllers\BTN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Spatie\Crypto\Rsa\KeyPair;
use DataTables;

class PropertyController extends Controller
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
        // var_dump($getdatatoken );
        return   $getdatatoken;
    }

    function propertySearch(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "lokasi"=>$request->lokasi,
            "hargaMin"=>$request->hargaMin,
            "hargaMax"=>$request->hargaMax,
            "tipeProperti"=>$request->tipeProperti,
            "kamarTidur"=>$request->kamarTidur,
            "kamarMandi"=>$request->kamarMandi,
            "namaDeveloper"=>$request->namaDeveloper,
            "namaProper"=>$request->namaProper,
            "luasTanahMin"=>$request->luasTanahMin,
            "luasTanahMax"=>$request->luasTanahMax,
            "luasBangunanMin"=>$request->luasBangunanMin,
            "luasBangunanMax"=>$request->luasBangunanMax,
            "subsidi"=>$request->subsidi,
            "sort"=>$request->sort,
            "fasilitas"=>$request->fasilitas,
            "halKe"=>$request->halKe
        ));
        // print_r($requestbody);
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/property/search:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/property/search';
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
        if ($result->message == 'List Found') {
            $data =$result->data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function retrieveHousing(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "halKe"=>"1"
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/property/retrieve-housing:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/property/retrieve-housing';
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
        if ($result->message == 'List Found') {
            $data =$result->data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);


    }
    
    function retrieveHousingById(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            // "proper_id"=>"1113003"
            "proper_id"=>$request->proper_id
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/property/retrieve-housing-by-id:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/property/retrieve-housing-by-id';
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
        if ($result->message == 'List Found') {
            $data =$result->data; 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function retrieveHouseType(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "proper_id"=>"1113003",
            "halKe"=>"",
            // "proper_id"=>$request->proper_id,
            // "halKe"=>$request->halKe
        ));

        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/property/retrieve-house-type:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/property/retrieve-house-type';
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
        // print_r($result);
        // $dataarray = $result->data;
        // $data = $dataarray->data;

        if ($result->message == 'List Found' && !empty($data) ) {
            // $data =$result->data; 
            
        $data = [
            [
            "ID"=> "TPR1006221606412053",
            "NAMA"=> "Tipe iOS 29 juni ",
            "ID_DEV"=> "A427",
            "ID_PROPER"=> "1113003",
            "JENIS"=> "2",
            "KLASTER"=> "ClusterB",
            "BLOK"=> "B1",
            "SUBSIDI"=> "1",
            "GBR1"=> "1|tiperumah/20220610/gambar162a30dd931a69.png",
            "GBR2"=> null,
            "GBR3"=> null,
            "GBR4"=> null,
            "GBR5"=> null,
            "LATITUDE"=> "0",
            "LONGITUDE"=> "0",
            "DESKRIPSI"=> null,
            "KAMAR_TIDUR"=> "1",
            "KAMAR_MANDI"=> "1",
            "FASILITAS"=> "{\"Kelengkapan Rumah\"=>{\"41\"=>\"Ruang Tamu\",\"8\"=>\"Ruang
            Kerja\"},\"Akses\"=>{\"14\"=>\"Bank\\/ ATM\"},\"Fasilitas\"=>{\"40\"=>\"CCTV\",\"39\"=>\"Row Jalan 12\"}}",
            "LANTAI"=> "1",
            "DAYA_LISTRIK"=> "1.300",
            "LUAS_TANAH"=> "500",
            "LUAS_BANGUNAN"=> "600",
            "HARGA_MULAI"=> "150000000",
            "HARGA_SAMPAI"=> "150000000",
            "BOOKING_FEE"=> "1000000",
            "SERTIFIKAT"=> "SHGB",
            "ALAMAT"=> "jalan",
            "KODEPOS"=> "33362",
            "ID_PROPINSI"=> "19",
            "ID_KAB_KOTA"=> "1905",
            "ID_KECAMATAN"=> "190506",
            "ID_DESA_KELURAHAN"=> "1905062001",
            "TGL_INSERT"=> "2022-06-10 16=>24=>41",
            "KEYWORD"=> "tpr1006221606412052, tipe ios 11 juni , adri sinaga, proyek 11 juni ios, kep. bangka belitung,
            kab. bangka barat, parittiga, sekar biru",
            "CATATAN"=> "",
            "GARASI_LAMA"=> null,
            "JALUR_TELEPON_LAMA"=> null,
            "JALUR_PDAM_LAMA"=> null,
            "NAMA_PROPINSI_LAMA"=> null,
            "NAMA_KAB_KOTA_LAMA"=> null,
            "NAMA_KECAMATAN_LAMA"=> null,
            "NAMA_DESA_KELURAHAN_LAMA"=> null,
            "VIDEO"=> "",
            "STATUS_PENGAJUAN"=> "4",
            "TGL_UPDATE_STATUS"=> "2022-06-14 13=>19=>05",
            "STATUS"=> "1",
            "NAMA_PROPER"=> "Proyek 29 Juni iOS",
            "NAMA_DEV"=> "Adri Sinaga",
            "PROPINSI"=> "Kep. Bangka Belitung",
            "KAB_ATAU_KOTA"=> "Kabupaten",
            "KAB_KOTA"=> "Kab. Bangka Barat",
            "KECAMATAN"=> "Parittiga",
            "DESA_ATAU_KEL"=> "Desa",
            "DESA_KEL"=> "Sekar Biru",
            "JML_KAVLING"=> "5",
            "JML_DILIHAT"=> "1",
            "EMBED360"=> null,
            "URL_PROMO"=> "",
            "STATUS_PROMO"=> "1",
            "pmt_konvensional"=> "805012",
            "pmt_syariah"=> "797180.110173028",
            "sk_bga"=> "5",
            "sk_bga_syariah"=> "5"
            ],
            [
                "ID"=> "TPR1006221606412052",
                "NAMA"=> "Tipe iOS 11 juni ",
                "ID_DEV"=> "A427",
                "ID_PROPER"=> "1113003",
                "JENIS"=> "2",
                "KLASTER"=> "ClusterB",
                "BLOK"=> "B1",
                "SUBSIDI"=> "1",
                "GBR1"=> "1|tiperumah/20220610/gambar162a30dd931a69.png",
                "GBR2"=> null,
                "GBR3"=> null,
                "GBR4"=> null,
                "GBR5"=> null,
                "LATITUDE"=> "0",
                "LONGITUDE"=> "0",
                "DESKRIPSI"=> null,
                "KAMAR_TIDUR"=> "1",
                "KAMAR_MANDI"=> "1",
                "FASILITAS"=> "{\"Kelengkapan Rumah\"=>{\"41\"=>\"Ruang Tamu\",\"8\"=>\"Ruang
                Kerja\"},\"Akses\"=>{\"14\"=>\"Bank\\/ ATM\"},\"Fasilitas\"=>{\"40\"=>\"CCTV\",\"39\"=>\"Row Jalan 12\"}}",
                "LANTAI"=> "1",
                "DAYA_LISTRIK"=> "1.300",
                "LUAS_TANAH"=> "500",
                "LUAS_BANGUNAN"=> "600",
                "HARGA_MULAI"=> "150000000",
                "HARGA_SAMPAI"=> "150000000",
                "BOOKING_FEE"=> "1000000",
                "SERTIFIKAT"=> "SHGB",
                "ALAMAT"=> "jalan",
                "KODEPOS"=> "33362",
                "ID_PROPINSI"=> "19",
                "ID_KAB_KOTA"=> "1905",
                "ID_KECAMATAN"=> "190506",
                "ID_DESA_KELURAHAN"=> "1905062001",
                "TGL_INSERT"=> "2022-06-10 16=>24=>41",
                "KEYWORD"=> "tpr1006221606412052, tipe ios 11 juni , adri sinaga, proyek 11 juni ios, kep. bangka belitung,
                kab. bangka barat, parittiga, sekar biru",
                "CATATAN"=> "",
                "GARASI_LAMA"=> null,
                "JALUR_TELEPON_LAMA"=> null,
                "JALUR_PDAM_LAMA"=> null,
                "NAMA_PROPINSI_LAMA"=> null,
                "NAMA_KAB_KOTA_LAMA"=> null,
                "NAMA_KECAMATAN_LAMA"=> null,
                "NAMA_DESA_KELURAHAN_LAMA"=> null,
                "VIDEO"=> "",
                "STATUS_PENGAJUAN"=> "4",
                "TGL_UPDATE_STATUS"=> "2022-06-14 13=>19=>05",
                "STATUS"=> "1",
                "NAMA_PROPER"=> "Proyek 11 Juni iOS",
                "NAMA_DEV"=> "Adri Sinaga",
                "PROPINSI"=> "Kep. Bangka Belitung",
                "KAB_ATAU_KOTA"=> "Kabupaten",
                "KAB_KOTA"=> "Kab. Bangka Barat",
                "KECAMATAN"=> "Parittiga",
                "DESA_ATAU_KEL"=> "Desa",
                "DESA_KEL"=> "Sekar Biru",
                "JML_KAVLING"=> "5",
                "JML_DILIHAT"=> "1",
                "EMBED360"=> null,
                "URL_PROMO"=> "",
                "STATUS_PROMO"=> "1",
                "pmt_konvensional"=> "805012",
                "pmt_syariah"=> "797180.110173028",
                "sk_bga"=> "5",
                "sk_bga_syariah"=> "5"
                ],
        ];

        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }
    
    function retrieveHouseTypeById(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "tipeRumah_id"=>"TPR1006221606412052"
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/property/retrieve-house-type-by-id:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/property/retrieve-house-type-by-id';
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

    function retrieveHouseLot(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "tipeRumah_id"=>$request->tipeRumah_id
            // "tipeRumah_id"=>"TPR1006221606412052"
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/property/retrieve-house-lot:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/property/retrieve-house-lot';
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

        // if ($result->message == 'List Found') {
            // $data =$result->data; 
            $data = [[
                "ID"=> "KAV20151120144458504",
                "ID_DEV"=> "NPS3",
                "ID_PROPER"=> "1734048",
                "ID_TIPE"=> "TPR2015112014403140",
                "NAMA_DEV"=> "Nusantara Prospekindo Sukses Pt",
                "NAMA_PROPER"=> "APARTEMEN THE OASIS CIKARANG",
                "NAMA_TIPE"=> "44",
                "NAMA"=> "ACACIA TOWER",
                "BLOK"=> "LANTAI-30",
                "NO"=> "7",
                "KLASTER"=> "ACACIA TOWER",
                "HARGA"=> "780000000",
                "BOOKING_FEE"=> null,
                "JENIS"=> "3",
                "GBR1"=> "TPR2015112014403140/20112015024227_show Unit Type 1+1 BR ( Study Room.jpg",
                "GBR2"=> "TPR2015112014403140/20112015024230_Show Unit Type 1+1 BR ( Ruang Tidur).jpg",
                "GBR3"=> "TPR2015112014403140/20112015024233_Show Unit Type 1+1 BR ( Dapur & Living Room ).jpg",
                "GBR4"=> "TPR2015112014403140/20112015024220_tower acacia one building.jpg",
                "GBR5"=> "TPR2015112014403140/20112015024223_tower acacia.jpg",
                "EMBED360"=> null,
                "DESKRIPSI"=> "PRESTIGIOUS & LUXURIOUS, TYPE UNIT: 1 + 1 BR, VIEW: POOL",
                "SUBSIDI"=> "0",
                "LUAS_TANAH"=> "44",
                "LUAS_BANGUNAN"=> "44",
                "TAHUN_BANGUN"=> "2015",
                "STATUS_UNIT"=> "1"
            ]];
        // } else {
        //     $data = []; 
        // }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
    }

    function retrieveHouseLotById(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            // "kavling_id"=>"KAV20151120144459185"
            "kavling_id"=>$request->kavling_id
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/property/retrieve-house-lot-by-id:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/property/retrieve-house-lot-by-id';
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

        if ($result->message == 'List Found') {
            $data =array($result->data); 
        } else {
            $data = []; 
        }
        return Datatables::of($data)->addIndexColumn()->toJson(true);
        // echo "<pre>";
        // print_r($data);
        // echo "<pre>";
    }

    function retrieveDeveloperById(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "developer_id"=>"NPS3"
        ));
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/property/retrieve-developer-by-id:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/property/retrieve-developer-by-id';
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

    function retrieveNearbyHousing(Request $request){
        $getdatatoken = $this->getDataToken();
        $token  =  $getdatatoken['tokendata']; 
        $timestamps  =  $getdatatoken['timestamps']; 
        $dataclient = config('app')['token'];
        $partnerid = $dataclient['x-partner-id'];
        $secretkey = $dataclient['secret_key'];

        $data = '1234567891011121314151617';
        $externalid = str_shuffle($data);
       	$requestbody =  json_encode(array(
            "lat"=>$request->lat,
            "long"=>$request->long,
            "dist"=>$request->dist,
            "halKe"=>$request->halKe
        ));
        print_r($requestbody);
        $sha256 =  strtolower(hash('sha256', $requestbody));
        $plaintex = 'POST:/btnproperti/snap/v1/property/retrieve-nearby-housing:'.$token.':'.$sha256.':'.$timestamps;
        $signature = base64_encode(hash_hmac('sha512', 	$plaintex, $secretkey, true));
        $method = 'POST';
        $url   = 'https://devapi.btn.co.id/btnproperti/snap/v1/property/retrieve-nearby-housing';
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
        if ($result->message == 'List Found') {
            $data =$result->data; 
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
