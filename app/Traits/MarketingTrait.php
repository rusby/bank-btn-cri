<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use App\Models\Collection\{
	CollectionFile,
	DeveloperProjectFiles,
	DeveloperProject,
	Developer
};
use App\Models\Berkas\{
	DokumenUtama,
	DokumenLainnya,
	DokumenTambahan,
	DokumenTambahanLainnya
};
use App\Models\File;
use App\Models\Operasional\AnalisaFinansial;
use DB;

trait MarketingTrait{
	public static function mappingName($request){
		$reqDataDiri = $request->only(['kantor_cabang', 'no_ktp', 'nama_calon_debitur', 'status_pernikahan', 'nama_developer', 'no_telp_developer', 'nama_project', 'alamat_project', 'jenis_kredit', 'no_telp_debitur', 'no_kk']);

		$cekTolak = CollectionFile::where([
			['no_ktp', $request->no_ktp],
			['status_id', 14]
		])->count();
		if ($cekTolak > 0) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Aplikasi dengan no ktp ".$request->no_ktp." pernah diajukan dengan status Putus Ttolak BRI. Silakan hubungi admin untuk info selengkapnya.",
			],422);
		}

		$validator = Validator::make($reqDataDiri, [
			'nama_calon_debitur' => 'required',
			'no_ktp' => 'required|numeric|digits:16',
			// 'no_kk' => 'required',
			'no_telp_debitur'   => 'required',
			'no_telp_developer' => 'required|min:8|max:13',
			'nama_developer' => 'required',
			'nama_project' => 'required',
			'alamat_project' => 'required|max:255',
			'kantor_cabang' => 'required',
			'jenis_kredit' => 'required',
			'status_pernikahan' => 'required|in:Menikah,Belum Menikah,Cerai',
		]);
		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}
		if (!$request->kantor_cabang) {
			return response()->json([
				'status'    => "fail",
				'messages'  => "Kantor cabang tidak ditemukan, silakan coba lagi.",
			],422);
		}

		DB::beginTransaction();
		try {
			$selCollection = CollectionFile::with('dokumenUtama.dokumenUtamaLainnya')->where('no_ktp', $request->no_ktp)->count();
			if($selCollection < 1){
				$reqDataDiri['status_id'] = 1;
			}

			if ($request->jenis_kredit == 'KPR Tapera (Peserta Tapera)') {
				$validator = Validator::make($request->only(['jenis_sub_kredit']), [
					'jenis_sub_kredit' => 'required:KPR,KBR,KRR'
				]);
				if($validator->fails()) {
					return response()->json([
						'status'    => "fail",
						'messages'  => $validator->errors()->first(),
					],422);
				}
				$reqDataDiri['jenis_sub_kredit'] = $request->jenis_sub_kredit;
			}

			if ($request->jenis_kredit == 'KPR Komersial (Baru atau Secondary)') {
				$validator = Validator::make($request->only(['jenis_pekerjaan']), [
					'jenis_pekerjaan' => 'required|in:Pegawai,Profesional,Wiraswasta'
				]);
				if($validator->fails()) {
					return response()->json([
						'status'    => "fail",
						'messages'  => $validator->errors()->first(),
					],422);
				}
				$reqDataDiri['jenis_pekerjaan'] = $request->jenis_pekerjaan;
			}

			$reqDataDiri['jumlah_permohonan_kredit'] = null;
			if ($request->jenis_kredit != 'KPR Subsidi FLPP (Fix Income)') {
				$request['jumlah_permohonan_kredit'] = preg_replace('/\./', '', $request->jumlah_permohonan_kredit);
				$reqDataDiri['jumlah_permohonan_kredit'] = $request['jumlah_permohonan_kredit'];
				$validator = Validator::make($request->only(['jumlah_permohonan_kredit']), [
					'jumlah_permohonan_kredit' => 'required|numeric'
				]);
				if($validator->fails()) {
					return response()->json([
						'status'    => "fail",
						'messages'  => $validator->errors()->first(),
					],422);
				}
			}

			if ($request->status_pernikahan == 'Menikah') {
				$validator = Validator::make($request->only(['is_pasangan_meninggal']), [
					'is_pasangan_meninggal' => 'required'
				]);
				if($validator->fails()) {
					return response()->json([
						'status'    => "fail",
						'messages'  => $validator->errors()->first(),
					],422);
				}
				$reqDataDiri['is_pasangan_meninggal'] = $request->is_pasangan_meninggal;
			}


			$reqDataDiri['createdBy'] = \Auth::user()->id;
			$reqDataDiri['uker_kode'] = $request->kantor_cabang;
			$reqDataDiri['jenis_kredit'] = $request->jenis_kredit;
			unset($reqDataDiri['kantor_cabang']);

			$data = CollectionFile::updateOrCreate(
				['no_ktp' => $request->no_ktp],
				$reqDataDiri
			);
			$data->dokumenUtama()->updateOrCreate(
				['collection_id' => $data->id],
				[
					'collection_id' => $data->id,
					'folder' => "collection/{$data->no_ktp}/kelengkapan_berkas"
				]
			);
			if ($request->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)') {
				$data->dokumenUtamaTambahan()->updateOrCreate(
					['collection_id' => $data->id],
					[
						'collection_id' => $data->id,
						'folder' => "collection/{$data->no_ktp}/kelengkapan_tambahan_form_subsidi"
					]
				);

				$currDataDiri = $data->dataDiri()->updateOrCreate(
					['collection_files_id' => $data->id],
					[
						'collection_files_id' => $data->id,
						'createdBy' => \Auth::user()->id
					]
				);

				$data->dataDiri->agunan()->updateOrCreate(
					['data_diri_id' => $currDataDiri->id],
					[
						'data_diri_id' => $currDataDiri->id,
						'createdBy' => \Auth::user()->id
					]
				);

				$data->dataDiri->analisaFinansial()->updateOrCreate(
					['data_diri_id' => $currDataDiri->id],
					[
						'data_diri_id' => $currDataDiri->id,
						'createdBy' => \Auth::user()->id
					]
				);

				$data->dataDiri->ujiFlpp()->updateOrCreate(
					['data_diri_id' => $currDataDiri->id],
					[
						'data_diri_id' => $currDataDiri->id,
						'nama_badan_hukum_developer' => $request->nama_developer,
						'nama_perumahan' => $request->nama_project,
						'createdBy' => \Auth::user()->id
					]
				);
			}
			$data = CollectionFile::with(['dokumenUtama', 'dokumenUtamaTambahan'])->findOrFail($data->id);

			$dev = Developer::updateOrCreate(
				['collection_id' => $data->id],
				['developer_name' => $request->nama_developer]
			);
			DeveloperProject::updateOrCreate(
				['developer_id' => $dev->id],
				[
					'project_name' => $request->nama_project,
					'folder' => "collection/{$data->no_ktp}/developer_files"
				]
			);

			DB::commit();
		}catch (Exception $e) {
			DB::rollback();
			return response()->json([
				'status'    => "fail",
				'messages'  => "Ada kesalahan",
			],422);
		}
		return response()->json([
			'status'    => "ok",
			'messages'  => "Berhasil membuat mapping name",
			'file'      =>  $data
		], 200);
	}

	public static function kelengkapanBerkas($request){
		// return $request->all();
		$validator = Validator::make($request->only(['collection_id']), [
			'collection_id' => 'required'
		]);
		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}
		DB::beginTransaction();
		try {
			$selCollection = CollectionFile::findOrFail($request->collection_id);
			$selCollection = CollectionFile::with('dokumenUtama.dokumenUtamaLainnya')->findOrFail($request->collection_id);
			if ($selCollection->status_id == 2 && $request->sanggah_tolak) {
			    $validator = Validator::make($request->all(), [
					'sanggah_tolak'	   => 'max:255'
				]);

				if($validator->fails()) {
					return response()->json([
						'status'    => "fail",
						'messages'  => 'Sanggah perbaikan maksimal 255 karakter.',
					],422);
				}
				
				$selCollection->update([
					'sanggah_tolak' => $request->sanggah_tolak,
					'status_id'		=> 3
				]);
				\Helper::storeStatusHistory($selCollection->id, 3);
			}
			if ($selCollection->status_id == 6 && $request->sanggah_tolak_verifikasi) {
				$selCollection->update([
					'sanggah_tolak_verifikasi' => $request->sanggah_tolak_verifikasi,
					'status_id'		=> 7
				]);
				\Helper::storeStatusHistory($selCollection->id, 7);
			}
			$folder = "collection/{$selCollection->no_ktp}/kelengkapan_berkas";
			$reqKelengkapanBerkas['collection_id'] = $request->collection_id;
			$reqKelengkapanBerkas['folder']    = $folder;
			$reqKelengkapanBerkas['ktp_pengajuan'] = \Helper::storeBase64File($folder, $request->ktp_pengajuan, 'ktp_pengajuan', $selCollection->dokumenUtama->ktp_pengajuan) ?: $selCollection->dokumenUtama->ktp_pengajuan;
			$reqKelengkapanBerkas['ktp_pasangan'] = \Helper::storeBase64File($folder, $request->ktp_pasangan, 'ktp_pasangan', $selCollection->dokumenUtama->ktp_pasangan) ?: $selCollection->dokumenUtama->ktp_pasangan;
			$reqKelengkapanBerkas['surat_cerai'] = \Helper::storeBase64File($folder, $request->surat_cerai, 'surat_cerai', $selCollection->dokumenUtama->surat_cerai) ?: $selCollection->dokumenUtama->surat_cerai;
			$reqKelengkapanBerkas['npwp'] = \Helper::storeBase64File($folder, $request->npwp, 'npwp', $selCollection->dokumenUtama->npwp) ?: $selCollection->dokumenUtama->npwp;
			$reqKelengkapanBerkas['kartu_keluarga'] = \Helper::storeBase64File($folder, $request->kartu_keluarga, 'kartu_keluarga', $selCollection->dokumenUtama->kartu_keluarga) ?: $selCollection->dokumenUtama->kartu_keluarga;
			$reqKelengkapanBerkas['akta_nikah'] = \Helper::storeBase64File($folder, $request->akta_nikah, 'akta_nikah', $selCollection->dokumenUtama->akta_nikah) ?: $selCollection->dokumenUtama->akta_nikah;
			$reqKelengkapanBerkas['keterangan_belum_nikah'] = \Helper::storeBase64File($folder, $request->keterangan_belum_nikah, 'keterangan_belum_nikah', $selCollection->dokumenUtama->keterangan_belum_nikah) ?: $selCollection->dokumenUtama->keterangan_belum_nikah;
			$reqKelengkapanBerkas['form_permohonan_kpr'] = \Helper::storeBase64File($folder, $request->form_permohonan_kpr, 'form_permohonan_kpr', $selCollection->dokumenUtama->form_permohonan_kpr) ?: $selCollection->dokumenUtama->form_permohonan_kpr;
			$reqKelengkapanBerkas['copy_sk_pegawai_tetap'] = \Helper::storeBase64File($folder, $request->copy_sk_pegawai_tetap, 'copy_sk_pegawai_tetap', $selCollection->dokumenUtama->copy_sk_pegawai_tetap) ?: $selCollection->dokumenUtama->copy_sk_pegawai_tetap;
			$reqKelengkapanBerkas['asli_sk_aktif_bekerja'] = \Helper::storeBase64File($folder, $request->asli_sk_aktif_bekerja, 'asli_sk_aktif_bekerja', $selCollection->dokumenUtama->asli_sk_aktif_bekerja) ?: $selCollection->dokumenUtama->asli_sk_aktif_bekerja;
			$reqKelengkapanBerkas['asli_slip_gaji'] = \Helper::storeBase64File($folder, $request->asli_slip_gaji, 'asli_slip_gaji', $selCollection->dokumenUtama->asli_slip_gaji) ?: $selCollection->dokumenUtama->asli_slip_gaji;
			$reqKelengkapanBerkas['asli_rekening_koran'] = \Helper::storeBase64File($folder, $request->asli_rekening_koran, 'asli_rekening_koran', $selCollection->dokumenUtama->asli_rekening_koran) ?: $selCollection->dokumenUtama->asli_rekening_koran;
			$reqKelengkapanBerkas['spr_dari_developer'] = \Helper::storeBase64File($folder, $request->spr_dari_developer, 'spr_dari_developer', $selCollection->dokumenUtama->spr_dari_developer) ?: $selCollection->dokumenUtama->spr_dari_developer;
			$reqKelengkapanBerkas['surat_keterangan_usaha'] = \Helper::storeBase64File($folder, $request->surat_keterangan_usaha, 'surat_keterangan_usaha', $selCollection->dokumenUtama->surat_keterangan_usaha) ?: $selCollection->dokumenUtama->surat_keterangan_usaha;
			$reqKelengkapanBerkas['tabungan_3bulan_terakhir'] = \Helper::storeBase64File($folder, $request->tabungan_3bulan_terakhir, 'tabungan_3bulan_terakhir', $selCollection->dokumenUtama->tabungan_3bulan_terakhir) ?: $selCollection->dokumenUtama->tabungan_3bulan_terakhir;
			$reqKelengkapanBerkas['spt_pajak_penghasilan'] = \Helper::storeBase64File($folder, $request->spt_pajak_penghasilan, 'spt_pajak_penghasilan', $selCollection->dokumenUtama->spt_pajak_penghasilan) ?: $selCollection->dokumenUtama->spt_pajak_penghasilan;
			$reqKelengkapanBerkas['surat_pernyataan_pengajuan_fasilitas_tapera'] = \Helper::storeBase64File($folder, $request->surat_pernyataan_pengajuan_fasilitas_tapera, 'surat_pernyataan_pengajuan_fasilitas_tapera', $selCollection->dokumenUtama->surat_pernyataan_pengajuan_fasilitas_tapera) ?: $selCollection->dokumenUtama->surat_pernyataan_pengajuan_fasilitas_tapera;
			$reqKelengkapanBerkas['surat_pernyataan_kesanggupan_potonggaji'] = \Helper::storeBase64File($folder, $request->surat_pernyataan_kesanggupan_potonggaji, 'surat_pernyataan_kesanggupan_potonggaji', $selCollection->dokumenUtama->surat_pernyataan_kesanggupan_potonggaji) ?: $selCollection->dokumenUtama->surat_pernyataan_kesanggupan_potonggaji;
			$reqKelengkapanBerkas['surat_pernyataan_kepemilikan_rumah'] = \Helper::storeBase64File($folder, $request->surat_pernyataan_kepemilikan_rumah, 'surat_pernyataan_kepemilikan_rumah', $selCollection->dokumenUtama->surat_pernyataan_kepemilikan_rumah) ?: $selCollection->dokumenUtama->surat_pernyataan_kepemilikan_rumah;
			$reqKelengkapanBerkas['surat_pernyataan_tidak_menerima_rumah_subsidi'] = \Helper::storeBase64File($folder, $request->surat_pernyataan_tidak_menerima_rumah_subsidi, 'surat_pernyataan_tidak_menerima_rumah_subsidi', $selCollection->dokumenUtama->surat_pernyataan_tidak_menerima_rumah_subsidi) ?: $selCollection->dokumenUtama->surat_pernyataan_tidak_menerima_rumah_subsidi;
			$reqKelengkapanBerkas['surat_pernyataan_pemohon_dana_bp2bt'] = \Helper::storeBase64File($folder, $request->surat_pernyataan_pemohon_dana_bp2bt, 'surat_pernyataan_pemohon_dana_bp2bt', $selCollection->dokumenUtama->surat_pernyataan_pemohon_dana_bp2bt) ?: $selCollection->dokumenUtama->surat_pernyataan_pemohon_dana_bp2bt;
			$reqKelengkapanBerkas['dokumen_struktur_beton_rumah'] = \Helper::storeBase64File($folder, $request->dokumen_struktur_beton_rumah, 'dokumen_struktur_beton_rumah', $selCollection->dokumenUtama->dokumen_struktur_beton_rumah) ?: $selCollection->dokumenUtama->dokumen_struktur_beton_rumah;
			$reqKelengkapanBerkas['surat_pernyataan_kelayakan_fungsi_bangunan_rumah'] = \Helper::storeBase64File($folder, $request->surat_pernyataan_kelayakan_fungsi_bangunan_rumah, 'surat_pernyataan_kelayakan_fungsi_bangunan_rumah', $selCollection->dokumenUtama->surat_pernyataan_kelayakan_fungsi_bangunan_rumah) ?: $selCollection->dokumenUtama->surat_pernyataan_kelayakan_fungsi_bangunan_rumah;
			$reqKelengkapanBerkas['memiliki_lahan'] = \Helper::storeBase64File($folder, $request->memiliki_lahan, 'memiliki_lahan', $selCollection->dokumenUtama->memiliki_lahan) ?: $selCollection->dokumenUtama->memiliki_lahan;
			$reqKelengkapanBerkas['pas_foto'] = \Helper::storeBase64File($folder, $request->pas_foto, 'pas_foto', $selCollection->dokumenUtama->pas_foto) ?: $selCollection->dokumenUtama->pas_foto;
			$reqKelengkapanBerkas['surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu'] = \Helper::storeBase64File($folder, $request->surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu, 'surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu', $selCollection->dokumenUtama->surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu) ?: $selCollection->dokumenUtama->surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu;
			$reqKelengkapanBerkas['foto_fisik_bangunan_psu'] = \Helper::storeBase64File($folder, $request->foto_fisik_bangunan_psu, 'foto_fisik_bangunan_psu', $selCollection->dokumenUtama->foto_fisik_bangunan_psu) ?: $selCollection->dokumenUtama->foto_fisik_bangunan_psu;
			$reqKelengkapanBerkas['foto_rumah_kondisi_awal'] = \Helper::storeBase64File($folder, $request->foto_rumah_kondisi_awal, 'foto_rumah_kondisi_awal', $selCollection->dokumenUtama->foto_rumah_kondisi_awal) ?: $selCollection->dokumenUtama->foto_rumah_kondisi_awal;
			$reqKelengkapanBerkas['rab_pembangunan_rumah_dan_renovasi_rumah'] = \Helper::storeBase64File($folder, $request->rab_pembangunan_rumah_dan_renovasi_rumah, 'rab_pembangunan_rumah_dan_renovasi_rumah', $selCollection->dokumenUtama->rab_pembangunan_rumah_dan_renovasi_rumah) ?: $selCollection->dokumenUtama->rab_pembangunan_rumah_dan_renovasi_rumah;
			$reqKelengkapanBerkas['surat_izin_profesi'] = \Helper::storeBase64File($folder, $request->surat_izin_profesi, 'surat_izin_profesi', $selCollection->dokumenUtama->surat_izin_profesi) ?: $selCollection->dokumenUtama->surat_izin_profesi;
			$reqKelengkapanBerkas['izin_usaha'] = \Helper::storeBase64File($folder, $request->izin_usaha, 'izin_usaha', $selCollection->dokumenUtama->izin_usaha) ?: $selCollection->dokumenUtama->izin_usaha;
			$reqKelengkapanBerkas['akta_pendirian_perusahaan'] = \Helper::storeBase64File($folder, $request->akta_pendirian_perusahaan, 'akta_pendirian_perusahaan', $selCollection->dokumenUtama->akta_pendirian_perusahaan) ?: $selCollection->dokumenUtama->akta_pendirian_perusahaan;
			$reqKelengkapanBerkas['dokumen_pengajuan_sikasep'] = \Helper::storeBase64File($folder, $request->dokumen_pengajuan_sikasep, 'dokumen_pengajuan_sikasep', $selCollection->dokumenUtama->dokumen_pengajuan_sikasep) ?: $selCollection->dokumenUtama->dokumen_pengajuan_sikasep;
			$reqKelengkapanBerkas['surat_kematian_pasangan'] = \Helper::storeBase64File($folder, $request->surat_kematian_pasangan, 'surat_kematian_pasangan', $selCollection->dokumenUtama->surat_kematian_pasangan) ?: $selCollection->dokumenUtama->surat_kematian_pasangan;

			$data = DokumenUtama::updateOrCreate(
				['collection_id' => $request->collection_id],
				$reqKelengkapanBerkas
			);

			if ($request->dokumen) {
				if ($selCollection->dokumenUtama->dokumenUtamaLainnya()->exists()) {
					foreach($selCollection->dokumenUtama->dokumenUtamaLainnya as $fileLain){
						\Helper::deleteFile("{$folder}/berkas_lainnya", $fileLain->files->name);
						File::findOrFail($fileLain->file_id)->delete();
					}
					DokumenLainnya::where('dokumen_utama_id', $selCollection->dokumenUtama->id)->delete();
				}
				$validator = Validator::make($request->only(['nama_dokumen']), [
					'nama_dokumen.*' => 'required'
				]);
				if($validator->fails()) {
					return response()->json([
						'status'    => "fail",
						'messages'  => 'Nama dokumen wajib diisi',
					],422);
				}
				for ($i = 0; $i < count($request->dokumen); $i++) {
					$file[] = [
						'id'  => \Str::uuid(),
						'name' => \Helper::storeFile($folder.'/berkas_lainnya', $request->dokumen[$i], $request->nama_dokumen[$i]),
						'folder' => $folder.'/berkas_lainnya',
						'created_by' => \Auth::user()->id
					];
					$dokLainnya[] = [
						'dokumen_utama_id' => $data->id,
						'file_id' => $file[$i]['id'],
						'nama_file' => $request->nama_dokumen[$i]
					];
				}
				File::insert($file);
				DokumenLainnya::insert($dokLainnya);
			}
			$data = DokumenUtama::with('dokumenUtamaLainnya.files')->findOrFail($data->id);

			DB::commit();
		}catch (Exception $e) {
			DB::rollback();
			return response()->json([
				'status'    => "fail",
				'messages'  => "Ada kesalahan",
			],422);
		}

		return response()->json([
			'status'    => "ok",
			'messages'  => "Berhasil menambah data",
			'file'      =>  $data
		], 200);
	}

	public static function tambahanKelengkapanBerkas($request){

		$validator = Validator::make($request->only(['collection_id']), [
			'collection_id' => 'required'
		]);
		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}
		DB::beginTransaction();
		try {
			$selCollection = CollectionFile::with('dokumenUtamaTambahan.dokumenTambahanLainnya')->findOrFail($request->collection_id);
			if ($selCollection->status_id == 2 && $request->sanggah_tolak) {
				$selCollection->update([
					'sanggah_tolak' => $request->sanggah_tolak,
					'status_id'		=> 3
				]);
				\Helper::storeStatusHistory($selCollection->id, 3);
			}
			$folder = "collection/{$selCollection->no_ktp}/kelengkapan_tambahan_form_subsidi";
			$reqTambahan['collection_id'] = $request->collection_id;
			$reqTambahan['folder']    = $folder;
			$reqTambahan['surat_pernyataan_belum_memiliki_rumah'] = \Helper::storeFile($folder, $request->surat_pernyataan_belum_memiliki_rumah, 'surat_pernyataan_belum_memiliki_rumah', $selCollection->dokumenUtamaTambahan->surat_pernyataan_belum_memiliki_rumah) ?: $selCollection->dokumenUtamaTambahan->surat_pernyataan_belum_memiliki_rumah;
			$reqTambahan['surat_pernyataan_pemohon'] = \Helper::storeFile($folder, $request->surat_pernyataan_pemohon, 'surat_pernyataan_pemohon', $selCollection->dokumenUtamaTambahan->surat_pernyataan_pemohon) ?: $selCollection->dokumenUtamaTambahan->surat_pernyataan_pemohon;
			$reqTambahan['surat_status_kepemilikan_rumah'] = \Helper::storeFile($folder, $request->surat_status_kepemilikan_rumah, 'surat_status_kepemilikan_rumah', $selCollection->dokumenUtamaTambahan->surat_status_kepemilikan_rumah) ?: $selCollection->dokumenUtamaTambahan->surat_status_kepemilikan_rumah;
			$reqTambahan['surat_pernyataan_penghasilan'] = \Helper::storeFile($folder, $request->surat_pernyataan_penghasilan, 'surat_pernyataan_penghasilan', $selCollection->dokumenUtamaTambahan->surat_pernyataan_penghasilan) ?: $selCollection->dokumenUtamaTambahan->surat_pernyataan_penghasilan;
			$reqTambahan['surat_pernyataan_verifikasi'] = \Helper::storeFile($folder, $request->surat_pernyataan_verifikasi, 'surat_pernyataan_verifikasi', $selCollection->dokumenUtamaTambahan->surat_pernyataan_verifikasi) ?: $selCollection->dokumenUtamaTambahan->surat_pernyataan_verifikasi;
			$data = DokumenTambahan::updateOrCreate(
				['collection_id' => $request->collection_id],
				$reqTambahan
			);

			if ($request->dokumen) {
				if ($selCollection->dokumenUtamaTambahan && $selCollection->dokumenUtamaTambahan->dokumenTambahanLainnya) {
					foreach($selCollection->dokumenUtamaTambahan->dokumenTambahanLainnya as $fileLain){
						\Helper::deleteFile("{$folder}/berkas_lainnya", $fileLain->files->name);
						File::findOrFail($fileLain->file_id)->delete();
					}
					DokumenTambahanLainnya::where('dokumen_tambahan_id', $selCollection->dokumenUtamaTambahan->id)->delete();
				}
				for ($i = 0; $i < count($request->dokumen); $i++) {
					$file[] = [
						'id'  => \Str::uuid(),
						'name' => \Helper::storeFile($folder.'/berkas_lainnya', $request->dokumen[$i], $request->nama_dokumen[$i]),
						'folder' => $folder.'/berkas_lainnya',
						'created_by' => \Auth::user()->id
					];
					$tambahanLainnya[] = [
						'dokumen_tambahan_id' => $data->id,
						'file_id' => $file[$i]['id'],
						'nama_file' => $request->nama_dokumen[$i]
					];
				}
				File::insert($file);
				DokumenTambahanLainnya::insert($tambahanLainnya);
			}
			$data = DokumenTambahan::with('dokumenTambahanLainnya.files')->findOrFail($data->id);

			DB::commit();
		}catch (Exception $e) {
			DB::rollback();
			return response()->json([
				'status'    => "fail",
				'messages'  => "Ada kesalahan",
			],422);
		}

		return response()->json([
			'status'    => "ok",
			'messages'  => "Berhasil menambah data",
			'file'      =>  $data
		], 200);
	}

	public static function developerFile($request){

		$validator = Validator::make($request->all(), [
			'collection_id'	   => 'required'
		]);

		if($validator->fails()) {
			return response()->json([
				'status'    => "fail",
				'messages'  => $validator->errors()->first(),
			],422);
		}

		DB::beginTransaction();
		try {
			$selCollection = CollectionFile::findOrFail($request->collection_id);
			if ($selCollection->status_id == 2) {
				$validator = Validator::make($request->only('sanggah_tolak'), [
					'sanggah_tolak'	   => 'required'
				]);

				if($validator->fails()) {
					return response()->json([
						'status'    => "fail",
						'messages'  => 'Sanggah perbaikan wajib diisi.'
					],422);
				}
				
				$validator = Validator::make($request->all(), [
					'sanggah_tolak'	   => 'max:255'
				]);

				if($validator->fails()) {
					return response()->json([
						'status'    => "fail",
						'messages'  => 'Sanggah perbaikan maksimal 255 karakter.',
					],422);
				}
			}
			if ($selCollection->status_id == 2 && $request->sanggah_tolak) {
				$selCollection->update([
					'sanggah_tolak' => $request->sanggah_tolak,
					'status_id'		=> 3
				]);
				\Helper::storeStatusHistory($selCollection->id, 3);
			}
			if ($selCollection->status_id == 6) {
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
			if ($selCollection->status_id == 6 && $request->sanggah_tolak_verifikasi) {
				$selCollection->update([
					'sanggah_tolak_verifikasi' => $request->sanggah_tolak_verifikasi,
					'status_id'		=> 7
				]);
				\Helper::storeStatusHistory($selCollection->id, 7);
			}
			if ($selCollection->status_id == 12) {
				$selCollection->update([
					'status_id'		=> 1
				]);
				\Helper::storeStatusHistory($selCollection->id, 1);
			}
			if ($selCollection->status_id == 1 && $request->aplikasi_terkirim){
				\Helper::storeStatusHistory($selCollection->id, 1);
				$selCollection->update([
					'is_pengajuan' => true
				]);	
			}			
			$folder = "collection/{$selCollection->no_ktp}/developer_files";
			$dev = Developer::where('collection_id', $request->collection_id)->with('project')->first();
			$project = DeveloperProject::where('developer_id', $dev->id)->first();

			if ($selCollection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)') {
				$selCollection->dataDiri()->updateOrCreate(
					['collection_files_id' => $selCollection->id],
					[
						'collection_files_id' => $selCollection->id,
						'createdBy' => \Auth::user()->id
					]
				);

				$selCollection->dataDiri->ujiFlpp()->updateOrCreate(
					['data_diri_id' => $selCollection->dataDiri->id],
					[
						'data_diri_id' => $selCollection->dataDiri->id,
						'id_rumah' => $request->id_rumah,
						'no_slf' => $request->no_slf,
						'tanggal_slf' => $request->tanggal_slf,
						'createdBy' => \Auth::user()->id
					]
				);
			}
			$reqDevProject['folder']	= $folder;
			$reqDevProject['files_imb'] = \Helper::storeFile($folder, $request->files_imb, 'files_imb', $project->files_imb) ?: $project->files_imb;
			$reqDevProject['files_pbb'] = \Helper::storeFile($folder, $request->files_pbb, 'files_pbb', $project->files_pbb) ?: $project->files_pbb;
			$reqDevProject['files_sertifikat'] = \Helper::storeFile($folder, $request->files_sertifikat, 'files_sertifikat', $project->files_sertifikat) ?: $project->files_sertifikat;
			$reqDevProject['files_slf'] = \Helper::storeFile($folder, $request->files_slf, 'files_slf', $project->files_slf) ?: $project->files_slf;
			$dev = DeveloperProject::updateOrCreate(
				['developer_id' => $dev->id],
				$reqDevProject
			);
			if ($project->filesLainnya()->exists()) {
				foreach($project->filesLainnya as $fileLain){
					\Helper::deleteFile("{$folder}/berkas_lainnya", $fileLain->name);
				}
			}

			if (isset($request->dokumen)) {
				DeveloperProjectFiles::where('developer_project_id', $project->id)->delete();
				foreach ($request->file('dokumen') as $key => $file) {
					$filename = \Helper::storeFile($folder.'/berkas_lainnya', $file, $request->nama_dokumen[$key]);
					$reqFiles['developer_project_id'] =  $project->id;
					$reqFiles['name'] = $filename;
					$reqFiles['nama_dokumen'] = $request->nama_dokumen[$key];
					$reqFiles['path'] =  $folder.'/berkas_lainnya';
					$reqFiles['created_by'] =  \Auth::user()->id;
					DeveloperProjectFiles::create($reqFiles);
				}
			}
			$dev = DeveloperProject::where('developer_id', $dev->developer_id)->with('filesLainnya')->first();
			DB::commit();

			return response()->json([
				'status'       => "ok",
				'messages'     => "Berhasil menambahkan project",
				'data'         =>  $dev
			], 200);
		} catch (Exception $e) {
			DB::rollback();
			return response()->json([
				'status'    => "fail",
				'messages'  => "Ada kesalahan dalam input data",
			],422);
		}
	}
}
