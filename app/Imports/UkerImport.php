<?php

namespace App\Imports;

use App\Models\{
    KantorCabang,
    Provinsi,
    Kota
};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class UkerImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct($jenis){
        $this->_jenis = $jenis;
    }

    public function collection(Collection $rows)
    {
        DB::beginTransaction();        
        try {
            if ($this->_jenis == "kw") {
                foreach ($rows as $row) {
                    $provinsi = Provinsi::where('provinsi', $row['nama_provinsi'])->first();
                    if (is_null($provinsi)) {
                        echo "Provinsi {$row['nama_provinsi']} tidak ditemukan !";
                        die();
                    }
                    Kota::updateOrCreate(
                        [
                            'kota'        => $row['nama_kanwil'],
                            'id_provinsi' => $provinsi->id
                        ],
                        [
                            'kota'        => $row['nama_kanwil'],
                            'id_provinsi' => $provinsi->id,
                            'is_kanwil'   => true,
                        ]
                    );
                }
            }else if ($this->_jenis == "kc") {
                DB::table('kantor_cabangs')->truncate();
                foreach ($rows as $row) {
                    $provinsi = Provinsi::where('provinsi', $row['nama_provinsi'])->first();
                    if (is_null($provinsi)) {
                        echo "Provinsi {$row['nama_provinsi']} tidak ditemukan !";
                        die();
                    }
                    $kota = Kota::where('kota', $row['nama_kanwil'])->first();
                    if (is_null($kota)) {
                        echo "Kantor wilayah {$row['nama_kanwil']} tidak ditemukan !";
                        die();
                    }
                    KantorCabang::create(
                        [
                            'kota_id'          => $kota->id,
                            'nama'             => $row['nama_kanca'],
                            'kode'             => $row['kode'],
                            'cust_provinsi_id' => $provinsi->id
                        ]
                    );
                }
            }else{
                DB::table('kantor_cabangs')->whereNotNull('kc_id')->delete();
                foreach ($rows as $row) {
                    $provinsi = Provinsi::where('provinsi', $row['nama_provinsi'])->first();
                    if (is_null($provinsi)) {
                        echo "Provinsi {$row['nama_provinsi']} tidak ditemukan !";
                        die();
                    }
                    $kanca = KantorCabang::where('nama', $row['nama_kanca'])->first();
                    if (is_null($kanca)) {
                        echo "Nama kantor cabang {$row['nama_kanca']} tidak ditemukan !";
                        die();
                    }
                    KantorCabang::create(
                        [
                            'kota_id'          => $kanca->kota_id,
                            'nama'             => $row['nama_kcp'],
                            'kode'             => $row['kode'],
                            'kc_id'            => $kanca->id,
                            'cust_provinsi_id' => $provinsi->id
                        ]
                    );
                }
            } 
            echo "berhasil";
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
