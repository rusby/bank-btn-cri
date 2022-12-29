<?php

namespace App\Imports;

use App\Models\{
    KantorCabang,
    Provinsi,
    Kota,
    User,
    UserBri
};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Carbon\Carbon;

class UserImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct($jenis){
        $this->role = $jenis;
    }

    public function collection(Collection $rows)
    {
        ini_set('max_execution_time', 300);
        DB::beginTransaction();        
        try {
            if ($this->role == "kw") {
                foreach ($rows as $row) {
                    $kota = Kota::where('kota', $row['nama_kanwil'])->first();
                    if (is_null($kota)) {
                        echo "Kantor wilayah {$row['nama_kanwil']} tidak ditemukan !";
                        die();
                    }
                    $namaKanwil = explode(" ", strtolower($row['nama_kanwil']));
                    // die();
                    if (count($namaKanwil) == 1) {
                        $uname = $namaKanwil[0];
                    }elseif (count($namaKanwil) == 2) {
                        $uname = $namaKanwil[0].$namaKanwil[1];
                    }
                    // echo $uname;
                    $wilayah = User::updateOrCreate(
                        [
                            'email' => $uname."@wilayah.com"
                        ],
                        [
                            'name'     => "Kantor wilayah {$row['nama_kanwil']}",
                            'username' => $uname,
                            'password' => \Hash::make('123123'),
                            'email_verified_at' => Carbon::now(),
                            'is_approved' => true
                        ]);
                    $wilayah->assignRole('Kantor Wilayah');

                    UserBri::insert([
                        [
                            'user_id'         => $wilayah->id,
                            'is_kantor_pusat' => false,
                            'kanwil_id'       => $kota->id,
                            'kanca_kode'      => null
                        ]
                    ]);
                }
            }else if ($this->role == "kc") {
                foreach ($rows as $value => $row) {
                    $kota = Kota::where('kota', $row['nama_kanwil'])->first();
                    if (is_null($kota)) {
                        echo "Kantor wilayah {$row['nama_kanwil']} tidak ditemukan !";
                        die();
                    }
                    $kanca = KantorCabang::where('nama', $row['nama_kanca'])->first();
                    if (is_null($kanca)) {
                        echo "Nama kantor cabang {$row['nama_kanca']} tidak ditemukan !";
                        die();
                    }
                    // echo $row['nama_kanca'];
                    $namaKanca = explode(" ", strtolower($row['nama_kanca']));
                    if (count($namaKanca) == 1) {
                        $uname = $namaKanca[0];
                    }elseif (count($namaKanca) == 2) {
                        $uname = $namaKanca[0].$namaKanca[1];
                    }elseif (count($namaKanca) == 3) {
                        $uname = $namaKanca[0].$namaKanca[1].$namaKanca[2];
                    }elseif (count($namaKanca) == 4) {
                        $uname = $namaKanca[0].$namaKanca[1].$namaKanca[2].$namaKanca[3];
                    }elseif (count($namaKanca) == 5) {
                        $uname = $namaKanca[0].$namaKanca[1].$namaKanca[2].$namaKanca[3].$namaKanca[4];
                    }
                    // echo $uname.'-';
                    $prFix = $uname."-".$row['kode_kanca'];
                    $cabang = User::updateOrCreate(
                        [
                            'email' => $prFix."@cabang.com"
                        ],
                        [
                            'name'     => "Kantor cabang {$row['nama_kanca']}",
                            'username' => $prFix,
                            'password' => \Hash::make('123123'),
                            'email_verified_at' => Carbon::now(),
                            'is_approved' => true
                        ]);
                    $cabang->assignRole('Kantor Cabang');

                    UserBri::updateOrCreate(
                        [
                            'user_id'         => $cabang->id,
                        ],
                        [
                            'user_id'         => $cabang->id,
                            'is_kantor_pusat' => false,
                            'kanwil_id'       => $kota->id,
                            // 'kanca_kode'      => $row['kode_kanca']
                            'kanca_kode'      => $kanca->id
                        ]
                    );
                }
            }else{
                foreach ($rows as $row) {
                    $kota = Kota::where('kota', $row['nama_kanwil'])->first();
                    if (is_null($kota)) {
                        echo "Kantor wilayah {$row['nama_kanwil']} tidak ditemukan !";
                        die();
                    }
                    $kanca = KantorCabang::where('nama', $row['nama_kanca'])->first();
                    if (is_null($kanca)) {
                        echo "Nama kantor cabang {$row['nama_kanca']} tidak ditemukan !";
                        die();
                    }
                    if (!is_null($row['nama_kcp'])) {
                        $namaKcp = explode(" ", strtolower($row['nama_kcp']));
                        if (count($namaKcp) == 1) {
                            $uname = $namaKcp[0];
                        }elseif (count($namaKcp) == 2) {
                            $uname = $namaKcp[0].$namaKcp[1];
                        }elseif (count($namaKcp) == 3) {
                            $uname = $namaKcp[0].$namaKcp[1].$namaKcp[2];
                        }elseif (count($namaKcp) == 4) {
                            $uname = $namaKcp[0].$namaKcp[1].$namaKcp[2].$namaKcp[3];
                        }elseif (count($namaKcp) == 5) {
                            $uname = $namaKcp[0].$namaKcp[1].$namaKcp[2].$namaKcp[3].$namaKcp[4];
                        }
                        // echo $uname.'-';
                        $prFix = $uname."-".$row['kode_kcp'];
                        $kcp = User::updateOrCreate(
                            [
                                'email' => $prFix.'@kcp.com'
                            ],
                            [
                                'name'     => "Kantor cabang Pembantu ".strtolower($row['nama_kcp']),
                                'username' => $prFix,
                                'password' => \Hash::make('123123'),
                                'email_verified_at' => Carbon::now(),
                                'is_approved' => true
                            ]);
                        $kcp->assignRole('Kantor Cabang Pembantu');

                        UserBri::updateOrCreate(
                            [
                                'user_id'         => $kcp->id,
                            ],
                            [
                                'user_id' => $kcp->id,
                                'kcp_kode'=> $row['kode_kcp']
                            ]
                        );

                        // echo $row['nama_kcp'];
                    }
                }
            } 
            echo "berhasil";
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
