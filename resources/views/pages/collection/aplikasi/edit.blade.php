@extends('layouts.app')
@section('collection.aplikasi', 'active')
@section('content')
<style>
    .tab-content::-webkit-scrollbar {
        width: 3px;
    }

    /* Track */
    .tab-content::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 2px;
    }

    /* Handle */
    .tab-content::-webkit-scrollbar-thumb {
        background: #6610f2;
        border-radius: 2px;
    }

    /* Handle on hover */
    .tab-content::-webkit-scrollbar-thumb:hover {
        background: #a170f1;
    }

</style>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
{{-- <div class="page-header">
    <div class="page-title">
        <h3>Pengajuan Aplikasi</h3>
    </div>
</div> --}}
<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area simple-pills">
                @if ($collection->alasan_tolak)
                @foreach ($collection->historyStatus as $h)
                @if ($loop->last && $h->status_id == 2)
                <p class="mb-0">Tanggal alasan perbaikan oleh operasional : {{ $h->created_at }}
                </p>
                @endif
                @endforeach
                <div class="alert alert-danger">
                    <b>{{ $collection->alasan_tolak }}</b>
                </div>
                @endif
                @if ($collection->status_id == 3 && $collection->sanggah_tolak)

                @foreach ($collection->historyStatus as $h)
                @if ($loop->last && $h->status_id == 3)
                <p class="mb-0">Tanggal keterangan perbaikan oleh marketing :
                    {{ $h->created_at }}
                </p>
                @endif
                @endforeach

                <div class="alert alert-info">
                    <b>{{ $collection->sanggah_tolak }}</b>
                </div>
                @endif
                @foreach ($collection->historyStatus as $h)
                @if ($loop->last && $h->status_id == 12 && $collection->status_id == 12)
                <p class="mb-0">Tanggal keterangan perbaikan oleh BRI :
                    {{ $h->created_at }}
                </p>
                @endif
                @endforeach
                @if ($collection->status_id == 12)
                <div class="alert alert-warning">
                    <p>Alasan perbaikan BRI : </p>
                    <b>{{ $collection->alasan_perbaikan_bri }}</b>
                </div>
                @endif

                @foreach ($collection->historyStatus as $h)
                @if ($loop->last && $h->status_id == 14 && $collection->status_id == 14)
                <p class="mb-0">Tanggal keterangan penolakan oleh BRI :
                    {{ $h->created_at }}
                </p>
                @endif
                @endforeach
                @if ($collection->status_id == 14)
                <div class="alert alert-danger">
                    <p>Alasan tolak BRI : </p>
                    <b>{{ $collection->alasan_tolak_bri }}</b>
                </div>
                @endif

                @if ($collection->status_id == 18)
                <div class="alert alert-info">

                    @foreach ($collection->historyStatus as $h)
                    @if ($h->status_id == 18 && $collection->status_id == 18)
                    <h6>Pengajuan Aplikasi anda telah dicairkan pada : {{ $h->created_at }}</h6>
                    @endif
                    @endforeach

                    
                    <p>Nominal Plafond Kredit : {{ \Helper::rupiahFormat($collection->nominal_cair) }}</p>
                    <p>No rek kredit : {{ $collection->norek_kredit }}</p>
                </div>
                @endif
                @if ($collection->alasan_tolak_verifikasi)
                <div class="alert alert-danger">
                    <b>{{ $collection->alasan_tolak_verifikasi }}</b>
                </div>
                @endif
                @if ($collection->status_id == 6 && $collection->sanggah_tolak_verifikasi)
                <div class="alert alert-info">
                    <b>{{ $collection->sanggah_tolak_verifikasi }}</b>
                </div>
                @endif
                @if (\Auth::user()->getRoleNames()->first() != 'sales lepas' &&
                \Auth::user()->getRoleNames()->first() != 'sales developer')
                <div class="form-row">
                    <div class="col-md-12">
                        @if (!$collection->is_pengajuan)
                        <div class="alert alert-warning">
                            <h6><b>Pengajuan Aplikasi ini masih draft</b></h6>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table table-hover table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Nama Marketing</th>
                                        <th>Email</th>
                                        <th>No Handphone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $collection->userCreated->name }}</td>
                                        <td>{{ $collection->userCreated->email }}</td>
                                        <td>{{ $collection->userCreated->no_hp }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table table-hover table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Nama Debitur</th>
                                        <th>Nama Developer</th>
                                        <th>Nama Project</th>
                                        <th>Jenis Kredit</th>
                                        <th>Unit Kerja</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $collection->nama_calon_debitur }}</td>
                                        <td>{{ $collection->nama_developer }}</td>
                                        <td>{{ $collection->nama_project }}</td>
                                        <td>{{ $collection->jenis_kredit }}</td>
                                        <td>
                                            {{ $collection->uker_kode == 1039? 'DKI Jakarta - Kantor Cabang Khusus': "{$collection->unitKerja->kantorWilayah->kota} - {$collection->unitKerja->nama}" }}
                                        </td>                                    
                                        <td>
                                            @if (!$collection->is_pengajuan)
                                            {!! \Helper::badgeStatus(0) !!}
                                            @else
                                            {!! \Helper::badgeStatus($collection->status_id) !!}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Mapping Name</a>
                    </li>
                    @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab-datadiri" role="tab"
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
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-dataDiri-tab" data-toggle="pill" href="#pills-dataDiri"
                                    role="tab" aria-controls="pills-dataDiri" aria-selected="false">Upload Data Pribadi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="pills-dataPekerjaan-tab" data-toggle="pill"
                                    href="#pills-dataPekerjaan" role="tab" aria-controls="pills-dataPekerjaan"
                                    aria-selected="false">Upload Data Pekerjaan</a>
                                </li>
                                @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="pills-dataFlpp-tab" data-toggle="pill"
                                    href="#pills-dataFlpp" role="tab" aria-controls="pills-dataFlpp"
                                    aria-selected="false">Upload Form FLPP</a>
                                </li>
                                @endif
                                @if ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)')
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="pills-dataBp2bt-tab" data-toggle="pill"
                                    href="#pills-dataBp2bt" role="tab" aria-controls="pills-dataBp2bt"
                                    aria-selected="false">Upload Tambahan BP2BT</a>
                                </li>
                                @endif
                                @if ($collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)')
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="pills-Tapera-tab" data-toggle="pill" href="#pills-Tapera"
                                    role="tab" aria-controls="pills-Tapera" aria-selected="false">Upload Tambahan Tapera</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="pills-dataLegalitasAgunan-tab" data-toggle="pill"
                                    href="#pills-dataLegalitasAgunan" role="tab" aria-controls="pills-dataLegalitasAgunan"
                                    aria-selected="false">Upload Dokumen Legalitas Agunan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent" style="overflow-y: scroll;height: 500px;">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <form action="{{ url('collection/mapping-name') }}" method="POST"
                                enctype="multipart/form-data" id="form-mapping_name">
                                @csrf
                                <div class="widget-content widget-content-area">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Nama Calon Debitur / Pembeli</label>
                                            <input type="text" class="form-control" placeholder="Masukkan nama debitur"
                                            name="nama_calon_debitur" value="{{ $collection->nama_calon_debitur }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Nomor KTP</label>
                                            <input type="number" class="form-control" placeholder="Masukkan nomor ktp"
                                            name="no_ktp" value="{{ $collection->no_ktp }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Nomor Handphone Debitur</label>
                                            <input type="text" class="form-control"
                                            placeholder="Masukkan nomor hp debitur" name="no_telp_debitur"
                                            value="{{ $collection->no_telp_debitur }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Status Pernikahan</label>
                                            <select name="status_pernikahan" class="form-control">
                                                <?php $status = ['Menikah', 'Belum Menikah', 'Cerai']; ?>
                                                <option value="">Pilih Status Pernikahan</option>
                                                @foreach ($status as $s)
                                                <option value="{{ $s }}"
                                                {{ $s == $collection->status_pernikahan ? 'selected' : '' }}>
                                                {{ $s }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6" id="div-pasangan_meninggal"
                                    style="display: {{ $collection->status_pernikahan == 'Menikah' ? 'block' : 'none' }}">
                                    <label>Pasangan Meninggal Dunia ? </label>
                                    <select name="is_pasangan_meninggal" class="form-control">
                                        <?php $data = [0, 1]; ?>
                                        <option value="">Pilih</option>
                                        @foreach ($data as $d)
                                        <option value="{{ $d }}"
                                        {{ $d == $collection->is_pasangan_meninggal ? 'selected' : '' }}>
                                        {{ $d == 0 ? 'Tidak' : 'Ya' }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jenis Kredit</label>
                                <select name="jenis_kredit" class="form-control">
                                    <?php $data = ['KPR Subsidi FLPP (Fix Income)', 'KPR BP2BT (Non Fix Income)', 'KPR Tapera (Peserta Tapera)', 'KPR Komersial (Baru atau Secondary)']; ?>
                                    <option value="">Pilih Jenis Kredit</option>
                                    @foreach ($data as $d)
                                    <option value="{{ $d }}"
                                    {{ $d == $collection->jenis_kredit ? 'selected' : '' }}>
                                    {{ $d }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jenis Sub Kredit</label>
                            <select name="jenis_sub_kredit" class="form-control"
                            {{ $collection->jenis_kredit != 'KPR Tapera (Peserta Tapera)' ? 'disabled' : '' }}>
                            <?php $data = ['KPR', 'KBR', 'KRR']; ?>
                            <option value="">Pilih Jenis Sub Kredit</option>
                            @foreach ($data as $d)
                            <option value="{{ $d }}"
                            {{ $d == $collection->jenis_sub_kredit ? 'selected' : '' }}>
                            {{ $d }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Provinsi</label>
                    <select name="provinsi_id" class="form-control">

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Nama Unit Kerja BRI</label>
                    <select name="kantor_cabang" class="form-control">

                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3" id="div-jenis_pekerjaan"
                style="display: {{ $collection->jenis_pekerjaan ? 'block' : 'none' }};">
                <label>Jenis Pekerjaan</label>
                <select name="jenis_pekerjaan" class="form-control">
                    <?php $data = ['Wiraswasta', 'Pegawai', 'Profesional']; ?>
                    <option value="">Pilih Jenis Pekerjaan</option>
                    @foreach ($data as $d)
                    <option value="{{ $d }}"
                    {{ $d == $collection->jenis_pekerjaan ? 'selected' : '' }}>
                    {{ $d }}
                </option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Nama Developer / Perusahaan</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Developer"
            name="nama_developer" value="{{ $collection->nama_developer }}">
        </div>
        <div class="form-group col-md-4">
            <label>Nomor Telepon Developer</label>
            <input type="number" class="form-control"
            placeholder="Masukkan nomor telpon developer" name="no_telp_developer"
            value="{{ $collection->no_telp_developer }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13">
        </div>
        <div class="form-group col-md-4" style="margin-top: -38px;">
            <label>Nama Project / Perumahan</label>
            <span style="color: red;font-size: 12px;display: inline-block;">Khusus FLPP Penulisan Wajib sama dengan Inputan Sikasep</span>
            <input type="text" class="form-control" placeholder="Masukkan nama project"
            name="nama_project" value="{{ $collection->nama_project }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Alamat Project</label>
            <textarea name="alamat_project" rows="3" class="form-control"
            placeholder="Masukkan alamat project">{{ $collection->alamat_project }}</textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6" id="div-permohonan_kredit" style="display: {{ $collection->jumlah_permohonan_kredit ? 'block' : 'none' }};">
            <label>Jumlah Permohonan Kredit (otomatis)</label>
            <input type="text" class="form-control" placeholder="Masukkan Jumlah Permohonan Kredit" name="jumlah_permohonan_kredit" value="{{ $collection->jumlah_permohonan_kredit ?? '' }}">
        </div>
    </div>
    <button type="submit" class="btn btn-success mx-2 my-2 float-right">Simpan</button>
</div>
</form>
</div>
@include('partials.tabs-flpp')
<div class="tab-pane fade" id="pills-dataDiri" role="tabpanel"
aria-labelledby="pills-dataDiri-tab">
<form action="{{ url('collection/flpp/kelengkapan-berkas') }}" method="POST"
enctype="multipart/form-data" id="form-kelengkapan_berkas1">
@csrf
<div class="widget-content widget-content-area">
    <div class="form-row">
        @include('partials.collection-upload', [
        'label' => 'Formulir Permohonan KPR',
        'name' => 'form_permohonan_kpr',
        ])
        @include('partials.collection-upload', [
        'label' => 'Surat Pemesanan Rumah Developer',
        'name' => 'spr_dari_developer',
        ])
        @include('partials.collection-upload', [
        'label' => 'KTP Pemohon',
        'name' => 'ktp_pengajuan',
        'type' => 'jpg, jpeg, png, pdf',
        ])

        @if ($collection->status_pernikahan == 'Menikah')
        @include('partials.collection-upload', [
        'label' => 'KTP Pasangan',
        'name' => 'ktp_pasangan',
        'type' => 'jpg, jpeg, png, pdf',
        ])
        @include('partials.collection-upload', [
        'label' => 'Akta Nikah / Surat Nikah',
        'name' => 'akta_nikah',
        ])

        @if ($collection->is_pasangan_meninggal == 1)
        @include('partials.collection-upload', [
        'label' => 'Surat Kematian Pasangan',
        'name' => 'surat_kematian_pasangan',
        ])
        @endif
        @elseif($collection->status_pernikahan == 'Belum Menikah')
        @include('partials.collection-upload', [
        'label' => 'Keterangan Belum Menikah',
        'name' => 'keterangan_belum_nikah',
        ])
        @else
        @include('partials.collection-upload', [
        'label' => 'Surat Cerai',
        'name' => 'surat_cerai',
        ])
        @endif

        @include('partials.collection-upload', [
        'label' => 'NPWP',
        'name' => 'npwp',
        'type' => 'jpg, jpeg, png, pdf',
        ])
        @include('partials.collection-upload', [
        'label' => 'Kartu Keluarga',
        'name' => 'kartu_keluarga',
        'type' => 'jpg, jpeg, png, pdf',
        ])

        @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
        @include('partials.collection-upload', [
        'label' => 'Screenshoot pengajuan sikasep',
        'name' => 'dokumen_pengajuan_sikasep',
        'type' => 'jpg, jpeg, png, pdf',
        ])
        @endif
    </div>
    
    <a class="btn btn-warning mt-3" id="backUjiFlpp">Sebelumnya</a>
    <button type="submit" class="btn btn-success mt-3 float-right ml-2" disabled>Selanjutnya</button>
    <!-- <a class="disabled btn btn-success mt-3 float-right ml-2 {{ $collection->dataDiri ? '' : 'disabled' }}" id="nextDataPekerjaan">Selanjutnya</a> -->
</div>
</form>
</div>

<div class="tab-pane fade" id="pills-dataPekerjaan" role="tabpanel"
aria-labelledby="pills-dataPekerjaan-tab">
<form action="{{ url('collection/flpp/kelengkapan-berkas') }}" method="POST"
enctype="multipart/form-data" id="form-kelengkapan_berkas2">
@csrf
<div class="widget-content widget-content-area">
    <div class="form-row">
        @if ($collection->jenis_pekerjaan == 'Pegawai' || is_null($collection->jenis_pekerjaan))

        @if ($collection->jenis_kredit != 'KPR BP2BT (Non Fix Income)')
        @include('partials.collection-upload', [
        'label' => 'SK Pengangkatan Pegawai Tetap',
        'name' => 'copy_sk_pegawai_tetap',
        'type' => 'jpg, jpeg, png, pdf',
        ])
        @include('partials.collection-upload', [
        'label' => 'SK Aktif Bekerja',
        'name' => 'asli_sk_aktif_bekerja',
        'type' => 'jpg, jpeg, png, pdf',
        ])
        @include('partials.collection-upload', [
        'label' => 'Slip Gaji Periode 3 Bulan Terakhir',
        'name' => 'asli_slip_gaji',
        ])
        @endif
        @endif

        @if ($collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)' || $collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)')
        @include('partials.collection-upload', [
        'label' => 'Surat Keterangan Usaha',
        'name' => 'surat_keterangan_usaha',
        ])
        @endif

        @include('partials.collection-upload', [
        'label' => 'Rekening Koran',
        'name' => 'asli_rekening_koran',
        ])
        @include('partials.collection-upload', [
        'label' => 'SPT Pajak Tahun Terakhir',
        'name' => 'spt_pajak_penghasilan',
        ])

        @if ($collection->jenis_pekerjaan == 'Profesional')
        @include('partials.collection-upload', [
        'label' => 'Suat Izin Profesi',
        'name' => 'surat_izin_profesi',
        'type' => 'jpg, jpeg, png, pdf',
        ])
        @endif

        @if ($collection->jenis_pekerjaan == 'Wiraswasta')
        @include('partials.collection-upload', [
        'label' => 'Izin Usaha (SIUP,TDP,SITU,dll)',
        'name' => 'izin_usaha',
        'type' => 'jpg, jpeg, png, pdf',
        ])
        @include('partials.collection-upload', [
        'label' => 'Akta Pendirian Perusahaan(min telah berjalan 3 tahun)',
        'name' => 'akta_pendirian_perusahaan',
        'type' => 'jpg, jpeg, png, pdf',
        ])
        @endif
    </div>
    @if($collection->dokumenUtama->dokumenUtamaLainnya()->exists() && $collection->jenis_kredit != 'KPR Subsidi FLPP (Fix Income)')
    <h4>Dokumen Tambahan</h4>    
    @foreach($collection->dokumenUtama->dokumenUtamaLainnya as $tamb)
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Nama Dokumen : </label>
            <h6>{{$tamb->nama_file}}</h6>
        </div>
        <div class="col-md-2">
            <a href="{{\Helper::showImage($tamb->files->folder, $tamb->files->name)}}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">
                Lihat Dokumen
            </a>
        </div>
    </div>
    @endforeach   
    @endif

    @if ($collection->jenis_kredit != 'KPR Subsidi FLPP (Fix Income)')
    <a class="btn btn-primary btn-sm" id="btnTambahDokumen">Tambah Dokumen (jika ada)</a>
    <div class="form-row" id="contentFileTambahan">

    </div>
    @endif
    <a class="btn btn-warning mt-3" id="backUploadDataDiri">Sebelumnya</a>
    <!-- <button class="disabled btn btn-success mt-3 float-right ml-2 {{ $collection->dataDiri ? '' : 'disabled' }}" type="submit" id="nextUploadFormFlpp">Selanjutnya</button> -->
    <button class="btn btn-success mt-3 float-right ml-2" type="submit" disabled=>Selanjutnya</button>
</div>
</form>
</div>

@if ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)')
<div class="tab-pane fade" id="pills-dataBp2bt" role="tabpanel"
aria-labelledby="pills-dataBp2bt-tab">
<form action="{{ url('collection/flpp/kelengkapan-berkas') }}" method="POST"
enctype="multipart/form-data" id="form-kelengkapan_berkas3">
@csrf
<div class="widget-content widget-content-area">
    <div class="form-row">
        @include('partials.collection-upload', [
        'label' => 'Tabungan min 3 Bulan (Min Saldo 2.5 Jt)',
        'name' => 'tabungan_3bulan_terakhir',
        ])
        @include('partials.collection-upload', [
        'label' => 'Surat Pernyataan Kepemilikan Rumah',
        'name' => 'surat_pernyataan_kepemilikan_rumah',
        ])
        @include('partials.collection-upload', [
        'label' => 'Surat Pernyataan Pemohon Dana BP2BT',
        'name' => 'surat_pernyataan_pemohon_dana_bp2bt',
        ])
        @include('partials.collection-upload', [
        'label' => 'SK Tidak Memiliki Rumah Subsidi dan Tidak Subsidi',
        'name' => 'surat_pernyataan_tidak_menerima_rumah_subsidi',
        ])
        @include('partials.collection-upload', [
        'label' =>
        'Surat Pernyataan kesesuaian Foto Fisik Bangunan dan PSU (ttd Pengembang)',
        'name' => 'surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu',
        ])
        @include('partials.collection-upload', [
        'label' => 'Foto Fisik Bangunan dan PSU',
        'name' => 'foto_fisik_bangunan_psu',
        ])
        @include('partials.collection-upload', [
        'label' =>
        'Surat Pernyataan Kelaikan Fungsi Bangunan Rumah (MK atau SLF) Beserta Daftar Simak',
        'name' => 'surat_pernyataan_kelayakan_fungsi_bangunan_rumah',
        ])
        @include('partials.collection-upload', [
        'label' => 'Dokumen Struktur Beton Rumah',
        'name' => 'dokumen_struktur_beton_rumah',
        ])
    </div>
    <a class="btn btn-warning mt-3" id="backUploadDataPekerjaan">Sebelumnya</a>
    <a class="disabled btn btn-success mt-3 float-right ml-2 {{ $collection->dataDiri ? '' : 'disabled' }}"
        id="nextDokumenLegatitasAgunanBp2bt">Selanjutnya</a>
    </div>
</form>
</div>
@endif

@if ($collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)')
<div class="tab-pane fade" id="pills-Tapera" role="tabpanel"
aria-labelledby="pills-Tapera-tab">
<form action="{{ url('collection/flpp/kelengkapan-berkas') }}" method="POST"
enctype="multipart/form-data" id="form-kelengkapan_berkas4">
@csrf
<div class="widget-content widget-content-area">
    <div class="form-row">
        @include('partials.collection-upload', [
        'label' => 'Surat Pernyataan Pengajuan Fasilitas Tapera',
        'name' => 'surat_pernyataan_pengajuan_fasilitas_tapera',
        ])
        @include('partials.collection-upload', [
        'label' =>
        'Surat Pernyataan Kesanggupan Pemotongan Gaji Yang Di Tunjuk',
        'name' => 'surat_pernyataan_kesanggupan_potonggaji',
        ])

        @if ($collection->jenis_sub_kredit == 'KPR')
        @include('partials.collection-upload', [
        'label' =>
        'Surat Pernyataan kesesuaian Foto Fisik Bangunan dan PSU (ttd Pengembang)',
        'name' => 'surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu',
        ])
        @else
        @include('partials.collection-upload', [
        'label' => 'Foto rumah Kondisi Awal (Foto Digital)',
        'name' => 'foto_rumah_kondisi_awal',
        ])
        @endif

        @if ($collection->jenis_sub_kredit == 'KBR')
        @include('partials.collection-upload', [
        'label' =>
        'Surat Formulir RAB Pembiayaan untuk Pembangunan Rumah',
        'name' => 'rab_pembangunan_rumah_dan_renovasi_rumah',
        ])
        @elseif($collection->jenis_sub_kredit == 'KRR')
        @include('partials.collection-upload', [
        'label' => 'Surat Formulir RAB Pembiayaan untuk Renovasi Rumah',
        'name' => 'rab_pembangunan_rumah_dan_renovasi_rumah',
        ])
        @endif
    </div>
    <a class="btn btn-warning mt-3" id="backUploadTapera1">Sebelumnya</a>
    <a class="disabled btn btn-success mt-3 float-right ml-2 {{ $collection->dataDiri ? '' : 'disabled' }}"
        id="nextDokumenLegatitasAgunanTapera">Selanjutnya</a>
    </div>
</form>
</div>
@endif

@if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
<div class="tab-pane fade" id="pills-dataFlpp" role="tabpanel"
aria-labelledby="pills-dataFlpp-tab">
<form action="{{ url('collection/flpp/kelengkapan-berkas') }}" method="POST"
enctype="multipart/form-data" id="form-kelengkapan_berkas99">
@csrf
<div class="widget-content widget-content-area">
    <div class="form-row">
        @include('partials.collection-upload', [
        'label' => 'Surat Pernyataan Pemohon',
        'name' => 'surat_pernyataan_pemohon',
        'dokumen_tambahan' => true,
        ])
        @include('partials.collection-upload', [
        'label' => 'Surat Pernyataan Kepemilikan Rumah',
        'name' => 'surat_status_kepemilikan_rumah',
        'dokumen_tambahan' => true,
        ])
        @include('partials.collection-upload', [
        'label' => 'SK / Pernyataan Penghasilan',
        'name' => 'surat_pernyataan_penghasilan',
        'dokumen_tambahan' => true,
        ])
        @include('partials.collection-upload', [
        'label' => 'Surat Pernyataan Verifikasi',
        'name' => 'surat_pernyataan_verifikasi',
        'dokumen_tambahan' => true,
        ])
        @include('partials.collection-upload', [
        'label' => 'SK Belum Memiliki Rumah',
        'name' => 'surat_pernyataan_belum_memiliki_rumah',
        'dokumen_tambahan' => true,
        ])
    </div>
    @if($collection->dokumenUtama->dokumenUtamaLainnya()->exists() && $collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
    <h4>Dokumen Tambahan</h4>    
    @foreach($collection->dokumenUtama->dokumenUtamaLainnya as $tamb)
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Nama Dokumen : </label>
            <h6>{{$tamb->nama_file}}</h6>
        </div>
        <div class="col-md-2">
            <a href="{{\Helper::showImage($tamb->files->folder, $tamb->files->name)}}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">
                Lihat Dokumen
            </a>
        </div>
    </div>
    @endforeach   
    @endif     
    <a class="btn btn-primary btn-sm" id="btnTambahDokumen">Tambah Dokumen (jika ada)</a>
    <div class="form-row" id="contentFileTambahan">

    </div>
    <a class="btn btn-warning mt-3" id="backUploadDataPekerjaan2">Sebelumnya</a>
    <button type="submit" class="btn btn-success float-right disabled" id="nextDokumenLegatitasAgunan" disabled>Selanjutnya</button>
</div>
</form>
</div>
@endif

<div class="tab-pane fade" id="pills-dataLegalitasAgunan" role="tabpanel"
aria-labelledby="pills-dataLegalitasAgunan-tab">
<form action="{{ url('collection/developer-file') }}" method="POST"
enctype="multipart/form-data" id="form-kelengkapan_berkas20">
@csrf
<div class="widget-content widget-content-area">
    <div class="form-row">
        @include('partials.collection-upload', [
        'label' => 'IMB/PBG',
        'name' => 'files_imb',
        'is_developer' => true,
        ])
        @include('partials.collection-upload', [
        'label' => 'Sertifikat Tanah Induk/Pecah',
        'name' => 'files_sertifikat',
        'is_developer' => true,
        ])
        @if ($collection->jenis_kredit != 'KPR Komersial (Baru atau Secondary)')
        @include('partials.collection-upload', [
        'label' => 'SLF',
        'name' => 'files_slf',
        'is_developer' => true,
        ])
        @endif
        @include('partials.collection-upload', [
        'label' => 'PBB Terakhir',
        'name' => 'files_pbb',
        'is_developer' => true,
        ])

        @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
        <div class="form-group col-md-4">
            <label>ID Rumah</label>
            <input type="text" class="form-control" name="id_rumah"
            placeholder="Masukkan ID Rumah"
            value="{{ $collection->dataDiri->ujiFlpp->id_rumah ?? '' }}">
        </div>
        <div class="form-group col-md-4">
            <label>Nomor SLF</label>
            <input type="text" class="form-control" name="no_slf"
            placeholder="Masukkan Nomor SLF"
            value="{{ $collection->dataDiri->ujiFlpp->no_slf ?? '' }}">
        </div>
        <div class="form-group col-md-4">
            <label>Tanggal SLF</label>
            <input type="text" class="form-control flatpickr flatpickr-input active"
            name="tanggal_slf" placeholder="Masukkan Tanggal SLF"
            value="{{ $collection->dataDiri->ujiFlpp->tanggal_slf ?? '' }}">
        </div>
        @endif
        @if ($collection->status_id == 2 && $collection->alasan_tolak)
        <div class="form-group col-md-12">
            <label>Sanggah Perbaikan</label>
            <textarea name="sanggah_tolak" rows="2" class="form-control" placeholder="Masukkan sanggah perbaikan.."></textarea>
        </div>
        @endif
        
        @if ($collection->status_id == 6)
        <div class="form-group col-md-12 mb-3">
            <label for="inputEmail4">Sanggah Perbaikan Verifikasi</label>
            <textarea name="sanggah_tolak_verifikasi" rows="3" class="form-control" placeholder="Masukkan keterangan perbaikan"></textarea>
        </div>
        @endif
    </div>
    <a class="btn btn-warning mt-3" id="backUploadDataPekerjaan3">Sebelumnya</a>
    <button type="submit" class="btn btn-success mx-2 my-2 float-right" disabled>Ajukan Aplikasi</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets/js/helper.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/input-mask/input-mask.js') }}"></script>
@include('partials.alert')
<script>
    $(document).ready(function() {

        function formatRp(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        var table = $('#table-Datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('collection.aplikasi.dataTables') }}",
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: function(row) {
                    return `${row.nama_calon_debitur}-${row.no_ktp}`
                }
            },
            {
                data: 'nama_developer',
                name: 'nama_developer'
            },
            {
                data: 'nama_project',
                name: 'nama_project'
            },
            {
                data: 'jenis_kredit',
                name: 'jenis_kredit'
            },
            {
                data: 'nama_uker',
                name: 'kantor_cabangs.nama'
            },
            {
                data: 'status',
                name: 'status',
                orderable: true,
                searchable: true
            },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
            ]
        });

        flatpickr('[name=tanggal_slf]', {
            dateFormat: "d-m-Y"
        })
        @if (isset($isShow))
        $('select').select2({
            disabled: true
        })
        $('input,textarea').attr('disabled', true)
        $('button[type=submit], .btn-success').css({
            "opacity": "0.6",
            "pointer-events": "none"
        })
        $('#pills-tab li a').removeClass('disabled')
        $('#btnTambahDokumen').hide()
        @endif

        // cek abis submit mapping name
        if (localStorage.getItem("{{\Auth::user()->id}}") == "1") {
            changeTab(1, 2)
            setTimeout(function() {
                localStorage.removeItem("{{\Auth::user()->id}}")
            }, 1000);
        }

        if (localStorage.getItem("{{\Auth::user()->id}}") == "2") {
            $('#pills-home-tab').removeClass('active')
            $('#pills-home').removeClass('active')
            changeTab(5, 6)
            setTimeout(function() {
                localStorage.removeItem("{{\Auth::user()->id}}")
            }, 1000);

        }

        checkTabs(1)
        checkTabs(2)
        checkTabs(3)
        checkTabs(4)
        checkTabs(20)
        checkTabs(99)

        function checkTabs(form_id) {
            let file = $(`#form-kelengkapan_berkas${form_id} [type^=file]`).length
            let allFile = $(`#form-kelengkapan_berkas${form_id} [id^=div-content]`).children().length

            let ajukan_file   = $(`#form-kelengkapan_berkas${form_id} [type^=file]:not([name=files_slf])`).length
            let ajukanAllFile = $(`#form-kelengkapan_berkas${form_id} [id^=div-content]:not(#div-content-files_slf)`).children().length
            if (form_id == 20 && ajukan_file == ajukanAllFile) {
                $(`#form-kelengkapan_berkas${form_id} button[type=submit]`).attr('disabled', false)
            }
            // if (form_id == 20 && file == 4 && allFile == 3) {
            //     $(`#form-kelengkapan_berkas${form_id} button[type=submit]`).attr('disabled', false)
            //     console.log(file+'--'+allFile)
            // }
            if (file == allFile) {
                if (form_id == 1) {
                    // $('#nextDataPekerjaan').removeClass('disabled')
                    $(`#form-kelengkapan_berkas${form_id} button[type=submit]`).attr('disabled', false)
                    @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                    $('#pills-tab li:nth-child(7) a').removeClass('disabled')
                    @else
                    $('#pills-tab li:nth-child(3) a').removeClass('disabled')
                    @endif
                }
                if (form_id == 2) {

                    // $('#nextUploadFormFlpp').removeClass('disabled')
                    $(`#form-kelengkapan_berkas${form_id} button[type=submit]`).attr('disabled', false)
                    @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                    $('#pills-tab li:nth-child(8) a').removeClass('disabled')
                    @else
                    $('#pills-tab li:nth-child(4) a').removeClass('disabled')
                    @endif
                }
                if (form_id == 99) {
                    @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                    $('#nextDokumenLegatitasAgunan').removeClass('disabled').attr('disabled', false)
                    $('#pills-tab li:nth-child(9) a').removeClass('disabled')
                    @else
                    $('#pills-tab li:nth-child(5) a').removeClass('disabled')
                    @endif
                }
                if (form_id == 3) {
                    console.log(file+'--'+allFile)
                    $('#pills-tab li:nth-child(5) a').removeClass('disabled')
                    $('#nextDokumenLegatitasAgunanBp2bt').removeClass('disabled')
                }

                if (form_id == 4) {
                    $('#pills-tab li:nth-child(5) a').removeClass('disabled')
                    $('#nextDokumenLegatitasAgunanTapera').removeClass('disabled')
                }
            }
        }

        $('#form-mapping_name [name=jenis_pekerjaan]').select2()
        $('#form-mapping_name [name=provinsi_id]').select2()
        $('#form-mapping_name [name=is_pasangan_meninggal]').select2()
        @if ($collection->jenis_pekerjaan)
        $('#form-datadiri [name=jenis_pekerjaan]').select2()
        @endif
        $('#form-datadiri [name=jenis_pekerjaan]').select2()
        $('[name=jenis_sub_kredit]').select2()
        $('#form-mapping_name [name=status_pernikahan]').select2()
        $('[name=jenis_kredit]').select2()
        $('[name=kantor_cabang]').select2()

        $('body').on('change', '[name=jenis_kredit]', function() {
            let val = $(this).find(':selected').val()
            if (val != 'KPR Subsidi FLPP (Fix Income)') {
                $('#div-permohonan_kredit').show()
            } else {
                $('#div-permohonan_kredit').hide()
            }

            if (val == 'KPR Tapera (Peserta Tapera)') {
                $('[name=jenis_sub_kredit]').prop('disabled', false)
            } else {
                $('[name=jenis_sub_kredit]').prop('disabled', true)
            }

            if (val == 'KPR Komersial (Baru atau Secondary)') {
                $('#div-jenis_pekerjaan').show()
            } else {
                $('#div-jenis_pekerjaan').hide()
            }
        })

        $('body').on('change', '#form-mapping_name [name=provinsi_id]', function() {
            let val = $(this).find(':selected').val()
            getUker(val)
        })

        $('body').on('change', '[name=status_pernikahan]', function() {
            let val = $(this).find(':selected').val()
            if (val == "Menikah") {
                $('#div-pasangan_meninggal').show(600)
            } else {
                $('#div-pasangan_meninggal').hide(600)
            }
        })

        $('body').on('change', '[name=memiliki_simpanan_bri]', function() {
            let val = $(this).find(':selected').val()
            if (val == "Ya") {
                $('#div-rekeningBri').show(600)
            } else {
                $('#div-rekeningBri').hide(600)
            }
        })

        function uploadfile(name_file, menu_ke) {

            var formData = new FormData($(`#form-kelengkapan_berkas${menu_ke}`)[0]);
            formData.append('collection_id', '{{ $collection->id }}')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });
            if (menu_ke == 99) {
                var link = '{{ url('collection/flpp/tambahan-form-subsidi') }}'
            } else if (menu_ke == 20) {
                var link = '{{ url('collection/developer-file') }}'
            } else {
                var link = '{{ url('collection/flpp/kelengkapan-berkas') }}'
            }

            $.ajax({
                type: 'post',
                url: link,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    var html = '&nbsp;'
                    html +=
                    '<div class="spinner-border mr-2 align-self-center loader-sm" style="width: 1.5rem; height: 1.5rem;color: blue;">'
                    html += '</div>'
                    $(`#div-content-${name_file}`).css('margin-top', '55px').text('Load...').append(
                        html)
                },
                success: function(data) {
                    if (menu_ke == 20) {
                        getFile(data, name_file, true)
                    } else {

                        getFile(data, name_file)
                    }
                    if (data.status == "ok") {
                        toastr["success"]('Berhasil mengupload dokumen');
                    }
                    checkTabs(menu_ke)

                },
                error: function(data) {
                    var data = data.responseJSON;
                    if (data.status == "fail") {
                        toastr["error"](data.messages);
                    }
                },
                complete: function() {
                        // loadButton($('button[type=submit]'), false, 'Simpan')
                    }
                });
        }

        function checkFile(menu_ke = 1, that, name_file, ext = ['jpeg', 'png', 'jpg', 'pdf']) {
            var fileExtension = ext
            if ($.inArray($(that).val().split('.').pop(), fileExtension) == -1) {
                $(that).css('color', 'transparent')
                return toastr["error"]('Dokumen yang boleh diupload hanya berformat ' + ext.toString());
                
            }
            $(that).css('color', '#3b3f5c')
            uploadfile(name_file, menu_ke)
        }
        var clickCount = 0

        $('#btnTambahDokumen').click(function(){
            clickCount += 1
            let html = `<div class="col-md-4" id="divParent-${clickCount}">
            <label>Nama Dokumen</label>
            <input type="text" class="form-control" name="nama_dokumen[]" id="nama_dokumen-${clickCount}" placeholder="Nama Dokumen" required>
            </div>
            <div class="col-md-4" id="divParent-${clickCount}">
            <label>Upload Dokumen</label>
            <input type="file" class="form-control" name="dokumen[]" id="${clickCount}" placeholder="Pilih Dokumen" required accept="application/pdf" />
            </div>
            <div class="col-md-2" style="margin-top: 39px;" id="divParent-${clickCount}">
            <label for=""></label>
            <a class="btn btn-danger" style="width: 150px;padding: 2px;" id="hapusDokumenTambahan-${clickCount}">Hapus Dokumen</a>
            </div>
            <div class="col-md-2" id="div-contentTambahan-${clickCount}">

            </div>`
            $('#contentFileTambahan').append(html)  
        })

        $('body').on('click', '[id^=hapusDokumenTambahan]', function() {
            let selId = $(this).attr('id').replace( /^\D+/g, '')
            $(`[id=divParent-${selId}]`).remove()
            $(`[id=div-contentTambahan-${selId}]`).remove()
        })

        function uploadfileTambahan(menu_ke, id_target){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('#form-datadiri [name=_token]').val()
                }
            });
            var form_data = new FormData($(`#form-kelengkapan_berkas${menu_ke}`)[0]);
            form_data.append('collection_id', '{{ $collection->id }}')

            $.ajax({
                type: 'post',
                url: '{{ url('collection/flpp/kelengkapan-berkas') }}',
                data: form_data,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    var html = '&nbsp;'
                    html +=
                    '<div class="spinner-border mr-2 align-self-center loader-sm" style="width: 1.5rem; height: 1.5rem;color: blue;">'
                    html += '</div>'
                    $(`#div-contentTambahan-${id_target}`).css('margin-top', '40px').text('Load...').append(
                        html)
                },
                success: function(data) {
                    let fullUrl = `${location.origin}/appscollection/public/uploaded_files/`
                    let dokUtama = data.file.dokumen_utama_lainnya
                    $.each(dokUtama, function(k2, v2){
                        if (v2.nama_file == $(`#nama_dokumen-${id_target}`).val() ) {
                            fullUrl = fullUrl + v2.files.folder + '/' + v2.files.name
                            $(`#div-contentTambahan-${id_target}`).css('margin-top', '40px').html(
                                `<a href="${fullUrl}?${Math.random()}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">Lihat Dokumen</a>`
                                )        
                        }
                    })
                    if (data.status == "ok") {
                        toastr["success"]('Berhasil mengupload dokumen');
                    }
                    checkTabs(menu_ke)
                },
                error: function(data) {
                    $(`#div-contentTambahan-${id_target}`).html('')        
                    var data = data.responseJSON;
                    if (data.status == "fail") {
                        toastr["error"](data.messages);
                    }
                },
                complete: function() {
                    loadButton($('#form-kelengkapan_berkas1 button'), false, 'Selanjutnya')
                }
            });
        }

        function checkFileTambahan(menu_ke=1,id_target=1, that, name_file, ext = ['pdf']) {
            var fileExtension = ext
            if ($.inArray($(that).val().split('.').pop(), fileExtension) == -1) {
                $(that).css('color', 'transparent')
                return toastr["error"]('Dokumen yang boleh diupload hanya berformat ' + ext.toString());
                
            }
            $(that).css('color', '#3b3f5c')
            uploadfileTambahan(menu_ke, id_target)
        }

            // datairi

            $('body').on('change', '[name=form_permohonan_kpr]', function() {
                checkFile(1, this, 'form_permohonan_kpr', ['pdf'])
            })

            $('body').on('change', '[name=spr_dari_developer]', function() {
                checkFile(1, this, 'spr_dari_developer', ['pdf'])
            })

            $('body').on('change', '[name=ktp_pengajuan]', function() {
                checkFile(1, this, 'ktp_pengajuan')
            })

            $('body').on('change', '[name=ktp_pasangan]', function() {
                checkFile(1, this, 'ktp_pasangan')
            })

            $('body').on('change', '[name=akta_nikah]', function() {
                checkFile(1, this, 'akta_nikah', ['pdf'])
            })

            $('body').on('change', '[name=keterangan_belum_nikah]', function() {
                checkFile(1, this, 'keterangan_belum_nikah', ['pdf'])
            })

            $('body').on('change', '[name=surat_cerai]', function() {
                checkFile(1, this, 'surat_cerai', ['pdf'])
            })

            $('body').on('change', '[name=surat_kematian_pasangan]', function() {
                checkFile(1, this, 'surat_kematian_pasangan', ['pdf'])
            })

            $('body').on('change', '[name=npwp]', function() {
                checkFile(1, this, 'npwp')
            })

            $('body').on('change', '[name=kartu_keluarga]', function() {
                checkFile(1, this, 'kartu_keluarga')
            })

            $('body').on('change', '[name=dokumen_pengajuan_sikasep]', function() {
                checkFile(1, this, 'dokumen_pengajuan_sikasep')
            })

            $('body').on('change', '[name^=dokumen]', function() {
                @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                checkFileTambahan(99, $(this).attr('id'), this)
                @else
                checkFileTambahan(2, $(this).attr('id'), this)
                @endif
            })

            // pekerjaan
            $('body').on('change', '[name=copy_sk_pegawai_tetap]', function() {
                checkFile(2, this, 'copy_sk_pegawai_tetap')
            })

            $('body').on('change', '[name=asli_sk_aktif_bekerja]', function() {
                checkFile(2, this, 'asli_sk_aktif_bekerja')
            })

            $('body').on('change', '[name=asli_slip_gaji]', function() {
                checkFile(2, this, 'asli_slip_gaji', ['pdf'])
            })

            $('body').on('change', '[name=asli_rekening_koran]', function() {
                checkFile(2, this, 'asli_rekening_koran', ['pdf'])
            })

            $('body').on('change', '[name=spt_pajak_penghasilan]', function() {
                checkFile(2, this, 'spt_pajak_penghasilan', ['pdf'])
            })

            $('body').on('change', '[name=surat_izin_profesi]', function() {
                checkFile(2, this, 'surat_izin_profesi')
            })

            $('body').on('change', '[name=izin_usaha]', function() {
                checkFile(2, this, 'izin_usaha')
            })

            $('body').on('change', '[name=akta_pendirian_perusahaan]', function() {
                checkFile(2, this, 'akta_pendirian_perusahaan')
            })
            $('body').on('change', '[name=surat_keterangan_usaha]', function() {
                checkFile(2, this, 'surat_keterangan_usaha', ['pdf'])
            })

            // tambahan flpp
            $('body').on('change', '[name=surat_pernyataan_pemohon]', function() {
                checkFile(99, this, 'surat_pernyataan_pemohon', ['pdf'])
            })

            $('body').on('change', '[name=surat_status_kepemilikan_rumah]', function() {
                checkFile(99, this, 'surat_status_kepemilikan_rumah', ['pdf'])
            })

            $('body').on('change', '[name=surat_pernyataan_penghasilan]', function() {
                checkFile(99, this, 'surat_pernyataan_penghasilan', ['pdf'])
            })

            $('body').on('change', '[name=surat_pernyataan_verifikasi]', function() {
                checkFile(99, this, 'surat_pernyataan_verifikasi', ['pdf'])
            })

            $('body').on('change', '[name=surat_pernyataan_belum_memiliki_rumah]', function() {
                checkFile(99, this, 'surat_pernyataan_belum_memiliki_rumah', ['pdf'])
            })

            //legalitas agunan
            $('body').on('change', '[name=files_imb]', function() {
                checkFile(20, this, 'files_imb', ['pdf'])
            })

            $('body').on('change', '[name=files_sertifikat]', function() {
                checkFile(20, this, 'files_sertifikat', ['pdf'])
            })

            $('body').on('change', '[name=files_slf]', function() {
                checkFile(20, this, 'files_slf', ['pdf'])
            })

            $('body').on('change', '[name=files_pbb]', function() {
                checkFile(20, this, 'files_pbb', ['pdf'])
            })

            // bp2bt
            $('body').on('change', '[name=tabungan_3bulan_terakhir]', function() {
                checkFile(3, this, 'tabungan_3bulan_terakhir', ['pdf'])
            })

            $('body').on('change', '[name=surat_pernyataan_kepemilikan_rumah]', function() {
                checkFile(3, this, 'surat_pernyataan_kepemilikan_rumah', ['pdf'])
            })

            $('body').on('change', '[name=surat_pernyataan_pemohon_dana_bp2bt]', function() {
                checkFile(3, this, 'surat_pernyataan_pemohon_dana_bp2bt', ['pdf'])
            })

            $('body').on('change', '[name=surat_pernyataan_tidak_menerima_rumah_subsidi]', function() {
                checkFile(3, this, 'surat_pernyataan_tidak_menerima_rumah_subsidi', ['pdf'])
            })

            $('body').on('change', '[name=foto_fisik_bangunan_psu]', function() {
                checkFile(3, this, 'foto_fisik_bangunan_psu', ['pdf'])
            })

            $('body').on('change', '[name=surat_pernyataan_kelayakan_fungsi_bangunan_rumah]', function() {
                checkFile(3, this, 'surat_pernyataan_kelayakan_fungsi_bangunan_rumah', ['pdf'])
            })

            $('body').on('change', '[name=dokumen_struktur_beton_rumah]', function() {
                checkFile(3, this, 'dokumen_struktur_beton_rumah', ['pdf'])
            })
            $('body').on('change', '[name=surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu]', function() {
                checkFile(3, this, 'surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu', ['pdf'])
            })

            // Tapera
            $('body').on('change', '[name=surat_pernyataan_pengajuan_fasilitas_tapera]', function() {
                checkFile(4, this, 'surat_pernyataan_pengajuan_fasilitas_tapera', ['pdf'])
            })

            $('body').on('change', '[name=surat_pernyataan_kesanggupan_potonggaji]', function() {
                checkFile(4, this, 'surat_pernyataan_kesanggupan_potonggaji', ['pdf'])
            })

            $('body').on('change', '[name=surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu]', function() {
                checkFile(4, this, 'surat_pernyataan_kesesuaian_foto_fisik_bangunan_psu', ['pdf'])
            })

            $('body').on('change', '[name=foto_rumah_kondisi_awal]', function() {
                checkFile(4, this, 'foto_rumah_kondisi_awal', ['pdf'])
            })

            $('body').on('change', '[name=rab_pembangunan_rumah_dan_renovasi_rumah]', function() {
                checkFile(4, this, 'rab_pembangunan_rumah_dan_renovasi_rumah', ['pdf'])
            })

            getProvinsi2('{{ $collection->unitKerja->cust_provinsi_id }}')

            function getProvinsi2(selected_id = '') {
                $.ajax({
                    type: 'get',
                    url: "{{ url('api/general/provinsi') }}",
                    beforeSend: function() {},
                    success: function(data) {
                        let opt = '<option value="">Pilih Provinsi</option>'
                        $.each(data.data, function(k, v) {
                            opt +=
                            `<option value=${v.id} ${selected_id == v.id ? 'selected' : ''}>${v.provinsi}</option>`
                        })
                        $('#form-mapping_name [name=provinsi_id]').html(opt)
                    },
                    error: function(data) {
                        var data = data.responseJSON;
                        if (data.status == "fail") {
                            toastr["error"](data.messages);
                        }
                    }
                });
            }

            getUker('{{ $collection->unitKerja->cust_provinsi_id }}', '{{ $collection->unitKerja->kode }}')

            function getUker(provinsi_id = '', selected_id = '') {
                $.ajax({
                    type: 'get',
                    url: "{{ url('api/general/kantor_cabang') }}",
                    data: {
                        provinsi_id: provinsi_id
                    },
                    beforeSend: function() {

                    },
                    success: function(data) {
                        let opt = '<option value="">Pilih Unit Kerja</option>'
                        $.each(data.data, function(k, v) {
                            opt +=
                            `<option value=${v.kode} ${selected_id == v.kode ? 'selected' : ''}>${v.nama}</option>`
                            if (v.kcp.length > 0) {
                                $.each(v.kcp, function(k2, v2) {
                                    opt +=
                                    `<option value=${v2.kode} ${selected_id == v2.kode ? 'selected' : ''} >&nbsp;&nbsp;&nbsp;&nbsp;${v2.nama}</option>`
                                })
                            }
                        })
                        $(`[name=kantor_cabang]`).prop('disabled', false).html(opt)
                    },
                    error: function(data) {
                        var data = data.responseJSON;
                        if (data.status == "fail") {
                            toastr["error"](data.messages);
                        }
                    }
                });
            }

            function getFile(data, name_file, is_dev = false) {
                // let fullUrl = `${location.origin}/uploaded_files/`
                let fullUrl = `${location.origin}/appscollection/public/uploaded_files/`
                let dokUtama
                if (is_dev) {
                    dokUtama = data.data
                } else {
                    dokUtama = data.file
                }
                fullUrl = fullUrl + dokUtama.folder + '/' + dokUtama[name_file]
                if (dokUtama.extension[name_file] == 'pdf') {
                    $(`#div-content-${name_file}`).css('margin-top', '55px').html(
                        `<a href="${fullUrl}?${Math.random()}" style="color: #0f7ef7;font-weight: 600;text-decoration: underline" target="_blank">Lihat Dokumen</a>`
                        )
                } else {
                    $(`#div-content-${name_file}`).css('margin-top', '-20px').html(
                        // `<a href="${fullUrl}" target="_blank"><img src="${fullUrl}" style="height: 150px;width: 150px;"></a>`
                        `<a href="${fullUrl}" target="_blank"><img src="${fullUrl}?${Math.random()}" style="height: 150px;width: 150px;"></a>`
                        )
                }
            }

            

            $('#form-kelengkapan_berkas20').submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Pastikan aplikasi yang anda ajukan sudah benar.',
                    text: "Jika ingin melakukan pengecekan / perubahan, klik button 'sebelumnya' .",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya !'
                }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            }
                        });

                        var form_data = new FormData($(this)[0]);
                        form_data.append('collection_id', '{{ $collection->id }}')
                        form_data.append('sanggah_tolak', $('[name=sanggah_tolak]').val())
                        form_data.append('aplikasi_terkirim', true)

                        $.ajax({
                            type: 'post',
                            url: $(this).attr("action"),
                            data: form_data,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            beforeSend: function() {
                                loadButton($(
                                    '#form-kelengkapan_berkas20 button[type=submit]'
                                    ))
                            },
                            success: function(data) {
                                if (data.status == "ok") {
                                    toastr["success"]("Berhasil mengajukan aplikasi");
                                }
                                setTimeout(function() {
                                    window.location.href =
                                    "/collection/aplikasi";
                                }, 1500);
                            },
                            error: function(data) {
                                var data = data.responseJSON;
                                if (data.status == "fail") {
                                    toastr["error"](data.messages);
                                }
                            },
                            complete: function() {
                                loadButton($(
                                    '#form-kelengkapan_berkas20 button[type=submit]'
                                    ), false, 'Ajukan Aplikasi')
                            }
                        });
                    }
                })

            })

            $('#form-mapping_name').submit(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                var form_data = new FormData($(this)[0]);
                form_data.append('collection_id', '{{ $collection->id }}')

                $.ajax({
                    type: 'post',
                    url: $(this).attr("action"),
                    data: form_data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        loadButton($('#form-mapping_name button[type=submit]'))
                    },
                    success: function(data) {
                        changeTab(1, 2)
                        if (data.status == "ok") {
                            toastr["success"]("Berhasil mengubah mapping name");
                        }

                    },
                    error: function(data) {
                        var data = data.responseJSON;
                        if (data.status == "fail") {
                            toastr["error"](data.messages);
                        }
                    },
                    complete: function() {
                        loadButton($('#form-mapping_name button[type=submit]'), false, 'Simpan')
                    }
                });
            })

            // form flpp dan lainnya
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

            $('body').on('input', '[name=jumlah_permohonan_kredit]', function() {
                let _val = $(this).val()
                $(this).val(formatRp(_val))
            })

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
            @else
            $('[name=jumlah_permohonan_kredit]').val(
                formatRp('{{ $collection->jumlah_permohonan_kredit }}'))
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
                let _hargarumah = parseInt($('[name=harga_rumah]').val().replace(/\./g,''))
                let _uangmuka = parseInt($(this).val().replace(/\./g,''))
                console.log(_uangmuka)
                if (!isNaN(_uangmuka)) {
                    if (_uangmuka <= _hargarumah ) {
                        let jumlah_kredit = _hargarumah - _uangmuka
                        $('[name=jumlah_permohonan_kredit]').val(formatRp(jumlah_kredit.toString()))
                        $('#form-analisa-finansial [type=submit]').attr('disabled', false)
                    }else{
                        $('[name=jumlah_permohonan_kredit]').val(0)
                        toastr["error"]("Uang muka melebihi harga rumah.");
                        $('#form-analisa-finansial [type=submit]').attr('disabled', true)
                    }  
                }                
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
                @if ($collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)')
                    // id1 -= 4
                    // id2 -= 4
                    //
                    @endif

                // custom bp2bt
                // if (id1 == 4 && id2 == 5) {
                //     id2 = 6
                // }

                @if ($collection->jenis_kredit != 'KPR Subsidi FLPP (Fix Income)')
                if(id1 == 5 && id2 == 4){
                    id1 = 6
                }
                @endif
                // console.log(id1 + '==' + id2)
                $(`#pills-tab li:nth-child(${id1 == 6 && id2 == 4 ? 5 : id1}) a`).removeClass('active')
                $(`#pills-tab li:nth-child(${id1 == 4 && id2 == 6 ? 5 : id2}) a`).addClass('active')

                // $('div #tab-datadiri').hide(600)
                $(`div .tab-pane:nth-child(${id1})`).removeClass('active show', 1000, 'swing')
                $(`div .tab-pane:nth-child(${id2})`).addClass('active show', 1000, 'swing')
            }

            $('#backMappingName').click(function() {
                changeTab(2, 1)
            })

            $('#backDataDiri').click(function() {
                changeTab(3, 2)
            })

            $('#backUploadTapera1').click(function() {
                changeTab(4, 3)
                $('#pills-dataLegalitasAgunan').removeClass('active show', 1000, 'swing')
            })

            $('#backAnalisaFinansial').click(function() {
                changeTab(4, 3)
            })

            $('#backAgunan').click(function() {
                changeTab(5, 4)
            })

            $('#backUjiFlpp').click(function() {
                @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                changeTab(6, 5)
                @elseif ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)' || $collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)' || $collection->jenis_kredit == 'KPR Komersial (Baru atau Secondary)')
                changeTab(2, 1)
                @endif
            })

            $('#backUploadDataDiri').click(function() {
                @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                changeTab(7, 6)
                @elseif ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)' || $collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)' || $collection->jenis_kredit == 'KPR Komersial (Baru atau Secondary)')
                changeTab(3, 2)
                @endif

            })

            $('#backUploadDataPekerjaan').click(function() {
                @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                changeTab(8, 7)
                @elseif ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)')
                changeTab(4, 3)
                @endif
            })

            $('#backUploadDataPekerjaan2').click(function() {
                changeTab(8, 7)
                @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                @elseif ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)')
                @endif
            })

            $('#backUploadDataPekerjaan3').click(function() {
                @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                changeTab(9, 8)
                @elseif ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)' || $collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)')
                changeTab(5, 4)
                @elseif ($collection->jenis_kredit == 'KPR Komersial (Baru atau Secondary)')
                changeTab(4, 3)
                @endif
                $('#pills-dataLegalitasAgunan').removeClass('active show', 1000, 'swing')
            })

            // $('#nextDataPekerjaan').click(function() {
            //     @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
            //     changeTab(6, 7)
            //     @elseif ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)')
            //     changeTab(2, 3)
            //     @elseif($collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)' || $collection->jenis_kredit == 'KPR Komersial (Baru atau Secondary)')
            //     console.log('ea')
            //     $(`#pills-tab li:nth-child(2) a`).removeClass('active')
            //     $(`#pills-tab li:nth-child(3) a`).addClass('active')

            //     $(`div .tab-pane:nth-child(2)`).removeClass('active show', 1000, 'swing')
            //     $(`div .tab-pane:nth-child(3)`).addClass('active show', 1000, 'swing')
            //     $('#pills-dataLegalitasAgunan').removeClass('active show', 1000, 'swing')
            //     @endif
            // })
            // $('#nextUploadFormFlpp').click(function() {
            //     @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
            //     changeTab(7, 8)
            //     @elseif ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)' || $collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)')
            //     changeTab(3, 4)
            //     @elseif ($collection->jenis_kredit == 'KPR Komersial (Baru atau Secondary)')
            //     changeTab(3, 4)
            //     @endif
            // })

            // $('#nextDokumenLegatitasAgunan').click(function() {
            //     changeTab(8, 9)
            // })

            $('#nextDokumenLegatitasAgunanBp2bt').click(function() {
                changeTab(4, 5)
            })

            $('#nextDokumenLegatitasAgunanTapera').click(function() {
                changeTab(4, 6)
                $('#pills-dataLegalitasAgunan').addClass('active show', 1000, 'swing')
            })

            $('#form-kelengkapan_berkas2').submit(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#form-kelengkapan_berkas2 [name=_token]').val()
                    }
                });
                var form_data = new FormData($(this)[0]);
                form_data.append('collection_id', '{{ $collection->id }}')
                $.ajax({
                    type: 'post',
                    url: $(this).attr("action"),
                    data: form_data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        loadButton($('#form-kelengkapan_berkas2 button'))
                    },
                    success: function(data) {
                        @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                        changeTab(7, 8)
                        @elseif ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)' || $collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)')
                        changeTab(3, 4)
                        @elseif ($collection->jenis_kredit == 'KPR Komersial (Baru atau Secondary)')
                        changeTab(3, 4)
                        @endif
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
                        loadButton($('#form-kelengkapan_berkas2 button'), false, 'Selanjutnya')
                    }
                });
            })

            $('#form-kelengkapan_berkas99').submit(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#form-kelengkapan_berkas99 [name=_token]').val()
                    }
                });
                var form_data = new FormData($(this)[0]);
                form_data.append('collection_id', '{{ $collection->id }}')
                $.ajax({
                    type: 'post',
                    url: $(this).attr("action"),
                    data: form_data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        loadButton($('#form-kelengkapan_berkas99 button'))
                    },
                    success: function(data) {
                        changeTab(8, 9)
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
                        loadButton($('#form-kelengkapan_berkas99 button'), false, 'Selanjutnya')
                    }
                });
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
                        loadButton($('#form-datadiri button'), false, 'Simpan')
                    }
                });
            })

            $('#form-kelengkapan_berkas1').submit(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('#form-datadiri [name=_token]').val()
                    }
                });
                var form_data = new FormData($(this)[0]);
                form_data.append('collection_id', '{{ $collection->id }}')
                $.ajax({
                    type: 'post',
                    url: $(this).attr("action"),
                    data: form_data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        loadButton($('#form-kelengkapan_berkas1 button'))
                    },
                    success: function(data) {
                        @if ($collection->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                        changeTab(6, 7)
                        @elseif ($collection->jenis_kredit == 'KPR BP2BT (Non Fix Income)')
                        changeTab(2, 3)
                        @elseif($collection->jenis_kredit == 'KPR Tapera (Peserta Tapera)' || $collection->jenis_kredit == 'KPR Komersial (Baru atau Secondary)')
                        $(`#pills-tab li:nth-child(2) a`).removeClass('active')
                        $(`#pills-tab li:nth-child(3) a`).addClass('active')

                        $(`div .tab-pane:nth-child(2)`).removeClass('active show', 1000, 'swing')
                        $(`div .tab-pane:nth-child(3)`).addClass('active show', 1000, 'swing')
                        $('#pills-dataLegalitasAgunan').removeClass('active show', 1000, 'swing')
                        @endif
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
                        loadButton($('#form-kelengkapan_berkas1 button'), false, 'Selanjutnya')
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
                        changeTab(4, 5)
                        $(`#pills-tab li:nth-child(4) a`).removeClass('active')
                        $(`#pills-tab li:nth-child(5) a`).addClass('active')

                        $(`div .tab-pane:nth-child(4)`).removeClass('active show', 1000,
                            'swing')
                        $(`div .tab-pane:nth-child(5)`).addClass('active show', 1000, 'swing')
                        $('#pills-dataDiri').removeClass('active show', 1000, 'swing')
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
                        localStorage.setItem("{{\Auth::user()->id}}", "2")                        
                        if (data.status == "ok") {
                            toastr["success"](data.messages);
                        }
                        setTimeout(function() {
                            window.location.href = `/collection/aplikasi/${data.data.collection_files_id}/edit`
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

            @if ($collection->dataDiri()->exists() && $collection->dataDiri->kelurahan_id)
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

            @if ($collection->dataDiri()->exists() && $collection->dataDiri->agunan->kelurahan_id && $collection->dataDiri->agunan)
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
            // $('[name=is_pasangan_meninggal]').select2()
            $('[name=jenis_kepemilikan]').select2()
            $('[name=jenis_kelamin]').select2()
            $('[name=pendidikan_terakhir]').select2()
            $('[name=kepemilikan_tempat_tinggal]').select2()
            $('[name=status_kepegawaian]').select2()
            $('[name=memiliki_simpanan_bri]').select2()

            $('#form-datadiri [name=provinsi_id]').select2()
            $('#form-datadiri [name=kota_id]').select2()
            $('#form-datadiri [name=kecamatan_id]').select2()
            $('#form-datadiri [name=kelurahan_id]').select2()

            $('body').on('change', '[name=is_equals_ktpdomisili]', function() {
                if (this.checked) {
                    $('#div-alamat_ktp').hide(600)
                } else {
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
                getKecamatan(val, 'form-datadiri')
            })

            $('body').on('change', '#form-datadiri [name=kecamatan_id]', function() {
                let val = $(this).find(':selected').val()
                getKelurahan(val, 'form-datadiri')
            })
        })
    </script>
    @endsection