<?php

namespace App\Traits;

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
use Auth;

trait OperasionalTrait{

    public static function apiDataDiri($request, $id){
        $selCollection = CollectionFile::findOrFail($id);
        $request->status_pernikahan = $request->status_pernikahan ?? $selCollection->status_pernikahan;
        $reqDataDiri = $request->except(['status_pernikahan', 'nama_pasangan', 'tgl_lahir_pasangan', 'no_ktp_pasangan', 'provinsi_id', 'kota_id', 'kecamatan_id', 'is_pasangan_meninggal', 'is_equals_ktpdomisili', 'nama_calon_debitur']);
        $reqDataDiri['tanggal_kadaluarsa_ktp'] = "Seumur Hidup";
        $reqDataDiri['createdBy'] = \Auth::user()->id;
        if (\Auth::user()->getRoleNames()->first() == "sales lepas" || \Auth::user()->getRoleNames()->first() == "sales developer") {
            $reqDataDiri['program_pemasaran'] = !is_null($selCollection->jenis_sub_kredit) ? $selCollection->jenis_kredit.' - '.$selCollection->jenis_sub_kredit : $selCollection->jenis_kredit;
        }else{
            $reqDataDiri['program_pemasaran'] = $selCollection->jenis_kredit;
        }
        $reqDataDiri['jenis_debitur'] = "Individu";
        $reqDataDiri['nama_debitur'] = $request->nama_calon_debitur;
        $reqDataDiri['no_hp'] = $selCollection->no_telp_debitur;
        if ($request->status_pernikahan != 'Menikah') {
            $colFile['is_pasangan_meninggal'] = 0;
        }elseif($request->status_pernikahan == 'Menikah' && $request->is_pasangan_meninggal == 1){
            $colFile['is_pasangan_meninggal'] = 1;
        }
        if (isset($request->is_equals_ktpdomisili)) {
            $reqDataDiri['alamat_ktp'] = $request->alamat_domisili;
        }else{
            $reqDataDiri['alamat_ktp'] = $request->alamat_ktp;
        }
        $colFile['status_pernikahan'] = $request->status_pernikahan;
        $colFile['nama_calon_debitur'] = $reqDataDiri['nama_debitur'];
        if ($selCollection->dataDiri()->exists()) {
            $val = Validator::make($request->only('email'), [
                'email'                       => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:data_diri,email,'.$selCollection->dataDiri->id ,
            ]);

            if($val->fails()) {
                return response()->json([
                    'status'    => "fail",
                    'messages' => $val->errors()->first()
                ],422);
            }
        }

        $birth = new \DateTime($request->tanggal_lahir);
        $today = new \DateTime(date("d-m-Y"));

        $age = $birth->diff($today)->y;

        $reqDataDiri['no_npwp'] = preg_replace('/\./', '', $reqDataDiri['no_npwp']);
        $reqDataDiri['no_npwp'] = preg_replace('/\-/', '', $reqDataDiri['no_npwp']);
        $validator = Validator::make($reqDataDiri,
            [
                'createdBy'                   => 'required',
                'no_ktp'                      => 'required|numeric|digits:16', //1212121212121212
                'no_kk'                       => 'required|numeric',
                'nama_debitur'                => 'required', //hanya bisi alphabet dan disii dengan space saja
                'tanggal_lahir'               => 'required|date_format:d-m-Y', //10-05-2022
                'pendidikan_terakhir'         => 'required',
                'jenis_kelamin'               => 'required|in:L,P', //L
                'alamat_domisili'             => 'required', //jl. mawar V no 70
                'kelurahan_id'                => 'required|numeric', //101
                'lama_menetap'                => 'required|numeric|max:100', //75
                'lama_berkerja'               => 'required|numeric|max:100', //30
                'no_npwp'                     => 'required|digits:15', //30
                'nama_gadis_ibu_kandung'      => 'required|regex:/^[a-zA-Z\s]*$/|max:250',
                'no_telp'                     => 'required|digits_between:9,13', //0219090101
                // 'no_hp'                       => 'required',
                'kepemilikan_tempat_tinggal'  => 'required',
                'status_kepegawaian'          => 'required|in:Karyawan Tetap,Karyawan Kontrak',
                'jenis_pekerjaan'             => 'required',
                'nama_perusahaan'             => 'required',
                'no_sk_kenaikan_pangkat'      => 'required', //SK1.0111
                'usia_masa_persiapan_pensiun' => 'required|numeric|max:100',
                'sumber_penghasilan'          => 'required|max:250',
                'nama_keluarga_dekat'         => 'required|max:250',
                'no_telp_keluarga_dekat'      => 'required|digits_between:9,13', //081390129011
                'memiliki_simpanan_bri'       => 'required|in:Ya,Tidak',
            ]);
        $request['updatedBy'] = null;

        if($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                // 'messages' => strlen($reqDataDiri['no_npwp'])
                'messages' => $validator->errors()->first()
            ],422);
        }
        if ($request->memiliki_simpanan_bri == "Ya") {
            $val = Validator::make($request->only('no_rek_bri'), [
                'no_rek_bri' => 'required|numeric|digits:15',
            ]);

            if($val->fails()) {
                return response()->json([
                    'status'    => "fail",
                    'messages' => $val->errors()->first()
                ],422);
            }
            $reqDataDiri['no_rek_bri'] = $request->no_rek_bri;
        }
        if ($age < 17){
            return response()->json([
                'status'    => "fail",
                'messages' => "Umur anda belum 17 tahun."
            ],422);
        }
        $colFile['no_ktp'] = $request->no_ktp;
        $role = Auth::user()->getRoleNames()->first();
        if ($role != 'sales developer' && $role != 'sales lepas') {
            $colFile['status_id'] = 5;
        }
        $colFile['no_kk'] = $request->no_kk;

        $dataCol = CollectionFile::updateOrCreate(
            ['id' => $id],
            $colFile
        );

        if ($role != 'sales developer' && $role != 'sales lepas') {
            \Helper::storeStatusHistory($dataCol->id, $dataCol->status_id);
        }

        $data = DataDiri::updateOrCreate(
            ['collection_files_id'     => $dataCol->id],
            $reqDataDiri
        );

        if ($request->status_pernikahan == "Menikah") {
            $reqPasangan = $request->only(['nama_pasangan', 'tgl_lahir_pasangan', 'no_ktp_pasangan']);
            $reqPasangan['createdBy']    = \Auth::user()->id;
            $reqPasangan['data_diri_id'] = $data->id;
            $validator   = Validator::make($reqPasangan,
                [
                    'no_ktp_pasangan'    => 'required|numeric|digits:16',
                    'nama_pasangan'      => 'required|regex:/^[a-zA-Z\s]*$/|max:250',
                    'tgl_lahir_pasangan' => 'required|date_format:d-m-Y',
                ]);

            if($validator->fails()) {
                return response()->json([
                    'status'   => "fail",
                    'messages' => $validator->errors()->first(),
                ],422);
            }

            $pasangan = DataPasangan::updateOrCreate(
                ['no_ktp_pasangan' => $request->no_ktp_pasangan],
                $reqPasangan
            );

            return response()->json([
                'status'        => "ok",
                'messages'      => "Berhasil menyimpan informasi pribadi",
                'data_pribadi'  => $data,
                'data_pasangan' => $pasangan
            ], 200);
        }

        return response()->json([
            'status'    => "ok",
            'messages'  => "Berhasil menyimpan informasi pribadi",
            'data'      => $data
        ], 200);
    }

    public static function apiAnalisaFinansial($request, $id){
        $selCollection = CollectionFile::findOrFail($id);
        $request['pendapatan_bersih'] = str_replace(".", "", $request->pendapatan_bersih);
        $request['penghasilan_pasangan'] = str_replace(".", "", $request->penghasilan_pasangan);
        $request['penghasilan_lainnya'] = str_replace(".", "", $request->penghasilan_lainnya);
        $request['angsuran_pinjaman_lain'] = str_replace(".", "", $request->angsuran_pinjaman_lain);
        $request['harga_rumah'] = str_replace(".", "", $request->harga_rumah);
        $request['uang_muka'] = str_replace(".", "", $request->uang_muka);
        $request['jumlah_permohonan_kredit'] = str_replace(".", "", $request->jumlah_permohonan_kredit);
        $request['data_diri_id'] = $selCollection->dataDiri->id;
        $request['createdBy'] = \Auth::user()->id;
        $reqFinansial = $request->all();

        $validator = Validator::make($reqFinansial,
            [
                'data_diri_id'                 => 'required',
                'createdBy'                    => 'required',
                'pendapatan_bersih'            => 'required',
                'penghasilan_lainnya'          => 'required',
                'angsuran_pinjaman_lain'       => 'required',
                'jangka_waktu_kredit'          => 'required|numeric',
                'harga_rumah'                  => 'required',
                'uang_muka'                    => 'required',
                'jumlah_permohonan_kredit'     => 'required',
                'pernah_pinjam_di_bank_lain'   => 'required|in:Ya,Tidak',
                'jenis_fasilitas_di_bank_lain' => 'required|in:Simpanan,Pinjaman,Tidak',
            ]);

        if($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages' => $validator->errors()->first(),
            ],422);
        }

        $role = Auth::user()->getRoleNames()->first();
        if ($role != 'sales developer' && $role != 'sales lepas') {
            CollectionFile::updateOrCreate(
                ['id' => $id],
                ['status_id' => 5]
            );
        }
        CollectionFile::updateOrCreate(
            ['id' => $id],
            ['jumlah_permohonan_kredit' => $request->jumlah_permohonan_kredit]
        );

        $data = AnalisaFinansial::updateOrCreate(
            ['data_diri_id' => $request->data_diri_id],
            $reqFinansial
        );

        return response()->json([
            'status'    => "ok",
            'messages'  => "Berhasil menyimpan Analisa Finansial",
            'data'      => $request->all()
        ], 200);
    }

    public static function apiAgunan($request, $id){
        $selCollection = CollectionFile::findOrFail($id);
        $request['data_diri_id'] = $selCollection->dataDiri->id;
        $request['createdBy'] = \Auth::user()->id;

        $reqAgunan = $request->except(['provinsi_id', 'kota_id', 'kecamatan_id']);

        $validator = Validator::make($reqAgunan,
            [
                'data_diri_id'              => 'required',
                'createdBy'                 => 'required',
                'lokasi_tanah'              => 'required|max:250',
                'kelurahan_id'              => 'required|numeric',
                'jarak_agunan'              => 'required|max:250',
                'batas_utara_tanah'         => 'required|max:250',
                'batas_timur_tanah'         => 'required|max:250',
                'batas_selatan_tanah'       => 'required|max:250',
                'batas_barat_tanah'         => 'required|max:250',
                'bentuk_tanah'              => 'required|max:250',
                'rt'                        => 'required|numeric|max:100',
                'rw'                        => 'required|numeric|max:100',
                'jarak_terhadap_jalan'      => 'required|numeric',
                'permukaan_tanah'           => 'required|max:250',
                'luas_tanah'                => 'required|numeric',
                'no_surat_tanah'            => 'required|max:250',
                'tgl_surat_tanah'           => 'required|max:250',
                'atas_nama_surat_tanah'     => 'required|max:250',
                'jenis_kepemilikan'         => 'required|max:250',
                'nama_kantor_bpn'           => 'required|max:250',
                'no_imb'                    => 'required|max:250',
                'tgl_imb'                   => 'required',
                'luas_bangunan'             => 'required|numeric',
                'tahun_mendirikan_bangunan' => 'required|numeric',
            ]);

        if($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages'  => $validator->errors()->first(),
            ],422);
        }

        $role = Auth::user()->getRoleNames()->first();
        if ($role != 'sales developer' && $role != 'sales lepas') {
            CollectionFile::updateOrCreate(
                ['id' => $id],
                ['status_id' => 5]
            );
        }

        $data = DataAgunan::updateOrCreate(
            ['data_diri_id' => $request->data_diri_id],
            $reqAgunan
        );

        return response()->json([
            'status'    => "ok",
            'messages'  => "Berhasil menyimpan Data Agunan",
            'data'      => $data
        ], 200);
    }

    public static function apiUjiFlpp($request, $id){
        $selCollection = CollectionFile::findOrFail($id);
        if ($selCollection->status_id == 6 && \Auth::user()->getRoleNames()->first() == "operasional") {
            $val = Validator::make($request->only('sanggah_tolak_verifikasi'), [
                'sanggah_tolak_verifikasi' => 'required',
            ]);

            if($val->fails()) {
                return response()->json([
                    'status'    => "fail",
                    'messages' => "Sanggah perbaikan wajib diisi"
                ],422);
            }
        }
        $request['data_diri_id'] = $selCollection->dataDiri->id;
        $request['createdBy'] = \Auth::user()->id;
        $request['blok_alamat_agunan'] = $selCollection->dataDiri->agunan->lokasi_tanah;
        $request['no_alamat_agunan'] = $selCollection->dataDiri->agunan->lokasi_tanah;

        $request['subsidi_uang_muka'] = str_replace(".", "", $request->subsidi_uang_muka);
        $request['kode_pos_agunan'] = $selCollection->dataDiri->agunan->kelurahan->kodePos->kode_pos;
        $reqFlpp = $request->except('sanggah_tolak_verifikasi');

        $validator = Validator::make($reqFlpp,
            [
                'data_diri_id'                => 'required',
                'createdBy'                   => 'required',
                'jenis_badan_hukum_developer' => 'required|max:250',
                'nama_badan_hukum_developer'  => 'required|max:250',
                'nama_perumahan'              => 'required|max:250',
                // 'kode_pos_agunan'             => 'required|numeric|max:99999',
                'subsidi_uang_muka'           => 'required',
                'npwp_pengembang'             => 'required',
                // 'blok_alamat_agunan'          => 'required|numeric',
                // 'no_alamat_agunan'            => 'required',
                'id_rumah'                    => 'required|max:250',
                'id_struktur'                 => 'required|max:250',
                // 'no_slf'                      => 'required|max:250',
                // 'tanggal_slf'                 => 'required|date_format:d-m-Y',
                'no_rek_penerima_sbum'        => 'required|numeric',
                'nama_bank_penerima_sbum'     => 'required|max:250',
                'nama_bank_developer'         => 'required|max:250',
                'no_rek_developer'            => 'required|numeric',
            ]);

        if($validator->fails()) {
            return response()->json([
                'status'    => "fail",
                'messages'  => $validator->errors()->first(),
            ],422);
        }

        $role = Auth::user()->getRoleNames()->first();
        if ($role != 'sales developer' && $role != 'sales lepas') {
            $selCollection = CollectionFile::updateOrCreate(
                ['id' => $id],
                [
                    'status_id' => isset($request->sanggah_tolak_verifikasi) ? 7 : 8,
                    'sanggah_tolak_verifikasi' => $request->sanggah_tolak_verifikasi
                ]
            );
            \Helper::storeStatusHistory($selCollection->id, $selCollection->status_id);
        }


        $data = UjiDataFlpp::updateOrCreate(
            ['data_diri_id' => $request->data_diri_id],
            $reqFlpp
        );
        $data = DataDiri::findOrFail($request->data_diri_id);

        return response()->json([
            'status'    => "ok",
            'messages'  => "Berhasil menyimpan Uji FLPP",
            'data'      => $data
        ], 200);
    }
}
