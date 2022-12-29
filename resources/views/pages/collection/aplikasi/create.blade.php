@extends('layouts.app')
@section('collection.aplikasi', 'active')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
    <div class="page-header">
        <div class="page-title">
            <h3>Pengajuan Aplikasi</h3>
        </div>
    </div>
    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area simple-pills">
                    <!-- <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                                                                        aria-controls="pills-home" aria-selected="true">Mapping Name</a>
                                                                </li>
                                                            </ul> -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <form action="{{ url('collection/mapping-name') }}" method="POST"
                                enctype="multipart/form-data" id="form-mapping_name">
                                @csrf
                                <div class="widget-content widget-content-area">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Nama Calon Debitur / Pembeli</label>
                                            <input type="text" class="form-control"
                                                placeholder="Masukkan nama calon debitur" name="nama_calon_debitur">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>No KTP Calon Debitur / Pembeli</label>
                                            <input type="number" class="form-control" placeholder="Masukkan no ktp"
                                                name="no_ktp" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>No Handphone Calon Debitur / Pembeli</label>
                                            <input type="number" class="form-control" placeholder="Masukkan no hp debitur"
                                                name="no_telp_debitur" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Status Pernikahan Calon Debitur / Pembeli</label>
                                            <select name="status_pernikahan" class="form-control">
                                                <?php $status = ['Menikah', 'Belum Menikah', 'Cerai']; ?>
                                                <option value="">Pilih Status Pernikahan</option>
                                                @foreach ($status as $s)
                                                    <option value="{{ $s }}">{{ $s }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" id="div-pasangan_meninggal" style="display: none;">
                                            <label>Pasangan Meninggal Dunia ? </label>
                                            <select name="is_pasangan_meninggal" class="form-control">
                                                <?php $data = [0, 1]; ?>
                                                <option value="">Pilih</option>
                                                @foreach ($data as $d)
                                                    <option value="{{ $d }}">{{ $d == 0 ? 'Tidak' : 'Ya' }}
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
                                                    <option value="{{ $d }}">{{ $d }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Jenis Sub Kredit(khusus tapera)</label>
                                            <select name="jenis_sub_kredit" class="form-control">
                                                <?php $data = ['KPR', 'KBR', 'KRR']; ?>
                                                <option value="">Pilih Jenis Sub Kredit</option>
                                                @foreach ($data as $d)
                                                    <option value="{{ $d }}">{{ $d }}</option>
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
                                        <div class="form-group col-md-3" id="div-jenis_pekerjaan" style="display: none;">
                                            <label>Jenis Pekerjaan</label>
                                            <select name="jenis_pekerjaan" class="form-control">
                                                <?php $data = ['Wiraswasta', 'Pegawai', 'Profesional']; ?>
                                                <option value="">Pilih Jenis Pekerjaan</option>
                                                @foreach ($data as $d)
                                                    <option value="{{ $d }}">{{ $d }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Nama Developer / Perusahaan</label>
                                            <input type="text" class="form-control" placeholder="Masukkan Nama Developer"
                                                name="nama_developer">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>No Telepon Developer</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan no telpon developer" name="no_telp_developer" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13">
                                        </div>
                                        <div class="form-group col-md-4" style="margin-top: -38px;">
                                            <label>Nama Project / Perumahan</label>
                                            <span style="color: red;font-size: 12px;display: inline-block;">Khusus FLPP Penulisan Wajib sama dengan Inputan Sikasep</span>
                                            <input type="text" class="form-control"
                                                placeholder="Masukkan nama project perumahan" name="nama_project">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Alamat Project Perumahan</label>
                                            <textarea name="alamat_project" rows="3" class="form-control"
                                                placeholder="Masukkan alamat project perumahan"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6" id="div-permohonan_kredit" style="display: none;">
                                            <label>Jumlah Permohonan Kredit</label>
                                            <input type="text" class="form-control"
                                                placeholder="Masukkan Jumlah Permohonan Kredit"
                                                name="jumlah_permohonan_kredit">
                                        </div>
                                    </div>

                                    <a href="{{ route('collection.aplikasi.index') }}"
                                        class="btn btn-warning mx-2 my-2">Kembali</a>
                                    <button type="submit" class="btn btn-success mx-2 my-2 float-right">Simpan</button>
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
    @include('partials.alert')
    <script>
        $(document).ready(function() {
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

            $('[name=jenis_pekerjaan]').select2()
            $('[name=jenis_sub_kredit]').select2()
            $('[name=is_pasangan_meninggal]').select2()
            $('[name=status_pernikahan]').select2()
            $('[name=jenis_kredit]').select2()
            $('[name=provinsi_id]').select2()
            $('[name=kantor_cabang]').select2()
            $('[name=pasan]').select2()

            $('body').on('input', '[name=jumlah_permohonan_kredit]', function() {
                let _val = $(this).val()
                $(this).val(formatRp(_val))
            })

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

            $('body').on('change', '[name=provinsi_id]', function() {
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

            getProvinsi()

            function getProvinsi(selected_id = '') {
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
                        $('[name=provinsi_id]').html(opt)
                    },
                    error: function(data) {
                        var data = data.responseJSON;
                        if (data.status == "fail") {
                            toastr["error"](data.messages);
                        }
                    }
                });
            }

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
                                        `<option value=${v2.kode}>&nbsp;&nbsp;&nbsp;&nbsp;${v2.nama}</option>`
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

            $('#form-mapping_name').submit(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
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
                        loadButton($('button[type=submit]'))
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.status == "ok") {
                            toastr["success"](data.messages);
                        }
                        localStorage.setItem("{{\Auth::user()->id}}", "1")
                        setTimeout(function() {
                            window.location.href =
                                `/collection/aplikasi/${data.file.id}/edit`
                        }, 1500);
                    },
                    error: function(data) {
                        console.log(data.responseText)
                        var data = data.responseJSON;
                        if (data.status == "fail") {
                            toastr["error"](data.messages);
                        }
                    },
                    complete: function() {
                        loadButton($('button[type=submit]'), false, 'Simpan')
                    }
                });
            })
        })
    </script>
@endsection
