@extends('layouts.app')
@section('operasional.collection', 'active')
@section('content')
<style>
    .dokumendiTolak{
        border: 2px solid #ef5151;
    }
</style>
<div class="page-header">
    <div class="page-title">
        <h3>Verifikasi Collection Files</h3>
    </div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <form action="{{ route('operasional.collection.update', $data->id) }}" method="POST"
                id="form-verifikasi-collection">
                @csrf
                @method('PUT')
                <input type="hidden" name="status">
                <div class="widget-content widget-content-area">
                    @if ($data->alasan_tolak)
                    @foreach($data->historyStatus as $h)
                    @if($h->status_id == 2)
                    <p class="mb-0">Tanggal alasan perbaikan oleh operasional : {{$h->created_at}} </p>
                    @endif
                    @endforeach
                    <div class="alert alert-danger">
                        <b>{{ $data->alasan_tolak }}</b>
                    </div>
                    @endif
                    @if ($data->status_id == 3 && $data->sanggah_tolak)

                    @foreach($data->historyStatus as $h)
                    @if($loop->last && $h->status_id == 3)
                    <p class="mb-0">Tanggal keterangan perbaikan oleh marketing : {{$h->created_at}} </p>
                    @endif
                    @endforeach
                    
                    <div class="alert alert-info">
                        <b>{{ $data->sanggah_tolak }}</b>
                    </div>
                    @endif

                    @if ($data->alasan_tolak_verifikasi && $data->jenis_kredit != 'KPR Subsidi FLPP (Fix Income)')
                    <div class="alert alert-danger">
                        <b>{{ $data->alasan_tolak_verifikasi }}</b>
                    </div>
                    @endif
                    @if ($data->status_id == 6 && $data->sanggah_tolak_verifikasi)
                    <div class="alert alert-info">
                        <b>{{ $data->sanggah_tolak_verifikasi }}</b>
                    </div>
                    @endif

                    @if ($data->alasan_perbaikan_bri)
                    <div class="alert alert-warning">
                        <p>Alasan perbaikan BRI : </p>
                        <b>{{ $data->alasan_perbaikan_bri }}</b>
                    </div>
                    @endif
                    @if ($data->alasan_tolak_bri)
                    <div class="alert alert-danger">
                        <p>Alasan tolak BRI : </p>
                        <b>{{ $data->alasan_tolak_bri }}</b>
                    </div>
                    @endif
                    <div class="my-4">
                        <div class="form-row">
                            <div class="col-md-12">
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
                                            <td>{{$data->userCreated->name}}</td>
                                            <td>{{$data->userCreated->email}}</td>
                                            <td>{{$data->userCreated->no_hp}}</td>
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
                                            <td>{{$data->nama_calon_debitur}}</td>
                                            <td>{{$data->nama_developer}}</td>
                                            <td>{{$data->nama_project}}</td>
                                            <td>{{$data->jenis_kredit}}</td>
                                            <td>
                                                {{ $data->uker_kode == 1039 ? "DKI Jakarta - Kantor Cabang Khusus" : "{$data->unitKerja->kantorWilayah->kota} - {$data->unitKerja->nama}" }}
                                            </td>
                                            <td>{!! \Helper::badgeStatus($data->status_id) !!}</td>
                                        </tr>
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
                                            <h6>Dokumen Utama</h6>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    @include('partials.tr-dokumen', ['label' => 'Form Permohonan KPR', 'fix' => 'form_permohonan_kpr'])
                                    @include('partials.tr-dokumen', ['label' => 'SPR(Surat Pemesanan Rumah) dari Developer', 'fix' => 'spr_dari_developer'])
                                    @if($data->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                                    @include('partials.tr-dokumen', ['label' => 'Screenshoot Pengajuan di Sikasep', 'fix' => 'dokumen_pengajuan_sikasep'])
                                    @endif
                                    @include('partials.tr-dokumen', ['label' => 'Kartu Keluarga', 'fix' => 'kartu_keluarga'])
                                    @include('partials.tr-dokumen', ['label' => 'KTP Pengajuan', 'fix' => 'ktp_pengajuan'])
                                    @if($data->status_pernikahan == "Menikah")
                                    @include('partials.tr-dokumen', ['label' => 'KTP Pasangan', 'fix' => 'ktp_pasangan'])
                                    @include('partials.tr-dokumen', ['label' => 'Akta Nikah', 'fix' => 'akta_nikah'])

                                    @if($data->is_pasangan_meninggal == 1)
                                    @include('partials.tr-dokumen', ['label' => 'Surat Kematian Pasangan', 'fix' => 'surat_kematian_pasangan'])
                                    @endif

                                    @elseif($data->status_pernikahan == "Belum Menikah")
                                    @include('partials.tr-dokumen', ['label' => 'Keterangan Belum Menikah', 'fix' => 'keterangan_belum_nikah'])
                                    @else
                                    @include('partials.tr-dokumen', ['label' => 'Surat Cerai', 'fix' => 'surat_cerai'])
                                    @endif

                                    @include('partials.tr-dokumen', ['label' => 'NPWP', 'fix' => 'npwp'])

                                    @if($data->jenis_pekerjaan == "Pegawai" || is_null($data->jenis_pekerjaan))
                                    @include('partials.tr-dokumen', ['label' => 'Surat Keterangan Pengangkatan Pegawai Tetap', 'fix' => 'copy_sk_pegawai_tetap'])
                                    @include('partials.tr-dokumen', ['label' => 'SK Aktif Bekerja', 'fix' => 'asli_sk_aktif_bekerja'])
                                    @include('partials.tr-dokumen', ['label' => 'Slip Gaji Periode 3 Bulan Terakhir', 'fix' => 'asli_slip_gaji'])
                                    @endif
                                    @include('partials.tr-dokumen', ['label' => 'Rekening Koran', 'fix' => 'asli_rekening_koran'])
                                    @include('partials.tr-dokumen', ['label' => 'SPT Pajak Tahun Terakhir', 'fix' => 'spt_pajak_penghasilan'])

                                    @if($data->jenis_pekerjaan == "Profesional")
                                    @include('partials.tr-dokumen', ['label' => 'Suat Izin Profesi', 'fix' => 'surat_izin_profesi'])
                                    @endif
                                    @if($data->jenis_pekerjaan == "Wiraswasta")
                                    @include('partials.tr-dokumen', ['label' => 'Izin Usaha (SIUP,TDP,SITU,dll)', 'fix' => 'izin_usaha'])
                                    @include('partials.tr-dokumen', ['label' => 'Akta Pendirian Perusahaan(minimal telah berjalan 3 tahun)', 'fix' => 'akta_pendirian_perusahaan'])
                                    @endif

                                    @if ( $data->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)' && $data->dokumenUtama->dokumenUtamaLainnya()->exists())
                                    <tr style="background-color: #dfdede">
                                        <td colspan="2">
                                            <h6>Dokumen Utama Lainnya</h6>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    @foreach ($data->dokumenUtama->dokumenUtamaLainnya as $key => $v)
                                    @if (!$v->lolos)
                                    @if ($data->status_id == 2 || $data->status_id == 3)
                                    <tr id="tr-lainnya" style="border: 2px solid #ef5151">
                                        @endif
                                        @else
                                        <tr id="tr-lainnya">
                                            @endif
                                            <td>{{ $v->nama_file }}</td>
                                            <td>
                                                <?php $ext = explode('.', $v->files->name); ?>
                                                @if (count($ext) > 1)
                                                @if ($ext[1] == 'pdf')
                                                <a href="{{ \Helper::showImage($v->files->folder, $v->files->name) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen</a>
                                                    @else
                                                    <a href="{{ \Helper::showImage($v->files->folder, $v->files->name) }}"
                                                        target="_blank">
                                                        <img class="img-thumbnail"
                                                        src="{{ \Helper::showImage($v->files->folder, $v->files->name) }}"
                                                        alt="" style="max-width: 150px;">
                                                    </a>
                                                    @endif
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                                        <label
                                                        class="new-control new-checkbox checkbox-outline-primary">
                                                        <input type="checkbox" class="new-control-input"
                                                        value="{{ $v->id }}"
                                                        id="{{ 'dokumenLainnya' . $key }}"
                                                        name="dokumen_lain[]"
                                                        {{ $v->lolos ? 'checked' : '' }}>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @if ( $data->jenis_kredit != 'KPR Subsidi FLPP (Fix Income)' && $data->dokumenUtama->dokumenUtamaLainnya()->exists())
                            <div class="col-md-6">
                                <table class="table table-hover table-bordered table-sm" id="table-Datatable"
                                style="width:100%;">
                                <tbody>                                            
                                    <tr style="background-color: #dfdede">
                                        <td colspan="2">
                                            <h6>Dokumen Utama Lainnya</h6>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    @foreach ($data->dokumenUtama->dokumenUtamaLainnya as $key => $v)
                                    @if (!$v->lolos)
                                    @if ($data->status_id == 2 || $data->status_id == 3)
                                    <tr id="tr-lainnya" style="border: 2px solid #ef5151">
                                        @endif
                                        @else
                                        <tr id="tr-lainnya">
                                            @endif
                                            <td>{{ $v->nama_file }}</td>
                                            <td>
                                                <?php $ext = explode('.', $v->files->name); ?>
                                                @if (count($ext) > 1)
                                                @if ($ext[1] == 'pdf')
                                                <a href="{{ \Helper::showImage($v->files->folder, $v->files->name) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen</a>
                                                    @else
                                                    <a href="{{ \Helper::showImage($v->files->folder, $v->files->name) }}"
                                                        target="_blank">
                                                        <img class="img-thumbnail"
                                                        src="{{ \Helper::showImage($v->files->folder, $v->files->name) }}"
                                                        alt="" style="max-width: 150px;">
                                                    </a>
                                                    @endif
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                                        <label
                                                        class="new-control new-checkbox checkbox-outline-primary">
                                                        <input type="checkbox" class="new-control-input"
                                                        value="{{ $v->id }}"
                                                        id="{{ 'dokumenLainnya' . $key }}"
                                                        name="dokumen_lain[]"
                                                        {{ $v->lolos ? 'checked' : '' }}>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            @if($data->jenis_kredit == 'KPR Subsidi FLPP (Fix Income)')
                            <div class="col-md-6">
                                <table class="table table-hover table-bordered table-sm" id="table-Datatable"
                                style="width:100%;">
                                <tbody>
                                    <tr style="background-color: #dfdede">
                                        <td colspan="2">
                                            <h6>Dokumen Tambahan Form Subsidi</h6>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    @include('partials.tr-dokumen', ['label' => 'Surat Pernyataan Pemohon', 'fix' => 'surat_pernyataan_pemohon', 'dokumen_tambahan' => true])
                                    @include('partials.tr-dokumen', ['label' => 'Surat Pernyataan Status Kepemilikan Rumah', 'fix' => 'surat_status_kepemilikan_rumah', 'dokumen_tambahan' => true])
                                    @include('partials.tr-dokumen', ['label' => 'Surat Keterangan / Pernyataan Penghasilan', 'fix' => 'surat_pernyataan_penghasilan', 'dokumen_tambahan' => true])
                                    @include('partials.tr-dokumen', ['label' => 'Surat Pernyataan Verifikasi', 'fix' => 'surat_pernyataan_verifikasi', 'dokumen_tambahan' => true])
                                    @include('partials.tr-dokumen', ['label' => 'Surat Keterangan Belum Memiliki Rumah', 'fix' => 'surat_pernyataan_belum_memiliki_rumah', 'dokumen_tambahan' => true])

                                    @if ($data->dokumenUtamaTambahan->dokumenTambahanLainnya()->exists())
                                    <tr style="background-color: #dfdede">
                                        <td colspan="2">
                                            <h6>Dokumen Tambahan Lainnya</h6>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    @foreach ($data->dokumenUtamaTambahan->dokumenTambahanLainnya as $key => $v)
                                    @if (!$v->lolos)
                                    @if ($data->status_id == 2 || $data->status_id == 3)
                                    <tr id="tr-lainnya" style="border: 2px solid #ef5151">
                                        @endif
                                        @else
                                        <tr id="tr-lainnya">
                                            @endif
                                            <td>{{ $v->nama_file }}</td>
                                            <td>
                                                <?php $ext = explode('.', $v->files->name); ?>
                                                @if ($ext[1] == 'pdf')
                                                <a href="{{ \Helper::showImage($v->files->folder, $v->files->name) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen</a>
                                                    @else
                                                    <a href="{{ \Helper::showImage($v->files->folder, $v->files->name) }}"
                                                        target="_blank">
                                                        <img class="img-thumbnail"
                                                        src="{{ \Helper::showImage($v->files->folder, $v->files->name) }}"
                                                        alt="" style="max-width: 150px;">
                                                    </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="n-chk new-checkbox checkbox-outline-primary">
                                                        <label
                                                        class="new-control new-checkbox checkbox-outline-primary">
                                                        <input type="checkbox" class="new-control-input"
                                                        value="{{ $v->id }}"
                                                        id="{{ 'dokumenLainnya' . $key }}"
                                                        name="dokumen_tambahan_lain[]"
                                                        {{ $v->lolos ? 'checked' : '' }}>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            <div class="form-group col-md-12 mb-3">
                                <label for="inputEmail4">Alasan Perbaikan</label>
                                <textarea class="form-control" rows="3" name="alasan_tolak" placeholder="Masukkan alasan jika ingin perbaikan data"></textarea>
                            </div>
                            @if($data->status_id == 2)
                            <div class="alert alert-warning col-md-12">
                                <b>Status pengajuan aplikasi harus "Pengajuan Kembali Berkas" untuk melanjutkan proses. Silakan hubungi kontak marketing yang tertera diatas untuk kelengkapan berkas nya.</b>
                            </div>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('operasional.collection.index') }}"
                    class="btn btn-warning mx-2 my-2">Kembali</a>
                    <button type="submit" class="btn btn-success mx-2 my-2 float-right" {{$data->status_id == 2 ? 'disabled' : ''}} >Terima</button>
                    <a class="btn btn-danger mx-2 my-2 float-right" id="btnTolak" style="opacity: {{$data->status_id == 2 ? '.65' : ''}}" {{$data->status_id == 2 ? 'disabled' : ''}} >Tolak</a>
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

                    // let allCheckbox = $('[name^=keterangan_]').not(":disabled").length + $('[name^=dokumen_lain]')
                    //     .not(":disabled").length + $('[name^=dokumen_tambahan_lain]').not(":disabled").length
                    // let selCheckbox = $('[name^=keterangan_]:checked').not(":disabled").length + $(
                    //     '[name^=dokumen_lain]:checked').not(":disabled").length + $(
                    //     '[name^=dokumen_tambahan_lain]:checked').not(":disabled").length
                    let allCheckbox = $('[name^=keterangan_]').length + $('[name^=dokumen_lain]')
                    .length + $('[name^=dokumen_tambahan_lain]').length
                    let selCheckbox = $('[name^=keterangan_]:checked').length + $(
                        '[name^=dokumen_lain]:checked').length + $(
                        '[name^=dokumen_tambahan_lain]:checked').length
                        console.log(`${allCheckbox}++${selCheckbox}`)
                        if (selCheckbox < allCheckbox) {
                            toastr["error"]("Masih ada data yang belum lolos.");
                            return
                        }
                    } else {
                        $('[name=status]').val('ditolak')
                        if ($('[name=alasan_tolak]').val() == "") {
                            toastr["error"]("Keterangan penolakan belum diisi.");
                            return
                        }

                    }

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
                                window.location.href = "/operasional/collection";
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
                                    'Terima')
                                return
                            }

                            loadButton($('#form-verifikasi-collection #btnTolak'), false, 'Tolak')
                        },
                        complete: function() {
                            if (is_terima) {
                                loadButton($('#form-verifikasi-collection button[type=submit]'), false,
                                    'Terima')
                                return
                            }

                            loadButton($('#form-verifikasi-collection #btnTolak'), false, 'Tolak')
                        }
                    });
                }

                $('#form-verifikasi-collection').submit(function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Anda yakin ingin menerima data ini ?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Terima !'
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
                        title: 'Anda yakin ingin menolak data ini ?',
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
