<table>
    <thead>
        <tr>
            <th>Nama Debitur</th>
            <th>No HP Calon Debitur</th>
            <th>No Kartu Keluarga</th>
            <th>No KTP Calon Debitur</th>
            <th>No Rekening BRI</th>
            <th>Nama Developer</th>
            <th>No Hp Developer</th>
            <th>Nama Project</th>
            <th>Alamat Project</th>
            <th>Provinsi - Kantor Wilayah - Unit Kerja</th>
            <th>Jenis Kredit</th>
            <th>Jumlah Permohonan Kredit</th>
            <th>Nominal Plafond Kredit</th>
            <th>Norek Kredit</th>
            <th>Marketing PT CRI</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $collection->nama_calon_debitur }}</td>
            <td>{{ $collection->dataDiri->no_hp }}</td>
            <td>{{ "'" . $collection->no_ktp }}</td>
            <td>{{ "'" . $collection->dataDiri->no_rek_bri }}</td>
            <td>{{ "'" . $collection->dataDiri->no_kk }}</td>
            <td>{{ $collection->nama_developer }}</td>
            <td>{{ $collection->no_telp_developer }}</td>
            <td>{{ $collection->nama_project }}</td>
            <td>{{ $collection->alamat_project }}</td>
            <td>
                @if ($collection->uker_kode == 1039)
                    DKI Jakarta - Kantor Cabang Khusus
                @else
                    {{ $collection->unitKerja->provinsi->provinsi .' - ' .$collection->unitKerja->kantorWilayah->kota .' - ' .$collection->unitKerja->nama }}
                @endif
            </td>
            <td>
                {{ $collection->jenis_kredit }}
            </td>
            <td>{{ \Helper::rupiahFormat($collection->dataDiri->analisaFinansial->jumlah_permohonan_kredit) }}</td>
            <td>{{ $collection->nominal_cair ? \Helper::rupiahFormat($collection->nominal_cair) : '-' }}</td>
            <td>{{ $collection->norek_kredit ? $collection->norek_kredit : '-' }}</td>
            <td>{{ $collection->userCreated->name }}</td>
        </tr>
    </tbody>
</table>

@if ($collection->dataDiri->pasangan()->exists())
    <h4>Data Diri dan Pasangan</h4>
@else
    <h4>Data Diri</h4>
@endif
<table>
    <tbody>
        <tr>
            <th>Status</th>
            <td>{{ $collection->status_pernikahan }}</td>

            @if ($collection->dataDiri->pasangan()->exists())
                <td></td>
                <td>Nama Pasangan</td>
                <td>{{ $collection->dataDiri->pasangan->nama_pasangan }}</td>
            @endif
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $collection->dataDiri->tanggal_lahir }}</td>
            @if ($collection->dataDiri->pasangan()->exists())
                <td></td>
                <td>No KTP Pasangan</td>
                <td>{{ "'" . $collection->dataDiri->pasangan->no_ktp_pasangan }}</td>
            @endif

        </tr>
        <tr>
            <th>Program Pemasaran</th>
            <td>{{ $collection->dataDiri->program_pemasaran }}</td>
            @if ($collection->dataDiri->pasangan()->exists())
                <td></td>
                <td>Tanggal Lahir Pasangan</td>
                <td>{{ $collection->dataDiri->pasangan->tgl_lahir_pasangan }}</td>
            @endif
        </tr>
        <tr>
            <th>Jenis Debitur</th>
            <td>{{ $collection->dataDiri->jenis_debitur }}</td>
            @if ($collection->dataDiri->pasangan()->exists())
                <td></td>
                <th>Pasangan meninggal dunia ?</th>
                <td>{{ $collection->is_pasangan_meninggal == 1 ? 'Ya' : 'Tidak' }}</td>
            @endif
        </tr>
        <tr>
            <th>Pendidikan Terakhir</th>
            <td>{{ $collection->dataDiri->pendidikan_terakhir }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $collection->dataDiri->jenis_kelamin == 'P' ? 'Perempuan' : 'Pria' }}</td>
        </tr>
        <tr>
            <th>Provinsi</th>
            <td>{{ $collection->dataDiri->kelurahan->kecamatan->kota->provinsi->provinsi }}</td>
        </tr>
        <tr>
            <th>Kota</th>
            <td>{{ $collection->dataDiri->kelurahan->kecamatan->kota->kota }}</td>
        </tr>
        <tr>
            <th>Kecamatan</th>
            <td>{{ $collection->dataDiri->kelurahan->kecamatan->kecamatan }}</td>
        </tr>
        <tr>
            <th>Kelurahan</th>
            <td>{{ $collection->dataDiri->kelurahan->kelurahan }}</td>
        </tr>
        <tr>
            <th>Kode Pos</th>
            <td>{{ $collection->dataDiri->kelurahan->kodePos->kode_pos }}</td>
        </tr>
        <tr>
            <th>Alamat Domisili</th>
            <td>{{ $collection->dataDiri->alamat_domisili }}</td>
        </tr>
        <tr>
            <th>Alamat Sesuai KTP</th>
            <td>{{ $collection->dataDiri->alamat_ktp }}</td>
        </tr>
        <tr>
            <th>Lama Menetap</th>
            <td>{{ $collection->dataDiri->lama_menetap }}</td>
        </tr>
        <tr>
            <th>Lama Bekerja</th>
            <td>{{ $collection->dataDiri->lama_berkerja }}</td>
        </tr>
        <tr>
            <th>No NPWP</th>
            <td>{{ $collection->dataDiri->no_npwp }}</td>
        </tr>
        <tr>
            <th>Nama Ibu Kandung</th>
            <td>{{ $collection->dataDiri->nama_gadis_ibu_kandung }}</td>
        </tr>
        <tr>
            <th>Tanggal Kadaluarsa KTP</th>
            <td>{{ $collection->dataDiri->tanggal_kadaluarsa_ktp }}</td>
        </tr>
        <tr>
            <th>No Telpon</th>
            <td>{{ $collection->dataDiri->no_telp }}</td>
        </tr>
        <tr>
            <th>No HP</th>
            <td>{{ $collection->dataDiri->no_hp }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $collection->dataDiri->email }}</td>
        </tr>
        <tr>
            <th>Kepemilikan Tempat Tinggal</th>
            <td>{{ $collection->dataDiri->kepemilikan_tempat_tinggal }}</td>
        </tr>
        <tr>
            <th>Status Kepegawaian</th>
            <td>{{ $collection->dataDiri->status_kepegawaian }}</td>
        </tr>
        <tr>
            <th>Jenis Pekerjaan</th>
            <td>{{ $collection->dataDiri->jenis_pekerjaan }}</td>
        </tr>
        <tr>
            <th>Nama Perusahaan</th>
            <td>{{ $collection->dataDiri->nama_perusahaan }}</td>
        </tr>
        <tr>
            <th>No SK Kenaikan Pangkat</th>
            <td>{{ $collection->dataDiri->no_sk_kenaikan_pangkat }}</td>
        </tr>
        <tr>
            <th>Usia Persiapan Pensiun</th>
            <td>{{ $collection->dataDiri->usia_masa_persiapan_pensiun }}</td>
        </tr>
        <tr>
            <th>Sumber Penghasilan</th>
            <td>{{ $collection->dataDiri->sumber_penghasilan }}</td>
        </tr>
        <tr>
            <th>Nama Keluarga Dekat</th>
            <td>{{ $collection->dataDiri->nama_keluarga_dekat }}</td>
        </tr>
        <tr>
            <th>No Telpon Keluarga Dekat</th>
            <td>{{ $collection->dataDiri->no_telp_keluarga_dekat }}</td>
        </tr>
        <tr>
            <th>Memiliki Simpanan BRI</th>
            <td>{{ $collection->dataDiri->memiliki_simpanan_bri }}</td>
        </tr>

    </tbody>
</table>

@if ($collection->dataDiri->analisaFinansial()->exists())
    <h4>Data Analisa Finansial</h4>
    <table>
        <tbody>
            <tr>
                <th>Pendapatan Bersih</th>
                <td>{{ \Helper::rupiahFormat($collection->dataDiri->analisaFinansial->pendapatan_bersih) }}</td>
            </tr>
            <tr>
                <th>Penghasilan pasangan</th>
                <td>
                    @if ($collection->status_pernikahan == 'Menikah')
                        {{ \Helper::rupiahFormat($collection->dataDiri->analisaFinansial->penghasilan_pasangan) }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Penghasilan lainnya</th>
                <td>{{ \Helper::rupiahFormat($collection->dataDiri->analisaFinansial->penghasilan_lainnya) }}</td>
            </tr>
            <tr>
                <th>Angsuran pinjaman lain</th>
                <td>{{ \Helper::rupiahFormat($collection->dataDiri->analisaFinansial->angsuran_pinjaman_lain) }}</td>
            </tr>
            <tr>
                <th>Jangka Waktu Kredit</th>
                <td>{{ $collection->dataDiri->analisaFinansial->jangka_waktu_kredit }}</td>
            </tr>
            <tr>
                <th>Harga Rumah</th>
                <td>{{ \Helper::rupiahFormat($collection->dataDiri->analisaFinansial->harga_rumah) }}</td>
            </tr>
            <tr>
                <th>Uang Muka</th>
                <td>{{ \Helper::rupiahFormat($collection->dataDiri->analisaFinansial->uang_muka) }}</td>
            </tr>
            <tr>
                <th>jumlah Permohonan Kredit</th>
                <td>{{ \Helper::rupiahFormat($collection->dataDiri->analisaFinansial->jumlah_permohonan_kredit) }}
                </td>
            </tr>
            <tr>
                <th>Pernah pinjam dibank lain ?</th>
                <td>{{ $collection->dataDiri->analisaFinansial->pernah_pinjam_di_bank_lain }}</td>
            </tr>
            <tr>
                <th>Jenis fasilitas dibank lain ?</th>
                <td>{{ $collection->dataDiri->analisaFinansial->jenis_fasilitas_di_bank_lain }}</td>
            </tr>

        </tbody>
    </table>
@endif

@if ($collection->dataDiri->agunan()->exists())
    <h4>Data Agunan</h4>
    <table>
        <tbody>
            <tr>
                <th>Lokasi Tanah</th>
                <td>{{ $collection->dataDiri->agunan->lokasi_tanah }}</td>
            </tr>
            <tr>
                <th>Provinsi</th>
                <td>{{ $collection->dataDiri->agunan->kelurahan->kecamatan->kota->provinsi->provinsi }}</td>
            </tr>
            <tr>
                <th>Kota</th>
                <td>{{ $collection->dataDiri->agunan->kelurahan->kecamatan->kota->kota }}</td>
            </tr>
            <tr>
                <th>Kecamatan</th>
                <td>{{ $collection->dataDiri->agunan->kelurahan->kecamatan->kecamatan }}</td>
            </tr>
            <tr>
                <th>Kelurahan</th>
                <td>{{ $collection->dataDiri->agunan->kelurahan->kelurahan }}</td>
            </tr>
            <tr>
                <th>Kode Pos</th>
                <td>{{ $collection->dataDiri->agunan->kelurahan->kodePos->kode_pos }}</td>
            </tr>
            <tr>
                <th>Jarak Agunan ke pusat kota (km)</th>
                <td>{{ $collection->dataDiri->agunan->jarak_agunan }}</td>
            </tr>
            <tr>
                <th>Batas Utara (kavling)</th>
                <td>{{ $collection->dataDiri->agunan->batas_utara_tanah }}</td>
            </tr>
            <tr>
                <th>Batas Timur (kavling)</th>
                <td>{{ $collection->dataDiri->agunan->batas_timur_tanah }}</td>
            </tr>
            <tr>
                <th>Batas Selatan (kavling)</th>
                <td>{{ $collection->dataDiri->agunan->batas_selatan_tanah }}</td>
            </tr>
            <tr>
                <th>Batas Barat (kavling)</th>
                <td>{{ $collection->dataDiri->agunan->batas_barat_tanah }}</td>
            </tr>
            <tr>
                <th>Bentuk Tanah</th>
                <td>{{ $collection->dataDiri->agunan->bentuk_tanah }}</td>
            </tr>
            <tr>
                <th>RW-RT</th>
                <td>{{ $collection->dataDiri->agunan->rw . '-' . $collection->dataDiri->agunan->rt }}</td>
            </tr>
            <tr>
                <th>Jarak Terhadap Jalan Perumahan(m)</th>
                <td>{{ $collection->dataDiri->agunan->jarak_terhadap_jalan }}</td>
            </tr>
            <tr>
                <th>Permukaan Tanah</th>
                <td>{{ $collection->dataDiri->agunan->permukaan_tanah }}</td>
            </tr>
            <tr>
                <th>Luas Tanah</th>
                <td>{{ $collection->dataDiri->agunan->luas_tanah }}</td>
            </tr>
            <tr>
                <th>No surat tanah</th>
                <td>{{ $collection->dataDiri->agunan->no_surat_tanah }}</td>
            </tr>
            <tr>
                <th>Tanggal Surat Tanah</th>
                <td>{{ $collection->dataDiri->agunan->tgl_surat_tanah }}</td>
            </tr>
            <tr>
                <th>Atas Nama</th>
                <td>{{ $collection->dataDiri->agunan->atas_nama_surat_tanah }}</td>
            </tr>
            <tr>
                <th>Jenis kepemilikan</th>
                <td>{{ $collection->dataDiri->agunan->jenis_kepemilikan }}</td>
            </tr>
            <tr>
                <th>Nama kantor bpn</th>
                <td>{{ $collection->dataDiri->agunan->nama_kantor_bpn }}</td>
            </tr>
            <tr>
                <th>No IMB</th>
                <td>{{ $collection->dataDiri->agunan->no_imb }}</td>
            </tr>
            <tr>
                <th>Tanggal IMB</th>
                <td>{{ $collection->dataDiri->agunan->tgl_imb }}</td>
            </tr>
            <tr>
                <th>Luas Bangunan</th>
                <td>{{ $collection->dataDiri->agunan->luas_bangunan }}</td>
            </tr>
            <tr>
                <th>Tahun Mendirikan Bangunan</th>
                <td>{{ $collection->dataDiri->agunan->tahun_mendirikan_bangunan }}</td>
            </tr>
        </tbody>
    </table>
@endif

@if ($collection->dataDiri->ujiFlpp()->exists())
    <h4>Data Uji FLPP</h4>
    <table>
        <tbody>
            <tr>
                <th>Jenis Badan Hukum Developer</th>
                <td>{{ $collection->dataDiri->ujiFlpp->jenis_badan_hukum_developer }}</td>
            </tr>
            <tr>
                <th>Nama Badan Hukum Developer</th>
                <td>{{ $collection->dataDiri->ujiFlpp->nama_badan_hukum_developer }}</td>
            </tr>
            <tr>
                <th>Nama Perumahan</th>
                <td>{{ $collection->dataDiri->ujiFlpp->nama_perumahan }}</td>
            </tr>
            <tr>
                <th>Kode Pos Agunan</th>
                <td>{{ $collection->dataDiri->ujiFlpp->kode_pos_agunan }}</td>
            </tr>
            <tr>
                <th>Subsidi Uang Muka</th>
                <td>{{ \Helper::rupiahFormat($collection->dataDiri->ujiFlpp->subsidi_uang_muka) }}</td>
            </tr>
            <tr>
                <th>NPWP Pengembang</th>
                <td>{{ $collection->dataDiri->ujiFlpp->npwp_pengembang }}</td>
            </tr>
            <tr>
                <th>Blok Alamat Agunan</th>
                <td>{{ $collection->dataDiri->ujiFlpp->blok_alamat_agunan }}</td>
            </tr>
            <tr>
                <th>No Alamat Agunan</th>
                <td>{{ $collection->dataDiri->ujiFlpp->no_alamat_agunan }}</td>
            </tr>
            <tr>
                <th>Id Rumah</th>
                <td>{{ "'" . $collection->dataDiri->ujiFlpp->id_rumah }}</td>
            </tr>
            <tr>
                <th>Id Struktur</th>
                <td>{{ $collection->dataDiri->ujiFlpp->id_struktur }}</td>
            </tr>
            <tr>
                <th>No slf</th>
                <td>{{ $collection->dataDiri->ujiFlpp->no_slf }}</td>
            </tr>
            <tr>
                <th>Tanggal SLF</th>
                <td>{{ $collection->dataDiri->ujiFlpp->tanggal_slf }}</td>
            </tr>
            <tr>
                <th>Nama Rek Penerima SBUM</th>
                <td>{{ "'" . $collection->dataDiri->ujiFlpp->nama_bank_penerima_sbum }}</td>
            </tr>
            <tr>
                <th>No Rek Penerima SBUM</th>
                <td>{{ "'" . $collection->dataDiri->ujiFlpp->no_rek_penerima_sbum }}</td>
            </tr>
            <tr>
                <th>No Rek Developer</th>
                <td>{{ "'" . $collection->dataDiri->ujiFlpp->no_rek_developer }}</td>
            </tr>
        </tbody>
    </table>
@endif
