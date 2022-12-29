@extends('layouts.app')
@section('operasional.collection', 'active')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/components/cards/card.css') }}">
<link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<div class="page-header">
    <div class="page-title">
        <h3>Input Collection Files</h3>
    </div>
</div>
<div class="row layout-top-spacing mt-0">
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
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-tambahanformsubsidi" role="tab"
                        aria-selected="false">Dokumen Tambahan Form Subsidi</a>
                    </li>
                    @if ($collection->dokumenUtamaTambahan->dokumenTambahanLainnya()->exists())
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-tambahanformsubsidilainnya"
                        role="tab" aria-selected="false">Tambahan Dokumen Tambahan Form Subsidi</a>
                    </li>
                    @endif
                    @if ($collection->developer->project()->exists())
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-dokumendeveloper" role="tab"
                        aria-selected="false">Dokumen Legalitas Agunan</a>
                    </li>
                    @endif
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
                                    <th>Screenshoot Pengajuan di Sikasep </th>
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
                                    <th>SK Pengangkatan Pegawai Tetap</th>
                                    <th>SK Aktif Bekerja</th>
                                    <th>Slip Gaji Periode 3 Bulan Terakhir</th>
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
                                    @include('partials.td-edit-flpp', [
                                    'fix' => 'copy_sk_pegawai_tetap',
                                    ])
                                    @include('partials.td-edit-flpp', [
                                    'fix' => 'asli_sk_aktif_bekerja',
                                    ])
                                    @include('partials.td-edit-flpp', [
                                    'fix' => 'asli_slip_gaji',
                                    ])
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
                <div class="statbox widget box box-shadow" style="margin-top: -20px;">
                    <div class="widget-content widget-content-area my-4"
                    style="display: block;overflow-y: auto;white-space: nowrap;">
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
                    @if ($collection->alasan_perbaikan_bri)
                    <div class="alert alert-warning">
                        <p>Alasan perbaikan BRI : </p>
                        <b>{{ $collection->alasan_perbaikan_bri }}</b>
                    </div>
                    @endif
                    @if ($collection->alasan_tolak_bri)
                    <div class="alert alert-danger">
                        <p>Alasan tolak BRI : </p>
                        <b>{{ $collection->alasan_tolak_bri }}</b>
                    </div>
                    @endif
                    <div style="height: 700px;margin-top: -10px;">
                        <ul class="nav nav-pills mb-1 nav-fill" id="justify-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#tab-datadiri" role="tab"
                                aria-selected="true">Data Diri</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $collection->dataDiri ? '' : 'disabled' }}" data-toggle="pill"
                                    href="#tab-analisa-finansial" role="tab" aria-selected="false">Analisa Finansial</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $collection->dataDiri ? '' : 'disabled' }}" data-toggle="pill"
                                        href="#tab-agunan" role="tab" aria-selected="false">Data Agunan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ $collection->dataDiri ? '' : 'disabled' }}" data-toggle="pill"
                                            href="#tab-flpp" role="tab" aria-selected="false">Uji FLPP</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent" style="overflow-y: scroll;height: 500px;">
                                        @include('partials.tabs-flpp')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endsection
                    <script src="{{ asset('assets/js/helper.js') }}"></script>
                    <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
                    <script src="{{ asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
                    @section('js')
                    <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
                    <script src="{{ asset('plugins/input-mask/input-mask.js') }}"></script>
                    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
                    <script>
                        $(document).ready(function() {
                            flatpickr('[name=tanggal_lahir]', {
                                dateFormat: "d-m-Y"
                            })
                            flatpickr('[name=tgl_lahir_pasangan]', {
                                dateFormat: "d-m-Y"
                            })
                            flatpickr('[name=tgl_surat_tanah]', {
                                dateFormat: "d-m-Y"
                            })
                            flatpickr('[name=tgl_imb]', {
                                dateFormat: "d-m-Y"
                            })

                            $('[name=no_npwp]').inputmask("99.999.999.9-999.999");
                            $('[name=npwp_pengembang]').inputmask("99.999.999.9-999.999");
                            $('[name=tahun_mendirikan_bangunan]').inputmask("9999");
                // $('[name=no_rek_penerima_sbum]').inputmask("999999999999999");
                // $('[name=no_rek_developer]').inputmask("999999999999999");
                @if ($collection->dataDiri && $collection->dataDiri->analisaFinansial)
                $('[name=pendapatan_bersih]').val(
                    formatRp('{{ $collection->dataDiri->analisaFinansial->pendapatan_bersih }}'))
                $('[name=penghasilan_pasangan]').val(
                    formatRp('{{ $collection->dataDiri->analisaFinansial->penghasilan_pasangan }}'))
                $('[name=penghasilan_lainnya]').val(
                    formatRp('{{ $collection->dataDiri->analisaFinansial->penghasilan_lainnya }}'))
                $('[name=angsuran_pinjaman_lain]').val(
                    formatRp('{{ $collection->dataDiri->analisaFinansial->angsuran_pinjaman_lain }}'))
                $('[name=harga_rumah]').val(
                    formatRp('{{ $collection->dataDiri->analisaFinansial->harga_rumah }}'))
                $('[name=uang_muka]').val(
                    formatRp('{{ $collection->dataDiri->analisaFinansial->uang_muka }}'))
                $('[name=jumlah_permohonan_kredit]').val(
                    formatRp('{{ $collection->dataDiri->analisaFinansial->jumlah_permohonan_kredit }}'))
                @endif
                @if ($collection->dataDiri && $collection->dataDiri->ujiFlpp)
                $('[name=subsidi_uang_muka]').val(
                    formatRp('{{ $collection->dataDiri->ujiFlpp->subsidi_uang_muka }}'))
                @endif
                $('body').on('input', '[name=pendapatan_bersih]', function() {
                    let _val = $(this).val()
                    $(this).val(formatRp(_val))
                })
                $('body').on('input', '[name=penghasilan_pasangan]', function() {
                    let _val = $(this).val()
                    $(this).val(formatRp(_val))
                })
                $('body').on('input', '[name=penghasilan_lainnya]', function() {
                    let _val = $(this).val()
                    $(this).val(formatRp(_val))
                })
                $('body').on('input', '[name=angsuran_pinjaman_lain]', function() {
                    let _val = $(this).val()
                    $(this).val(formatRp(_val))
                })
                $('body').on('input', '[name=harga_rumah]', function() {
                    let _val = $(this).val()
                    $(this).val(formatRp(_val))
                })
                $('body').on('input', '[name=uang_muka]', function() {
                    let _val = $(this).val()
                    $(this).val(formatRp(_val))
                })
                $('body').on('input', '[name=jumlah_permohonan_kredit]', function() {
                    let _val = $(this).val()
                    $(this).val(formatRp(_val))
                })
                $('body').on('input', '[name=subsidi_uang_muka]', function() {
                    let _val = $(this).val()
                    $(this).val(formatRp(_val))
                })
                @if ($collection->status_pernikahan == 'Menikah')
                $('[id^=div-pasangan]').show(600)
                @else
                $('[id^=div-pasangan]').hide(600)
                @endif

                function changeTab(id1, id2) {
                    $(`#justify-pills-tab li:nth-child(${id1}) a`).removeClass('active')
                    $(`#justify-pills-tab li:nth-child(${id2}) a`).addClass('active')

                    // $('div #tab-datadiri').hide(600)
                    $(`div .tab-pane:nth-child(${id1})`).removeClass('active show', 1000, 'swing')
                    $(`div .tab-pane:nth-child(${id2})`).addClass('active show', 1000, 'swing')
                }

                $('#nextAnalisaFinansial').click(function() {
                    changeTab(1, 2)
                })
                $('#nextAgunan').click(function() {
                    changeTab(2, 3)
                })
                $('#nextFlpp').click(function() {
                    changeTab(3, 4)
                })
                $('#backDataDiri').click(function() {
                    changeTab(2, 1)
                })
                $('#backAnalisaFinansial').click(function() {
                    changeTab(3, 2)
                })
                $('#backAgunan').click(function() {
                    changeTab(4, 3)
                })

                $('#form-datadiri').submit(function(e) {
                    e.preventDefault();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('#form-datadiri [name=_token]').val()
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: $(this).attr("action"),
                        data: $(this).serialize(),
                        dataType: 'json',
                        beforeSend: function() {
                            loadButton($('#form-datadiri button'))
                        },
                        success: function(data) {
                            if (data.status == "ok") {
                                toastr["success"](data.messages);
                            }
                            changeTab(1, 2)
                        },
                        error: function(data) {
                            console.log(data.responseText)
                            var data = data.responseJSON;
                            if (data.status == "fail") {
                                toastr["error"](data.messages);
                            }
                        },
                        complete: function() {
                            loadButton($('#form-datadiri button'), false, 'Simpan')
                        }
                    });
                })

                $('#form-analisa-finansial').submit(function(e) {
                    e.preventDefault();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('#form-analisa-finansial [name=_token]').val()
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: $(this).attr("action"),
                        data: $(this).serialize(),
                        dataType: 'json',
                        beforeSend: function() {
                            loadButton($('#form-analisa-finansial button'))
                        },
                        success: function(data) {
                            changeTab(2, 3)
                            if (data.status == "ok") {
                                toastr["success"](data.messages);
                            }
                        },
                        error: function(data) {
                            var data = data.responseJSON;
                            if (data.status == "fail") {
                                toastr["error"](data.messages);
                            }
                        },
                        complete: function() {
                            loadButton($('#form-analisa-finansial button'), false, 'Simpan')
                        }
                    });
                })

                $('#form-agunan').submit(function(e) {
                    e.preventDefault();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('#form-agunan [name=_token]').val()
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: $(this).attr("action"),
                        data: $(this).serialize(),
                        dataType: 'json',
                        beforeSend: function() {
                            loadButton($('#form-agunan button'))
                        },
                        success: function(data) {
                            changeTab(3, 4)
                            if (data.status == "ok") {
                                toastr["success"](data.messages);
                            }
                        },
                        error: function(data) {
                            var data = data.responseJSON;
                            if (data.status == "fail") {
                                toastr["error"](data.messages);
                            }
                        },
                        complete: function() {
                            loadButton($('#form-agunan button'), false, 'Simpan')
                        }
                    });
                })

                $('#form-uji-flpp').submit(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Anda yakin ingin menyimpan data ini ?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Simpan !'
                    }).then((result) => {
                        if (result.value) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('#form-uji-flpp [name=_token]').val()
                                }
                            });

                            var form_data = new FormData($(this)[0]);
                            $.ajax({
                                type: 'post',
                                url: $(this).attr("action"),
                                data: form_data,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                beforeSend: function() {
                                    loadButton($('#form-uji-flpp button'))
                                },
                                success: function(data) {
                                    if (data.status == "ok") {
                                        toastr["success"](data.messages);
                                    }
                                    setTimeout(function() {
                                        window.location.href =
                                        '/operasional/collection'
                                    }, 1500);
                                },
                                error: function(data) {
                                    var data = data.responseJSON;
                                    if (data.status == "fail") {
                                        toastr["error"](data.messages);
                                    }
                                },
                                complete: function() {
                                    loadButton($('#form-uji-flpp button'), false, 'Simpan')
                                }
                            });
                        }
                    })
                })

                function getProvinsi(form_selector, selected_id = '') {
                    $.ajax({
                        type: 'get',
                        url: "{{ url('api/general/provinsi') }}",
                        beforeSend: function() {

                        },
                        success: function(data) {
                            let opt = '<option value="">Pilih Provinsi</option>'
                            $.each(data.data, function(k, v) {
                                opt +=
                                `<option value=${v.id} ${selected_id == v.id ? 'selected' : ''}>${v.provinsi}</option>`
                            })
                            $(`#${form_selector} [name=provinsi_id]`).html(opt)
                        },
                        error: function(data) {
                            var data = data.responseJSON;
                            if (data.status == "fail") {
                                toastr["error"](data.messages);
                            }
                        }
                    });
                }

                function getKota(provinsi_id = '', form_selector, selected_id = '') {
                    $.ajax({
                        type: 'get',
                        url: "{{ url('api/general/kota') }}",
                        data: {
                            id_provinsi: provinsi_id,
                            is_not_kanwil: true
                        },
                        beforeSend: function() {

                        },
                        success: function(data) {
                            let opt = '<option value="">Pilih Kota</option>'
                            $.each(data.data, function(k, v) {
                                opt +=
                                `<option value=${v.id} ${selected_id == v.id ? 'selected' : ''}>${v.kota}</option>`
                            })
                            $(`#${form_selector} [name=kota_id]`).prop('disabled', false).html(opt)
                        },
                        error: function(data) {
                            var data = data.responseJSON;
                            if (data.status == "fail") {
                                toastr["error"](data.messages);
                            }
                        }
                    });
                }

                function getKecamatan(kota_id = '', form_selector, selected_id = '') {
                    $.ajax({
                        type: 'get',
                        url: "{{ url('api/general/kecamatan') }}",
                        data: {
                            id_kota: kota_id
                        },
                        beforeSend: function() {

                        },
                        success: function(data) {
                            let opt = '<option value="">Pilih Kecamatan</option>'
                            $.each(data.data, function(k, v) {
                                opt +=
                                `<option value=${v.id} ${selected_id == v.id ? 'selected' : ''}>${v.kecamatan}</option>`
                            })
                            $(`#${form_selector} [name=kecamatan_id]`).prop('disabled', false).html(opt)
                        },
                        error: function(data) {
                            var data = data.responseJSON;
                            if (data.status == "fail") {
                                toastr["error"](data.messages);
                            }
                        }
                    });
                }

                function getKelurahan(kecamatan_id = '', form_selector, selected_id = '') {
                    $.ajax({
                        type: 'get',
                        url: "{{ url('api/general/kelurahan') }}",
                        data: {
                            id_kecamatan: kecamatan_id
                        },
                        beforeSend: function() {

                        },
                        success: function(data) {
                            let opt = '<option value="">Pilih Kelurahan</option>'
                            $.each(data.data, function(k, v) {
                                opt +=
                                `<option value=${v.id} ${selected_id == v.id ? 'selected' : ''}>${v.kelurahan}</option>`
                            })
                            $(`#${form_selector} [name=kelurahan_id]`).prop('disabled', false).html(opt)
                        },
                        error: function(data) {
                            var data = data.responseJSON;
                            if (data.status == "fail") {
                                toastr["error"](data.messages);
                            }
                        }
                    });
                }

                @if ($collection->dataDiri->kelurahan_id)
                let d_prov_id = '{{ $collection->dataDiri->kelurahan->kecamatan->kota->provinsi->id }}'
                let d_kota_id = '{{ $collection->dataDiri->kelurahan->kecamatan->kota->id }}'
                let d_kecamatan_id = '{{ $collection->dataDiri->kelurahan->kecamatan->id }}'
                let d_kelurahan_id = '{{ $collection->dataDiri->kelurahan->id }}'
                getProvinsi('form-datadiri', d_prov_id)
                getKota(d_prov_id, 'form-datadiri', d_kota_id)
                getKecamatan(d_kota_id, 'form-datadiri', d_kecamatan_id)
                getKelurahan(d_kecamatan_id, 'form-datadiri', d_kelurahan_id)
                @else
                getProvinsi('form-datadiri')
                @endif

                @if ($collection->dataDiri->kelurahan_id && $collection->dataDiri->agunan)
                let a_prov_id = '{{ $collection->dataDiri->agunan->kelurahan->kecamatan->kota->provinsi->id }}'
                let a_kota_id = '{{ $collection->dataDiri->agunan->kelurahan->kecamatan->kota->id }}'
                let a_kecamatan_id = '{{ $collection->dataDiri->agunan->kelurahan->kecamatan->id }}'
                let a_kelurahan_id = '{{ $collection->dataDiri->agunan->kelurahan->id }}'
                getProvinsi('form-agunan', a_prov_id)
                getKota(a_prov_id, 'form-agunan', a_kota_id)
                getKecamatan(a_kota_id, 'form-agunan', a_kecamatan_id)
                getKelurahan(a_kecamatan_id, 'form-agunan', a_kelurahan_id)
                @else
                getProvinsi('form-agunan')
                @endif

                $('[name=jenis_badan_hukum_developer]').select2()
                $('[name=is_pasangan_meninggal]').select2()
                $('[name=jenis_kepemilikan]').select2()
                $('[name=status_pernikahan]').select2()
                $('[name=jenis_kelamin]').select2()
                $('[name=pendidikan_terakhir]').select2()
                $('[name=kepemilikan_tempat_tinggal]').select2()
                $('[name=status_kepegawaian]').select2()
                $('[name=memiliki_simpanan_bri]').select2()

                $('#form-datadiri [name=provinsi_id]').select2()
                $('#form-datadiri [name=kota_id]').select2()
                $('#form-datadiri [name=kecamatan_id]').select2()
                $('#form-datadiri [name=kelurahan_id]').select2()

                $('body').on('change', '[name=status_pernikahan]', function() {
                    let val = $(this).find(':selected').val()
                    if (val == "Menikah") {
                        $('#div-pasangan_meninggal').show(600)
                        $('[id^=div-pasangan]').show(600)
                    }else{
                        $('#div-pasangan_meninggal').hide(600)                        
                        $('[id^=div-pasangan]').hide(600)
                    }
                })

                $('body').on('change', '[name=is_equals_ktpdomisili]', function() {
                    if(this.checked) {
                        $('#div-alamat_ktp').hide(600)
                    }else{
                        $('#div-alamat_ktp').show(600)
                    }
                })

                $('#form-analisa-finansial [name=pernah_pinjam_di_bank_lain]').select2()
                $('#form-analisa-finansial [name=jenis_fasilitas_di_bank_lain]').select2()



                $('#form-agunan [name=provinsi_id]').select2()
                $('#form-agunan [name=kota_id]').select2()
                $('#form-agunan [name=kecamatan_id]').select2()
                $('#form-agunan [name=kelurahan_id]').select2()

                $('body').on('change', '#form-agunan [name=provinsi_id]', function() {
                    let val = $(this).find(':selected').val()
                    getKota(val, 'form-agunan')
                })

                $('body').on('change', ' #form-agunan [name=kota_id]', function() {
                    let val = $(this).find(':selected').val()
                    getKecamatan(val, 'form-agunan')
                })

                $('body').on('change', '#form-agunan [name=kecamatan_id]', function() {
                    let val = $(this).find(':selected').val()
                    getKelurahan(val, 'form-agunan')
                })

                $('body').on('change', '#form-datadiri [name=provinsi_id]', function() {
                    let val = $(this).find(':selected').val()
                    getKota(val, 'form-datadiri')
                })

                $('body').on('change', ' #form-datadiri [name=kota_id]', function() {
                    let val = $(this).find(':selected').val()
                    console.log(val)
                    getKecamatan(val, 'form-datadiri')
                })

                $('body').on('change', '#form-datadiri [name=kecamatan_id]', function() {
                    let val = $(this).find(':selected').val()
                    getKelurahan(val, 'form-datadiri')
                })
            })
        </script>
        @endsection
