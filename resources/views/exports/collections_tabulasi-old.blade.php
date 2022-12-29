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
                <?php
                $arrTanggal = [];
                $status = '-';
                ?>
                @if(!$collection->historyStatus()->exists())
                <?php $status = $collection->status; ?>
                @endif

                @foreach ($collection->historyStatus as $h)
                    @if ($h->status_id == 11)
                        <?php
                        array_push($arrTanggal, $h->created_at);
                        ?>
                    @endif
                    @if ($h->status_id == 13)
                        <?php
                        array_push($arrTanggal, $h->created_at);
                        ?>
                    @endif
                    @if ($h->status_id == 17)
                        <?php
                        array_push($arrTanggal, $h->created_at);
                        ?>
                    @endif
                    @if ($h->status_id == 18)
                        <?php
                        array_push($arrTanggal, $h->created_at);
                        ?>
                    @endif
                    @if($h->status_id < 12)
                        <?php
                        $status = $h->status->nama;
                        ?>
                    @endif
                    @if ($h->status_id == 12)
                        <?php
                        $status = 'Perbaikan BRI';
                        ?>
                    @endif
                    @if ($h->status_id == 14)
                        <?php
                        $status = 'Putus Tolak BRI';
                        ?>
                    @endif
                    @if ($h->status_id == 15)
                        <?php
                        $status = 'Putus Terima BRI';
                        ?>
                    @endif
                    @if ($h->status_id == 16)
                        <?php
                        $status = 'Calon Debitur Membatalkan';
                        ?>
                    @endif
                    @if ($h->status_id == 18)
                        <?php
                        $status = 'Pencairan BRI';
                        ?>
                    @endif
                @endforeach
                <td>{{ $status }}</td>
                <td>{{ $collection->tgl_terkirim }}</td>
                <td>{{ count($arrTanggal) > 0 ? $arrTanggal[0] : '-' }}</td>
                <td>{{ count($arrTanggal) > 1 ? $arrTanggal[1] : '-' }}</td>
                <td>{{ count($arrTanggal) > 2 ? $arrTanggal[2] : '-' }}</td>
                <td>{{ count($arrTanggal) > 3 ? $arrTanggal[3] : '-' }}</td>
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
