<table>
    <thead>
        <tr>
            <th>Nama Debitur</th>
            <th>No HP Calon Debitur</th>
            <th>No KTP Calon Debitur</th>
            <th>No Rekening BRI</th>
            <th>Nama Developer</th>
            <th>No Hp Developer</th>
            <th>Nama Project</th>
            <th>Alamat Project</th>
            <th>Provinsi - Kantor Wilayah - Unit Kerja</th>
            <th>Jenis Kredit</th>
            <th>Jumlah Permohonan Kredit</th>
            <th>Status Pengajuan</th>
            <th>Dikirim ke BRI</th>
            <th>Diterima Uker BRI</th>
            <th>Analisa dan Verifikasi</th>
            <th>Akad Kredit</th>
            <th>Pencairan</th>
            <th>Nominal Plafond Kredit</th>
            <th>Norek Kredit</th>
            <th>Marketing PT CRI</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collections as $collection)
            <tr>
                <td>{{ $collection->nama_calon_debitur }}</td>
                <td>{{ $collection->no_telp_debitur }}</td>
                <td>{{ "'" . $collection->no_ktp }}</td>
                <td>{{ "'" . $collection->dataDiri && $collection->dataDiri()->exists()? "'" . $collection->dataDiri->no_rek_bri: '-' }}
                </td>
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
                <td>
                    @if($collection->jenis_kredit != 'KPR Subsidi FLPP (Fix Income)')
                    {{ \Helper::rupiahFormat($collection->jumlah_permohonan_kredit) }}
                    @else
                    @if($collection->dataDiri()->exists() && $collection->dataDiri->analisaFinansial()->exists())
                    {{\Helper::rupiahFormat($collection->dataDiri->analisaFinansial->jumlah_permohonan_kredit)}}
                    @else
                    -
                    @endif
                    @endif
                </td>
                <td>{{ $collection->collectionStatus->nama }}</td>
                <td>{{ $collection->tgl_terkirim ?? '-' }}</td>
                <td>{{ \Helper::getLastTimeHistory($collection->id, 11) }}</td>
                <td>{{ \Helper::getLastTimeHistory($collection->id, 13) }}</td>
                <td>{{ \Helper::getLastTimeHistory($collection->id, 17) }}</td>
                <td>{{ \Helper::getLastTimeHistory($collection->id, 18) }}</td>
                <td>
                    @if ($collection->nominal_cair)
                        {{ \Helper::rupiahFormat($collection->nominal_cair) }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    {{ $collection->norek_kredit ? $collection->norek_kredit : '-' }}
                </td>
                <td>{{ $collection->userCreated->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
