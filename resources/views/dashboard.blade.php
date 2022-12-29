@extends('layouts.app')
@section('dashboard', 'active')
@section('content')
<style>
    #table-totalCollection tr th {
        text-transform: none;
    }

</style>
<div class="page-header">
    <div class="page-title">
        <h3>Dashboard</h3>
    </div>
</div>

<div class="row layout-top-spacing">
    
    @if ($role == 'operasional' || $role == 'admin cri' || $role == 'superadmin' || $role == 'sales lepas' || $role == 'sales developer')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing mt-3">
        @if ($role == 'sales lepas' || $role == 'sales developer' || $role == 'operasional')
        <div class="mb-2">
            <a href="{{url('api/download-dokumen/manual-book')}}" class="btn btn-primary btn-sm">Download Manual Book Marketing</a>
            <a href="{{url('api/download-dokumen/flpp')}}" class="btn btn-primary btn-sm">Download Form FLPP</a>
            <a href="{{url('api/download-dokumen/bp2bt')}}" class="btn btn-primary btn-sm">Download Form BP2BT</a>
            <a href="{{url('api/download-dokumen/tapera')}}" class="btn btn-primary btn-sm">Download Form Tapera</a>
            <a href="{{url('api/download-dokumen/form-kpr')}}" class="btn btn-primary btn-sm">Download Form Komersial</a>
        </div>
        @endif
        <div class="widget widget-chart-three">
            <div class="widget-heading">
                <div class="">
                    <h5>Total Data Collection</h5>
                </div>
            </div>

            <div class="widget-content"
            style="min-height: 100px;padding: 0 20px;max-height: 500px;overflow-x: scroll;">
            <table class="table table-hover table-bordered" id="table-totalCollection" style="width:100%">
                <thead>
                    <tr>
                        @if($role == 'superadmin' || $role == 'admin cri' || $role == 'operasional')
                        <th>Draft</th>
                        @endif
                        <th>Belum dicek</th>
                        <th>Berkas tidak lengkap</th>
                        <th>Pengajuan kembali berkas</th>
                        <th>Selesai Pengecekan Berkas</th>
                        <th>Pengecekan Data Input</th>
                        <th>Ditolak Verifikasi</th>
                        <th>Pengajuan Kembali Verifikasi CRI</th>
                        <th>Pending Verifikasi CRI</th>
                        <th>Diterima Verifikasi CRI</th>
                        <th>Terkirim ke Uker BRI</th>
                        <th>Sudah diproses BRI</th>
                        <th>Perbaikan BRI</th>
                        <th>Analisa&Verifikasi BRI</th>
                        <th>Putus Tolak BRI</th>
                        <th>Putus Terima BRI</th>
                        <th>Calon Debitur Membatalkan BRI</th>
                        <th>Akad Kredit BRI</th>
                        <th>Pencairan BRI</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $cond = $role == 'sales lepas' || $role == 'sales developer' ? true : false; ?>
                        @if($role == 'superadmin' || $role == 'admin cri' || $role == 'operasional')
                        <td>{{ \Helper::getTotal(0, $cond) }}</td>
                        @endif
                        <td>{{ \Helper::getTotal(1, $cond) }}</td>
                        <td>{{ \Helper::getTotal(2, $cond) }}</td>
                        <td>{{ \Helper::getTotal(3, $cond) }}</td>
                        <td>{{ \Helper::getTotal(4, $cond) }}</td>
                        <td>{{ \Helper::getTotal(5, $cond) }}</td>
                        <td>{{ \Helper::getTotal(6, $cond) }}</td>
                        <td>{{ \Helper::getTotal(7, $cond) }}</td>
                        <td>{{ \Helper::getTotal(8, $cond) }}</td>
                        <td>{{ \Helper::getTotal(9, $cond) }}</td>
                        <td>{{ \Helper::getTotal(10, $cond) }}</td>
                        <td>{{ \Helper::getTotal(11, $cond) }}</td>
                        <td>{{ \Helper::getTotal(12, $cond) }}</td>
                        <td>{{ \Helper::getTotal(13, $cond) }}</td>
                        <td>{{ \Helper::getTotal(14, $cond) }}</td>
                        <td>{{ \Helper::getTotal(15, $cond) }}</td>
                        <td>{{ \Helper::getTotal(16, $cond) }}</td>
                        <td>{{ \Helper::getTotal(17, $cond) }}</td>
                        <td>{{ \Helper::getTotal(18, $cond) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@elseif(\Auth::user()->hasRole('operasional verifikator'))
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing mt-3">
    <div class="widget widget-chart-three">
        <div class="widget-heading">
            <div class="">
                <h5>Total Data Collection</h5>
            </div>
        </div>

        <div class="widget-content"
        style="min-height: 100px;padding: 0 20px;max-height: 500px;overflow-x: scroll;">
        <table class="table table-hover table-bordered" id="table-totalCollection" style="width:100%">
            <thead>
                <tr>
                    <th>Ditolak Verifikasi</th>
                    <th>Pengajuan Kembali Verifikasi CRI</th>
                    <th>Pending Verifikasi CRI</th>
                    <th>Diterima Verifikasi CRI</th>
                    <th>Terkirim ke Uker BRI</th>
                    <th>Sudah diproses BRI</th>
                    <th>Perbaikan BRI</th>
                    <th>Analisa&Verifikasi BRI</th>
                    <th>Putus Tolak BRI</th>
                    <th>Putus Terima BRI</th>
                    <th>Calon Debitur Membatalkan BRI</th>
                    <th>Akad Kredit BRI</th>
                    <th>Pencairan BRI</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ \Helper::getTotal(6, false) }}</td>
                    <td>{{ \Helper::getTotal(7, false) }}</td>
                    <td>{{ \Helper::getTotal(8, false) }}</td>
                    <td>{{ \Helper::getTotal(9, false) }}</td>
                    <td>{{ \Helper::getTotal(10, false) }}</td>
                    <td>{{ \Helper::getTotal(11, false) }}</td>
                    <td>{{ \Helper::getTotal(12, false) }}</td>
                    <td>{{ \Helper::getTotal(13, false) }}</td>
                    <td>{{ \Helper::getTotal(14, false) }}</td>
                    <td>{{ \Helper::getTotal(15, false) }}</td>
                    <td>{{ \Helper::getTotal(16, false) }}</td>
                    <td>{{ \Helper::getTotal(17, false) }}</td>
                    <td>{{ \Helper::getTotal(18, false) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
@else
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing mt-3">
    @if ($role == "Kantor Pusat" || $role == "Kantor Wilayah" || $role == "Kantor Cabang" || $role == "Kantor Cabang Pembantu" || $role == "Kantor Cabang Khusus")
    <div class="mb-2">
        <a href="{{url('api/download-dokumen/manual-book-bri')}}" class="btn btn-primary btn-sm">Download Manual Book BRI</a>
    </div>
    @endif
    <div class="widget widget-chart-three">
        <div class="widget-heading">
            <div class="">
                <h5>Total Data Collection</h5>
            </div>
        </div>

        <div class="widget-content"
        style="min-height: 100px;padding: 0 20px;max-height: 500px;overflow-x: scroll;">
        <table class="table table-hover table-bordered" id="table-totalCollection" style="width:100%">
            <thead>
                <tr>
                    <th>Terkirim ke Uker BRI</th>
                    <th>Sudah diproses BRI</th>
                    <th>Perbaikan BRI</th>
                    <th>Analisa&Verifikasi BRI</th>
                    <th>Putus Tolak BRI</th>
                    <th>Putus Terima BRI</th>
                    <th>Calon Debitur Membatalkan BRI</th>
                    <th>Akad Kredit BRI</th>
                    <th>Pencairan BRI</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ \Helper::getTotal(10) }}</td>
                    <td>{{ \Helper::getTotal(11) }}</td>
                    <td>{{ \Helper::getTotal(12) }}</td>
                    <td>{{ \Helper::getTotal(13) }}</td>
                    <td>{{ \Helper::getTotal(14) }}</td>
                    <td>{{ \Helper::getTotal(15) }}</td>
                    <td>{{ \Helper::getTotal(16) }}</td>
                    <td>{{ \Helper::getTotal(17) }}</td>
                    <td>{{ \Helper::getTotal(18) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
@endif
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing mt-3">
    <div class="widget widget-chart-three">
        <div class="widget-heading">
            <div class="">
                <h5 class="">Data Collection</h5>
            </div>
        </div>

        <div class="widget-content" style="min-height: 100px;padding: 0 20px;max-height: 500px;overflow-x: scroll;">
            <table class="table table-hover table-bordered" id="table-Datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Debitur</th>
                        <th>Nama Developer</th>
                        <th>Nama Project</th>
                        <th>Jenis Kredit</th>
                        <th>Unit Kerja</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @forelse($data as $d)

                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            {{ $d->nama_calon_debitur }}
                        </td>
                        <td>{{ $d->nama_developer }}</td>
                        <td>{{ $d->nama_project }}</td>
                        <td>{{ $d->jenis_kredit }}</td>
                        <td>
                            {{ $d->uker_kode == 1039? 'DKI Jakarta - Kantor Cabang Khusus': "{$d->unitKerja->kantorWilayah->kota} - {$d->unitKerja->nama}" }}
                        </td>
                        <td>
                            @if ($d->status_id == 1 && !$d->is_pengajuan)
                            {!! \Helper::badgeStatus(0) !!}
                            @else
                            {!! \Helper::badgeStatus($d->status_id) !!}
                            @endif
                        </td>
                        <td>
                            @if($role == 'superadmin' || $role == 'admin cri' || $role == 'operasional')
                            <a href="{{route('collection.aplikasi.custom_detail', $d->id)}}" class="btn btn-info btn-sm" target="_blank">Lihat Aplikasi</a>
                            @endif
                            @if ($role == 'operasional')
                            @if ($d->status_id == 1 && $d->is_pengajuan)
                            <a href="{{ route('operasional.collection.show', $d->id) }}"
                                class="edit btn btn-info btn-sm mr-1">Cek Dokumen</a>
                                @elseif($d->status_id == 2 || $d->status_id == 3 && $d->is_pengajuan)
                                <a href="{{ route('operasional.collection.show', $d->id) }}"
                                    class="edit btn btn-warning btn-sm mr-1">Cek Dokumen</a>
                                    @endif
                                    @if ($d->status_id > 3 && $d->status_id < 8 && $d->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                                    <a href="{{ route('operasional.collection.edit', $d->id) }}"
                                        class="edit btn btn-primary btn-sm">Cek Data</a>
                                        @else
                                        <a href="javascript:void" class="edit btn btn-primary btn-sm" disabled>Cek
                                        Data</a>
                                        @endif
                                        @elseif($role == 'operasional verifikator')
                                        @if ($d->jenis_kredit != 'KPR Subsidi FLPP (Fix Income)')
                                        @if ($d->status_id == 4 || $d->status_id == 7)
                                        <a href="{{ route('v_detail', $d->id) }}"
                                            class="edit btn btn-info btn-sm mr-1">Detail</a>
                                            @else
                                            <a href="javascript:void"
                                            class="edit btn btn-info btn-sm mr-1 disabled">Detail</a>
                                            @endif
                                            @elseif($d->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                                            @if ($d->status_id == 8 || $d->status_id == 7)
                                            <a href="{{ route('v_detail', $d->id) }}"
                                                class="edit btn btn-info btn-sm mr-1">Detail</a>
                                                @else
                                                <a href="javascript:void"
                                                class="edit btn btn-info btn-sm mr-1 disabled">Detail</a>
                                                @endif
                                                @endif
                                                @elseif($role == 'sales lepas' || $role == 'sales developer')
                                                <a href="{{ route('collection.aplikasi.show', $d->id) }}"
                                                    class="edit btn btn-info btn-sm mr-1">Lihat Aplikasi</a>
                                                    @else
                                                    -
                                                    @endif

                                                </td>
                                            </tr>

                                            @empty
                                            <tr>
                                                <td colspan="7">Tidak ada data</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endsection
