@extends('layouts.app')
@section('dashboard', 'active')
@section('content')
    <div class="page-header">
        <div class="page-title">
            <h3>Dashboard {{ ucfirst(\Auth::user()->getRoleNames()[0]) }}</h3>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(0) }}</h6>
                            <p class="">Draft</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(1) }}</h6>
                            <p class="">Belum dicek</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(2) }}</h6>
                            <p class="">Berkas Tidak Lengkap</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(3) }}</h6>
                            <p class="">Pengajuan Kembali Berkas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(4) }}</h6>
                            <p class="">Selesai Pengecekan Berkas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(10) }}</h6>
                            <p class="">Terkirim ke Uker BRI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(11) }}</h6>
                            <p class="">Sudah Diproses BRI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(12) }}</h6>
                            <p class="">Analisa dan Verifikasi BRI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(13) }}</h6>
                            <p class="">Ditolak BRI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(14) }}</h6>
                            <p class="">Diterima BRI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(15) }}</h6>
                            <p class="">Akad Kredit BRI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 pr-0 mb-2">
            <div class="widget widget-card-four" style="min-height: 150px;">
                <div class="widget-content">
                    <div class="w-content">
                        <div class="w-info">
                            <h6 class="value">{{ \Helper::getTotal(16) }}</h6>
                            <p class="">Pencairan BRI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('modals.status-history')
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing mt-3">
            <div class="widget widget-chart-three">
                <div class="widget-heading">
                    <div class="">
                        <h5 class="">List Pengajuan Aplikasi</h5>
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
                                        @if ($d->status_id == 7 || $d->status_id == 8)
                                            <a href="{{ route('v_detail', $d->id) }}" style="color: #007bff !important">
                                                {{ $d->nama_calon_debitur }}
                                            </a>
                                        @else
                                            {{ $d->nama_calon_debitur }}
                                        @endif
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
                                        @if ($d->status_id == 1 && !$d->is_pengajuan)
                                            <a href="{{ route('collection.aplikasi.edit', $d->id) }}"
                                                class="edit btn btn-warning btn-sm mr-1">Lanjutkan</a>
                                        @elseif($d->status_id == 2)
                                            <a href="{{ route('collection.aplikasi.edit', $d->id) }}"
                                                class="edit btn btn-warning btn-sm mr-1">Perbaikan Berkas</a>
                                        @endif
                                        <a href="{{ route('collection.aplikasi.show', $d->id) }}"
                                            class="edit btn btn-info btn-sm mr-1">Lihat Aplikasi</a>
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm mb-1" id="btnHistory"
                                            data-id="{{ $d->id }}">History Status</a>
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
    @endsection
    @section('js')
        <script>
            $('body').on('click', '[id=btnHistory]', function() {
                $('#modalHistory').modal('show')
                let id = $(this).attr('data-id')
                $.ajax({
                    type: 'get',
                    url: '{{ url('api/status/history') }}',
                    data: {
                        collection_id: id
                    },
                    beforeSend: function() {
                        $('div .timeline-line').html('<h6>Load data ...</h6>')
                    },
                    success: function(data) {

                        cont = ''
                        $.each(data.data, function(k, v) {
                            cont += `<div class="item-timeline">
                        <p class="t-time" style="font-size: 13px;">${v.created_at}</p>
                        <div class="t-dot t-dot-${v.status.id == 2 || v.status.id == 6 || v.status.id == 13 || v.status.id == 15 ? 'danger' : v.status.id  > 9 ? 'success' : 'primary'  }">
                        </div>
                        <div class="t-text">
                        <p>${v.status.nama}</p>
                        <p class="t-meta-time" style="max-width: 200px;">${v.user.name}</p>
                        </div>
                        </div>`
                        })
                        $('div .timeline-line').html(cont)
                    },
                    error: function(data) {
                        console.log(data.responseText)
                        var data = data.responseJSON;
                        if (data.status == "fail") {
                            toastr["error"](data.messages);
                        }
                    }
                });
            })
        </script>
    @endsection