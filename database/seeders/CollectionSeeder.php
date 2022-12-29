<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Collection\CollectionFile;
use App\Models\Files\{
	FlppFiles,
	FlppFilesLainnya,
	FlppFilesTambahan,
	FlppFilesTambahanLainnya
};
use App\Models\File;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = Str::uuid()->toString();
    	CollectionFile::create([
    		'id' 				   => $id,
    		'nama_calon_debitur'   => 'Sendi Hadi',
    		'nama_developer'   	   => 'Developer Wijaya',
    		'nama_project'		   => 'BSD Rumah Ceria',
    		'uker_kode'			   => 438,
    		'jenis_kredit'		   => 'KPR Subsidi FLPP (Fix Income)',
    		'createdBy'			   => 1 
    	]);

    	$flpp = FlppFiles::create([
            'collection_id'          => $id,
    		'folder'				 => 'flpp',
    		'ktp_pengajuan' 		 => 'ktp_pengajuan.jpg',
    		'ktp_pasangan' 			 => 'ktp_pasangan.jpg',
    		'npwp' 					 => 'npwp.jpg',
    		'kartu_keluarga' 		 => 'kartu_keluarga.jpg',
    		'akta_nikah' 			 => 'akta_nikah.jpg',
    		'keterangan_belum_nikah' => 'keterangan_belum_nikah.jpg',
    		'copy_sk_pegawai_tetap'  => 'copy_sk_pegawai_tetap.jpg',
    		'asli_sk_aktif_bekerja'  => 'asli_sk_aktif_bekerja.jpg',
    		'asli_slip_gaji' 		 => 'asli_slip_gaji.jpg',
    		'asli_rekening_koran'    => 'asli_rekening_koran.jpg',
    		'spr_dari_developer' 	 => 'spr_dari_developer.jpg'
    	]);

    	$file1 = File::create([
    		'name' 		 => 'flpp_lainnya1.jpg',
    		'folder' 	 => 'flpp_lainnya',
    		'created_by' => 1
    	]);

    	$file2 = File::create([
    		'name' 		 => 'flpp_lainnya2.jpg',
    		'folder' 	 => 'flpp_lainnya',
    		'created_by' => 1
    	]);

    	FlppFilesLainnya::insert([
    		[
    			'flpp_files_id' => $flpp->id,
    			'file_id'		=> $file1->id,
    			'nama_file'		=> 'Flpp Lainnya 1 yaap'
    		],
    		[
    			'flpp_files_id' => $flpp->id,
    			'file_id'		=> $file2->id,
    			'nama_file'		=> 'Flpp Lainnya 2 yaap'
    		]
    	]);

    	$flppTambahan = FlppFilesTambahan::create([
            'collection_id'                        => $id,
    		'folder' 							   => 'flpp_tambahan',
    		'form_aplikasi_kprs' 				   => 'form_aplikasi_kprs.jpg',
    		'surat_pernyataan_pemohon' 			   => 'surat_pernyataan_pemohon.jpg',
    		'surat_status_kepemilikan_rumah'   	   => 'surat_status_kepemilikan_rumah.jpg',
    		'surat_pernyataan_penghasilan'		   => 'surat_pernyataan_penghasilan.jpg',
    		'surat_pernyataan_verifikasi' 		   => 'surat_pernyataan_verifikasi.jpg',
    		'surat_pernyataan_belum_memiliki_rumah' => 'surat_pernyataan_belum_memiliki_rumah.jpg'
    	]);

    	$file1 = File::create([
    		'name' 		 => 'flpp_tambahan_lainnya1.jpg',
    		'folder' 	 => 'flpp_tambahan_lainnya',
    		'created_by' => 1
    	]);

    	$file2 = File::create([
    		'name' 		 => 'flpp_tambahan_lainnya2.jpg',
    		'folder' 	 => 'flpp_tambahan_lainnya',
    		'created_by' => 1
    	]);

    	FlppFilesTambahanLainnya::insert([
    		[
    			'flpp_files_tambahan_id' => $flppTambahan->id,
    			'file_id'				 => $file1->id,
    			'nama_file'				 => 'Flpp Tambahan Lainnya 1 yaap'
    		],
    		[
    			'flpp_files_tambahan_id' => $flppTambahan->id,
    			'file_id'				 => $file2->id,
    			'nama_file'				 => 'Flpp Tambahan Lainnya 2 yaap'
    		]
    	]);
    }
}
