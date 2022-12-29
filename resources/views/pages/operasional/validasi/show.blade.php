@extends('layouts.app')
@section('operasional.validasi', 'active')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h3>Verifikasi Collection</h3>
        </div>
    </div>
    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area my-4">
                    <ul class="nav nav-tabs" id="border-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#tab-dokumenutama" role="tab"
                                aria-selected="true">Dokumen Utama</a>
                        </li>
                        @if ($collection->dokumenUtama->dokumenUtamaLainnya()->exists())
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#tab-dokumenutamalainnya" role="tab"
                                    aria-selected="false">Tambahan Dokumen Utama</a>
                            </li>
                        @endif
                        @if ($collection->dokumenUtamaTambahan()->exists())
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#tab-tambahanformsubsidi" role="tab"
                                    aria-selected="false">Dokumen Tambahan Form Subsidi</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#tab-dokumendeveloper" role="tab"
                                aria-selected="false">Dokumen Legalitas Agunan</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-1 mx-2" id="border-tabsContent">
                        <div class="tab-pane fade show active" id="tab-dokumenutama" role="tabpanel">
                            <div>
                                <table class="table table-hover table-bordered"
                                    style="display: block;overflow-x: auto;white-space: nowrap;min-height: 180px">
                                    <thead>
                                        <tr>
                                            <th>Form Permohonan KPR</th>
                                            <th>SPR dari Developer</th>
                                            @if($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                                            <th>Screenshoot Pengajuan di Sikasep</th>
                                            @endif
                                            <th>Kartu Keluarga</th>
                                            <th>KTP Pengajuan</th>
                                            @if ($collection->status_pernikahan == 'Menikah')
                                                <th>KTP Pasangan</th>
                                                <th>Akta Nikah</th>

                                                @if($collection->is_pasangan_meninggal == 1)
                                                <th>Surat Kematian Pasangan</th>
                                                @endif

                                            @elseif($collection->status_pernikahan == 'Belum Menikah')
                                                <th>Keterangan Belum Menikah</th>
                                            @else
                                                <th>Akta Cerai</th>
                                            @endif
                                            <th>NPWP</th>
                                            @if ($collection->jenis_pekerjaan == 'Pegawai' || is_null($collection->jenis_pekerjaan))
                                                <th>SK Pengangkatan Pegawai Tetap</th>
                                                <th>SK Aktif Bekerja</th>
                                                <th>Slip Gaji Periode 3 Bulan Terakhir</th>
                                            @endif

                                            @if ($collection->jenis_pekerjaan == 'Profesional')
                                                <th>Surat Izin Profesi</th>
                                            @endif
                                            @if ($collection->jenis_pekerjaan == 'Wiraswasta')
                                                <th>Izin Usaha (SIUP,TDP,SITU,dll)</th>
                                                <th>Akta Pendirian Perusahaan(minimal telah berjalan 3 tahun)</th>
                                            @endif
                                            <th>Rekening Koran</th>
                                            <th>SPT Pajak Tahun Terakhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @include('partials.td-edit-flpp', [
                                                'fix' => 'form_permohonan_kpr',
                                            ])
                                            @include('partials.td-edit-flpp', [
                                                'fix' => 'spr_dari_developer',
                                            ])
                                            @if($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                                            @include('partials.td-edit-flpp', ['fix' => 'dokumen_pengajuan_sikasep'])
                                            @endif
                                            @include('partials.td-edit-flpp', [
                                                'fix' => 'kartu_keluarga',
                                            ])
                                            @include('partials.td-edit-flpp', [
                                                'fix' => 'ktp_pengajuan',
                                            ])

                                            @if ($collection->status_pernikahan == 'Menikah')
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'ktp_pasangan',
                                                ])
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'akta_nikah',
                                                ])

                                                @if($collection->is_pasangan_meninggal == 1)
                                                @include('partials.td-edit-flpp', ['fix' => 'surat_kematian_pasangan'])
                                                @endif

                                            @elseif($collection->status_pernikahan == 'Belum Menikah')
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'keterangan_belum_nikah',
                                                ])
                                            @else
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'surat_cerai',
                                                ])
                                            @endif

                                            @include('partials.td-edit-flpp', [
                                                'fix' => 'npwp',
                                            ])

                                            @if ($collection->jenis_pekerjaan == 'Pegawai' || is_null($collection->jenis_pekerjaan))
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'copy_sk_pegawai_tetap',
                                                ])
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'asli_sk_aktif_bekerja',
                                                ])
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'asli_slip_gaji',
                                                ])
                                            @endif

                                            @if ($collection->jenis_pekerjaan == 'Profesional')
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'surat_izin_profesi',
                                                ])
                                            @endif

                                            @if ($collection->jenis_pekerjaan == 'Wiraswasta')
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'izin_usaha',
                                                ])
                                                @include('partials.td-edit-flpp', [
                                                    'fix' => 'akta_pendirian_perusahaan',
                                                ])
                                            @endif

                                            @include('partials.td-edit-flpp', [
                                                'fix' => 'asli_rekening_koran',
                                            ])
                                            @include('partials.td-edit-flpp', [
                                                'fix' => 'spt_pajak_penghasilan',
                                            ])
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-dokumenutamalainnya" role="tabpanel">
                            <div>
                                <table class="table table-hover table-bordered"
                                    style="display: block;overflow-x: auto;white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            @foreach ($collection->dokumenUtama->dokumenUtamaLainnya as $lain)
                                                <th>{{ $lain->nama_file }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($collection->dokumenUtama->dokumenUtamaLainnya as $lain)
                                                <?php $ext = explode('.', $lain->files->name); ?>

                                                <td>
                                                    @if ($ext[1] == 'pdf')
                                                        <a href="{{ \Helper::showImage($lain->files->folder, $lain->files->name) }}"
                                                            style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                            target="_blank">Lihat Dokumen</a>
                                                    @else
                                                        <a href="{{ \Helper::showImage($lain->files->folder, $lain->files->name) }}"
                                                            target="_blank">
                                                            <img class="img-thumbnail"
                                                                src="{{ \Helper::showImage($lain->files->folder, $lain->files->name) }}"
                                                                alt="" style="max-width: 130px;height: 80px">
                                                        </a>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($collection->dokumenUtamaTambahan()->exists())
                            <div class="tab-pane fade" id="tab-tambahanformsubsidi" role="tabpanel">
                                <div>
                                    <table class="table table-hover table-bordered"
                                        style="display: block;overflow-x: auto;white-space: nowrap;">
                                        <thead>
                                            <tr>
                                                <th>Surat pernyataan pemohon</th>
                                                <th>Surat status kepemilikan rumah</th>
                                                <th>Surat pernyataan penghasilan</th>
                                                <th>Surat pernyataan verifikasi</th>
                                                <th>Surat pernyataan belum memiliki rumah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    @if ($collection->dokumenUtamaTambahan->surat_pernyataan_pemohon)
                                                        <a href="{{ \Helper::showImage($collection->dokumenUtamaTambahan->folder,$collection->dokumenUtamaTambahan->surat_pernyataan_pemohon) }}"
                                                            style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                            target="_blank">Lihat Dokumen</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($collection->dokumenUtamaTambahan->surat_status_kepemilikan_rumah)
                                                        <a href="{{ \Helper::showImage($collection->dokumenUtamaTambahan->folder,$collection->dokumenUtamaTambahan->surat_status_kepemilikan_rumah) }}"
                                                            style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                            target="_blank">Lihat Dokumen</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($collection->dokumenUtamaTambahan->surat_pernyataan_penghasilan)
                                                        <a href="{{ \Helper::showImage($collection->dokumenUtamaTambahan->folder,$collection->dokumenUtamaTambahan->surat_pernyataan_penghasilan) }}"
                                                            style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                            target="_blank">Lihat Dokumen</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($collection->dokumenUtamaTambahan->surat_pernyataan_verifikasi)
                                                        <a href="{{ \Helper::showImage($collection->dokumenUtamaTambahan->folder,$collection->dokumenUtamaTambahan->surat_pernyataan_verifikasi) }}"
                                                            style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                            target="_blank">Lihat Dokumen</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($collection->dokumenUtamaTambahan->surat_pernyataan_belum_memiliki_rumah)
                                                        <a href="{{ \Helper::showImage($collection->dokumenUtamaTambahan->folder,$collection->dokumenUtamaTambahan->surat_pernyataan_belum_memiliki_rumah) }}"
                                                            style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                            target="_blank">Lihat Dokumen</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-tambahanformsubsidilainnya" role="tabpanel">
                                <div>
                                    <table class="table table-hover table-bordered"
                                        style="display: block;overflow-x: auto;white-space: nowrap;">
                                        <thead>
                                            <tr>
                                                @foreach ($collection->dokumenUtamaTambahan->dokumenTambahanLainnya as $tambahan)
                                                    <th>{{ $tambahan->nama_file }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($collection->dokumenUtamaTambahan->dokumenTambahanLainnya as $tambahan)
                                                    <td>
                                                        <a href="{{ \Helper::showImage($tambahan->files->folder, $tambahan->files->name) }}"
                                                            style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                            target="_blank">Lihat Dokumen</a>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <div class="tab-pane fade" id="tab-dokumendeveloper" role="tabpanel">
                            <div>
                                <table class="table table-hover table-bordered"
                                    style="display: block;overflow-x: auto;white-space: nowrap;">
                                    <thead>
                                        <tr>
                                            <th>Files SLF</th>
                                            <th>Files IMB</th>
                                            <th>Files PBB</th>
                                            <th>Files Sertifikat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{ \Helper::showImage($collection->developer->project->folder, $collection->developer->project->files_slf) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ \Helper::showImage($collection->developer->project->folder, $collection->developer->project->files_imb) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ \Helper::showImage($collection->developer->project->folder, $collection->developer->project->files_pbb) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ \Helper::showImage($collection->developer->project->folder,$collection->developer->project->files_sertifikat) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <form action="{{ route('v_detail.update', $collection->id) }}" method="POST" id="form-verifikasi-collection">
                @csrf
                <input type="hidden" name="status">
                <div class="widget-content widget-content-area">
                    @if (($collection->status_id == 6 && $collection->alasan_tolak_verifikasi) || $collection->status_id == 7)
                        <div class="alert alert-danger">
                            <b>{{ $collection->alasan_tolak_verifikasi }}</b>
                        </div>
                    @endif
                    @if (($collection->status_id == 6 && $collection->sanggah_tolak_verifikasi) || $collection->status_id == 7)
                        <div class="alert alert-info">
                            <b>{{ $collection->sanggah_tolak_verifikasi }}</b>
                        </div>
                    @endif
                    <div class="my-4">
                        @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                            <div class="form-row">
                                <div class="col-md-6">
                                    <table class="table table-hover table-bordered table-sm" id="table-Datatable"
                                        style="width:100%;">
                                        <tbody>
                                            <tr style="background-color: #dfdede">
                                                <td colspan="2">
                                                    <h6>Data Diri</h6>
                                                </td>
                                            </tr>
                                            @foreach ($colDataDiri as $key => $value)
                                                <?php
                                                $fix = explode('-', $value);
                                                $fixx = $fix[1];
                                                ?>
                                                <tr id="tr-utama">
                                                    <td style="width: 30%">
                                                        @if ($fixx == 'kelurahan_id')
                                                            <span>Provinsi
                                                                <br> Kota
                                                                <br> Kecamatan
                                                                <br> Kelurahan
                                                                <br> Kode Pos
                                                            </span>
                                                        @else
                                                            {{ $fix[0] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($fixx == 'kelurahan_id')
                                                            <span>
                                                                {{ $collection->dataDiri->kelurahan->kecamatan->kota->provinsi->provinsi }}
                                                                <br>
                                                                {{ $collection->dataDiri->kelurahan->kecamatan->kota->kota }}
                                                                <br>
                                                                {{ $collection->dataDiri->kelurahan->kecamatan->kecamatan }}
                                                                <br> {{ $collection->dataDiri->kelurahan->kelurahan }}
                                                                <br>
                                                                {{ $collection->dataDiri->kelurahan->kodePos->kode_pos }}
                                                            </span>
                                                        @else
                                                            <span>
                                                                {{ $collection->dataDiri->$fixx }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>                                
                                    <div class="col-md-6">
                                        @if ($collection->dataDiri->pasangan()->exists())
                                        <table class="table table-hover table-bordered table-sm" id="table-Datatable"
                                            style="width:100%;">
                                            <tbody>
                                                <tr style="background-color: #dfdede">
                                                    <td colspan="2">
                                                        <h6>Data Pasangan</h6>
                                                    </td>
                                                </tr>
                                                @foreach ($colDataPasangan as $key => $value)
                                                    <?php
                                                    $fix = explode('-', $value);
                                                    $fixx = $fix[1];
                                                    ?>
                                                    <tr id="tr-utama">
                                                        <td style="width: 30%">{{ $fix[0] }}</td>
                                                        <td>
                                                            <span>{{ $collection->dataDiri->pasangan->$fixx }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr id="tr-utama">
                                                        <td style="width: 30%">Pasangan Meninggal dunia ? </td>
                                                        <td>
                                                            <span>{{ $collection->is_pasangan_meningga == 1 ? "Ya" : "Tidak" }}</span>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                        @endif
                                        <table class="table table-hover table-bordered table-sm" id="table-Datatable"
                                            style="width:100%;">
                                            <tbody>
                                                <tr style="background-color: #dfdede">
                                                    <td colspan="2">
                                                        <h6>Data Analisa Finansial</h6>
                                                    </td>
                                                </tr>
                                                @foreach ($colAnalisaFinansial as $key => $value)
                                                    <?php
                                                    $fix = explode('-', $value);
                                                    $fixx = $fix[1];
                                                    ?>
                                                    <tr id="tr-utama">
                                                        <td style="width: 30%">{{ $fix[0] }}</td>
                                                        <td>
                                                            <span>{{ $collection->dataDiri->analisaFinansial->$fixx }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>                                
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <table class="table table-hover table-bordered table-sm" id="table-Datatable"
                                        style="width:100%;">
                                        <tbody>
                                            <tr style="background-color: #dfdede">
                                                <td colspan="2">
                                                    <h6>Data Agunan</h6>
                                                </td>
                                            </tr>
                                            @foreach ($colAgunan as $key => $value)
                                                <?php
                                                $fix = explode('-', $value);
                                                $fixx = $fix[1];
                                                ?>
                                                <tr id="tr-utama">
                                                    <td style="width: 30%">
                                                        @if ($fixx == 'kelurahan_id')
                                                            <span>Provinsi
                                                                <br> Kota
                                                                <br> Kecamatan
                                                                <br> Kelurahan
                                                                <br> Kode Pos
                                                            </span>
                                                        @else
                                                            {{ $fix[0] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($fixx == 'kelurahan_id')
                                                            <span>
                                                                {{ $collection->dataDiri->agunan->kelurahan->kecamatan->kota->provinsi->provinsi }}
                                                                <br>
                                                                {{ $collection->dataDiri->agunan->kelurahan->kecamatan->kota->kota }}
                                                                <br>
                                                                {{ $collection->dataDiri->agunan->kelurahan->kecamatan->kecamatan }}
                                                                <br>
                                                                {{ $collection->dataDiri->agunan->kelurahan->kelurahan }}
                                                                <br>
                                                                {{ $collection->dataDiri->agunan->kelurahan->kodePos->kode_pos }}
                                                            </span>
                                                        @else
                                                            <span>
                                                                {{ $collection->dataDiri->agunan->$fixx }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if ($collection->dataDiri->ujiFlpp()->exists())
                                    <div class="col-md-6">
                                        <table class="table table-hover table-bordered table-sm" id="table-Datatable"
                                            style="width:100%;">
                                            <tbody>
                                                <tr style="background-color: #dfdede">
                                                    <td colspan="2">
                                                        <h6>Data Uji FLPP</h6>
                                                    </td>
                                                </tr>
                                                @foreach ($colFlpp as $key => $value)
                                                    <?php
                                                    $fix = explode('-', $value);
                                                    $fixx = $fix[1];
                                                    ?>
                                                    <tr id="tr-utama">
                                                        <td style="width: 30%">{{ $fix[0] }}</td>
                                                        <td>
                                                            <span>{{ $collection->dataDiri->ujiFlpp->$fixx }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-3">
                                <label for="inputEmail4">Alasan Tolak</label>
                                <textarea class="form-control" rows="3" name="alasan_tolak_verifikasi"
                                    placeholder="Masukkan alasan jika ingin menolak"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('operasional.validasi.index') }}" class="btn btn-warning mx-2 my-2">Kembali</a>
                <button type="submit" class="btn btn-success mx-2 my-2 float-right"
                    data-text="Apa anda yakin ingin verifikasi data ini ?">Verifikasi</button>
                <a class="btn btn-danger mx-2 my-2 float-right" data-text="Apa anda yakin ingin menolak data ini ?"
                    id="btnTolak">Tolak</a>
        </div>
        </form>
    </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/helper.js') }}"></script>
    <script>
        $(document).ready(function() {
            function sendData(is_terima = false) {
                if (is_terima) {
                    $('[name=status]').val('diterima')
                } else {
                    $('[name=status]').val('ditolak')
                    if ($('[name=alasan_tolak_verifikasi]').val() == "") {
                        toastr["error"]("Keterangan penolakan belum diisi.");
                        return
                    }
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name=_token]').val()
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name=_token]').val()
                    }
                });

                $.ajax({
                    type: 'post',
                    url: $('#form-verifikasi-collection').attr("action"),
                    data: $('#form-verifikasi-collection').serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        if (is_terima) {
                            loadButton($('#form-verifikasi-collection button[type=submit]'))
                            return
                        }

                        loadButton($('#form-verifikasi-collection #btnTolak'))
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.status == "ok") {
                            toastr["success"](data.messages);
                        }
                        setTimeout(() => {
                            window.location.href = "/operasional/validasi";
                        }, 1500)
                    },
                    error: function(data) {
                        console.log(data.responseText)
                        var data = data.responseJSON;
                        if (data.status == "fail") {
                            toastr["error"](data.messages);
                        }
                        if (is_terima) {
                            loadButton($('#form-verifikasi-collection button[type=submit]'), false,
                                'Verifikasi')
                            return
                        }

                        loadButton($('#form-verifikasi-collection #btnTolak'), false, 'Tolak')
                    },
                    complete: function() {
                        if (is_terima) {
                            loadButton($('#form-verifikasi-collection button[type=submit]'), false,
                                'Verifikasi')
                            return
                        }

                        loadButton($('#form-verifikasi-collection #btnTolak'), false, 'Tolak')
                    }
                });
            }

            $('#form-verifikasi-collection').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Anda yakin ingin Verifikasi data ini ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Verifikasi !'
                }).then((result) => {
                    if (result.value) {
                        sendData(true)
                    }
                })
            })

            $('#btnTolak').click(function() {
                if ($(this).attr('disabled') != undefined) {
                    return
                }
                Swal.fire({
                    title: 'Anda yakin ingin menolak Verifikasi data ini ?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tolak !'
                }).then((result) => {
                    if (result.value) {
                        sendData(false)
                    }
                })
            })
        })
    </script>
@endsection
