<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection\CollectionStatus;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = ['Belum dicek', 'Berkas Tidak Lengkap', 'Pengajuan Kembali Berkas', 'Selesai Pengecekan Berkas', 'Pengecekan data Input', 'Ditolak Verifikasi CRI', 'Pengajuan Kembali Verifikasi CRI', 'Pending Verifikasi CRI', 'Diterima Verifikasi CRI', 'Terkirim ke Uker BRI', 'Sudah Diproses BRI', 'Analisa dan Verifikasi BRI', 'Ditolak BRI', 'Diproses BRI','Calon Debitur Membatalkan BRI', 'Akad Kredit BRI', 'Pencairan BRI'];
    	foreach ($data as $v) {
    		CollectionStatus::insert([
    			'nama' => $v
    		]);
    	}
    }
}
