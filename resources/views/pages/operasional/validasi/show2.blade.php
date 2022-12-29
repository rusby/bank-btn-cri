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
                <div class="widget-content widget-content-area">
                    <ul class="nav nav-tabs" id="border-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#tab-dokumenutama" role="tab"
                                aria-selected="true">Dokumen Utama</a>
                        </li>
                        @if ($data->dokumenUtama->dokumenUtamaLainnya()->exists())
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#tab-dokumenutamalainnya" role="tab"
                                    aria-selected="false">Tambahan Dokumen Utama</a>
                            </li>
                        @endif
                        @if($data->developer()->exists())
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#tab-dokumendeveloper" role="tab" aria-selected="false">Dokumen Legalitas Agunan</a>
                        </li>
                        @endif
                        @if ($data->dokumenUtamaTambahan->dokumenTambahanLainnya()->exists())
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#tab-tambahanformsubsidilainnya"
                                    role="tab" aria-selected="false">Tambahan Dokumen Tambahan Form Subsidi</a>
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
                                            <th>Ktp pengajuan</th>
                                            <th>Ktp pasangan</th>
                                            <th>Npwp</th>
                                            <th>Kartu keluarga</th>
                                            <th>Akta nikah</th>
                                            <th>Keterangan belum nikah</th>
                                            <th>Copy sk pegawai tetap</th>
                                            <th>Asli sk aktif bekerja</th>
                                            <th>Asli slip gaji</th>
                                            <th>Asli rekening koran</th>
                                            <th>Copy spt terakhir</th>
                                            <th>Spr dari developer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->ktp_pengajuan)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->ktp_pengajuan) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->ktp_pengajuan) }}"
                                                        target="_blank">
                                                        <img class="img-thumbnail"
                                                            src="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->ktp_pengajuan) }}"
                                                            alt="" style="max-width: 130px;height: 80px">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->ktp_pasangan)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->ktp_pasangan) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->ktp_pasangan) }}"
                                                        target="_blank">
                                                        <img class="img-thumbnail"
                                                            src="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->ktp_pasangan) }}"
                                                            alt="" style="max-width: 130px;height: 80px">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->npwp)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->npwp) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->npwp) }}"
                                                        target="_blank">
                                                        <img class="img-thumbnail"
                                                            src="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->npwp) }}"
                                                            alt="" style="max-width: 130px;height: 80px">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->kartu_keluarga)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->kartu_keluarga) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->kartu_keluarga) }}"
                                                        target="_blank">
                                                        <img class="img-thumbnail"
                                                            src="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->kartu_keluarga) }}"
                                                            alt="" style="max-width: 130px;height: 80px">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->akta_nikah)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->akta_nikah) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->akta_nikah) }}"
                                                        target="_blank">
                                                        <img class="img-thumbnail"
                                                            src="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->akta_nikah) }}"
                                                            alt="" style="max-width: 130px;height: 80px">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->dokumenUtama->keterangan_belum_nikah)

                                                    @if (explode('.', $data->dokumenUtama->keterangan_belum_nikah)[1] == 'pdf')
                                                        <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->keterangan_belum_nikah) }}"
                                                            style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                            target="_blank">Lihat Dokumen</a>
                                                    @else
                                                        <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->keterangan_belum_nikah) }}"
                                                            style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                            target="_blank">Lihat Dokumen</a>
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->copy_sk_pegawai_tetap)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->copy_sk_pegawai_tetap) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a
                                                        href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->copy_sk_pegawai_tetap) }}">
                                                        <img class="img-thumbnail"
                                                            src="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->copy_sk_pegawai_tetap) }}"
                                                            alt="" style="max-width: 130px;height: 80px">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->asli_sk_aktif_bekerja)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->asli_sk_aktif_bekerja) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a
                                                        href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->asli_sk_aktif_bekerja) }}">
                                                        <img class="img-thumbnail"
                                                            src="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->asli_sk_aktif_bekerja) }}"
                                                            alt="" style="max-width: 130px;height: 80px">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->asli_slip_gaji)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->asli_slip_gaji) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->asli_slip_gaji) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->asli_rekening_koran)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->asli_rekening_koran) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->asli_rekening_koran) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @endif
                                            </td>
                                            <td>
                                                -
                                            </td>
                                            <td>
                                                @if (explode('.', $data->dokumenUtama->spr_dari_developer)[1] == 'pdf')
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->spr_dari_developer) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @else
                                                    <a href="{{ \Helper::showImage($data->dokumenUtama->folder, $data->dokumenUtama->spr_dari_developer) }}"
                                                        style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                        target="_blank">Lihat Dokumen</a>
                                                @endif
                                            </td>
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
                                            @foreach ($data->dokumenUtama->dokumenUtamaLainnya as $lain)
                                                <th>{{ $lain->nama_file }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($data->dokumenUtama->dokumenUtamaLainnya as $lain)
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
                        @if($data->developer()->exists())
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
                                                <a href="{{ \Helper::showImage($data->developer->project->folder, $data->developer->project->files_slf) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ \Helper::showImage($data->developer->project->folder, $data->developer->project->files_imb) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ \Helper::showImage($data->developer->project->folder, $data->developer->project->files_pbb) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ \Helper::showImage($data->developer->project->folder, $data->developer->project->files_sertifikat) }}"
                                                    style="color: #0f7ef7;font-weight: 600;text-decoration: underline"
                                                    target="_blank">Lihat Dokumen
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-md-12 mb-3">
                                            <label for="inputEmail4">Alasan Tolak</label>
                                            <textarea class="form-control" rows="3" name="alasan_tolak_verifikasi"
                                                placeholder="Masukkan alasan jika ingin menolak"></textarea>
                                        </div>
                    <form action="{{ route('v_detail.update', $data->id) }}" method="POST" id="form-verifikasi-collection">
                        @csrf
                        <input type="hidden" name="status">
                        <div class="widget-content widget-content-area">
                            @if (($data->status_id == 6 && $data->alasan_tolak_verifikasi) || $data->status_id == 7)
                                <div class="alert alert-danger">
                                    <b>{{ $data->alasan_tolak_verifikasi }}</b>
                                </div>
                            @endif
                            @if (($data->status_id == 6 && $data->sanggah_tolak_verifikasi) || $data->status_id == 7)
                                <div class="alert alert-info">
                                    <b>{{ $data->sanggah_tolak_verifikasi }}</b>
                                </div>
                            @endif
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
                            location.reload()
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
