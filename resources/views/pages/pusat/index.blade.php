@extends('layouts.app')
@section('collection', 'active')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<div class="page-header">
    <div class="page-title">
        <h3>Pengajuan Kredit BRI</h3>
    </div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            @include('partials.filter-collection')
            <div class="table-responsive mb-4 mt-4">
                <table class="table table-hover table-bordered" id="table-Datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Debitur</th>
                            <th>Nama Developer</th>
                            <th>Jenis KPR</th>
                            <th>Tanggal Terkirim</th>
                            <th>Unit Kerja BRI</th>
                            <th>Status</th>
                            <th width="26%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('modals.ubah-status')
@include('modals.status-history')
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets/js/helper.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
@include('partials.alert')
<script>
    $(document).ready(function() {
        @if(\Session::has('err-get_file'))
        toastr["error"]('{{\Session::get('err-get_file')}}');
        @endif
        flatpickr('[name=filter_tanggal_mulai]', {
            dateFormat: "Y-m-d"
        })
        flatpickr('[name=filter_tanggal_selesai]', {
            dateFormat: "Y-m-d"
        })
        setTimeout(function() {
            $('#table-Datatable_filter').hide()
        }, 100);
        $('[name=filter_kanwil]').select2()
        $('[name=filter_kanca]').select2()
        $('[name=filter_status]').select2()
        $('[name=status]').select2({
            dropdownParent: $('#modalUbahStatus .modal-content')
        })
        $('[name=filter_jenis_kpr]').select2()
        var table = $('#table-Datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('bri.collection.dataTable') }}",
                data: function(d) {
                    d.filter_kanwil = $('[name=filter_kanwil]').find(':selected').val(),
                    d.filter_kanca = $('[name=filter_kanca]').find(':selected').val(),
                    d.filter_status = $('[name=filter_status]').find(':selected').val(),
                    d.filter_jenis_kpr = $('[name=filter_jenis_kpr]').find(':selected').val(),
                    d.filter_tanggal_mulai = $('[name=filter_tanggal_mulai]').val(),
                    d.filter_tanggal_selesai = $('[name=filter_tanggal_selesai]').val()
                }
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: function(row) {
                    return `${row.nama_calon_debitur}<br>${row.no_ktp}`
                }
            },
            {
                data: 'nama_developer',
                name: 'nama_developer'
            },
            {
                data: 'jenis_kredit',
                name: 'jenis_kredit'
            },
            {
                data: 'tgl_terkirim',
                name: 'tgl_terkirim'
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
            }
            ]
        });

        setTimeout(function(){
            historyBRI()
        }, 1000)

        $('body').on('click', '#btnShowModal', function() {
            $('[name=sel_nama_debitur]').val($(this).attr('data-nama_debitur'))
            $('[name=sel_no_ktp]').val($(this).attr('data-no_ktp'))
            $('[name=sel_nama_project]').val($(this).attr('data-nama_project'))
            $('[name=sel_kanwil]').val($(this).attr('data-kanwil'))
            $('[name=sel_kanca]').val($(this).attr('data-kanca'))
            $('[name=collection_id]').val($(this).attr('data-collection_id'))
            let status_id = $(this).attr('data-status_id')
            let nominal_cair = $(this).attr('data-nominal_cair')
            if (status_id > 15) {
                $('#div-nominal').show()
                $('#div-norek_kredit').show()
            } else {
                $('#div-nominal').hide()
                $('#div-norek_kredit').hide()
                $('[name=nominal_cair]').val(null)
                $('[name=norek_kredit]').val(null)
            }
            if (status_id == 11) {
                $('#div-alasan_perbaikan').show()
            } else {
                $('#div-alasan_perbaikan').hide()
            }

            if (status_id == 13) {
                $('#div-alasan_perbaikan').show()
                // $('#div-alasan_tolak').show()
            } else {
                $('#div-alasan_perbaikan').hide()
                $('#div-alasan_tolak').hide()
            }
            getStatus(status_id)
        })

        function getStatus(status_id = 11) {
            $.ajax({
                type: 'get',
                url: "{{ url('api/status') }}",
                data: {
                    status_id: status_id
                },
                beforeSend: function() {
                    $('[name=status]').prop('disabled', true)
                },
                success: function(data) {
                    console.log(data)
                    opt = ''
                    $.each(data.data, function(k, v) {
                        if (v.nama != "Draft") {
                            opt += `<option value=${v.id}>${v.nama}</option>`
                        }
                    })
                    $('[name=status]').prop('disabled', false).html(opt)
                },
                error: function(data) {
                    console.log(data.responseText)
                    var data = data.responseJSON;
                    if (data.status == "fail") {
                        toastr["error"](data.messages);
                    }
                }
            });
        }
        getKanwil()

        function getKanwil() {
            $.ajax({
                type: 'get',
                url: "{{ url('api/general/kota?is_kanwil=true') }}",
                data: {
                    adding_kck: true
                },
                beforeSend: function() {

                },
                success: function(data) {
                    console.log(data)
                    let opt = '<option value="">Pilih Kantor Wilayah</option>'
                    $.each(data.data, function(k, v) {
                        opt += `<option value=${v.id}>${v.kota}</option>`
                    })
                    $('[name=filter_kanwil]').html(opt)
                },
                error: function(data) {
                    var data = data.responseJSON;
                    if (data.status == "fail") {
                        toastr["error"](data.messages);
                    }
                }
            });
        }

        function getKanCa(kota_id = '') {
            $.ajax({
                type: 'get',
                url: "{{ url('api/general/kantor_cabang') }}",
                data: {
                    kota_id: kota_id
                },
                beforeSend: function() {

                },
                success: function(data) {
                    console.log(data)

                    if ($('[name=filter_kanwil]').find(':selected').text() !=
                        "Kantor Cabang Khusus") {
                        let opt = '<option value="">Pilih Unit Kerja BRI</option>'
                    $.each(data.data, function(k, v) {
                        opt += `<option value=${v.kode}>${v.nama}</option>`

                        if (v.kcp.length > 0) {
                            $.each(v.kcp, function(k2, v2) {
                                opt +=
                                `<option value=${v2.kode}>&nbsp;&nbsp;&nbsp;&nbsp;${v2.nama}</option>`
                            })
                        }
                    })
                    $('[name=filter_kanca]').prop('disabled', false).html(opt)
                } else {
                    let opt = '<option value="">Tidak memiliki Unit Kerja BRI</option>'
                    $('[name=filter_kanca]').prop('disabled', true).html(opt)
                }

            },
            error: function(data) {
                var data = data.responseJSON;
                if (data.status == "fail") {
                    toastr["error"](data.messages);
                }
            }
        });
        }

        getStatusFilter()

        function getStatusFilter() {
            $.ajax({
                type: 'get',
                url: "{{ url('api/status') }}",
                data: {
                    id: 0
                },
                beforeSend: function() {

                },
                success: function(data) {
                    let opt = '<option value="">Pilih Status</option>'
                    $.each(data.data, function(k, v) {
                        if (v.id > 9) {
                            opt += `<option value=${v.id}>${v.nama}</option>`
                        }
                    })
                    $('[name=filter_status]').html(opt)
                },
                error: function(data) {
                    var data = data.responseJSON;
                    if (data.status == "fail") {
                        toastr["error"](data.messages);
                    }
                }
            });
        }

        $('#form-ubahstatus').submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });

            $.ajax({
                type: 'post',
                url: $(this).attr("action"),
                data: $(this).serialize(),
                beforeSend: function() {
                    loadButton($('#btnUbahStatus'))
                },
                success: function(data) {
                    table.ajax.reload()
                    if (data.status == "ok") {
                        toastr["success"](data.messages);
                    }
                    $('#modalUbahStatus').modal('hide')
                },
                error: function(data) {
                    console.log(data.responseText)
                    var data = data.responseJSON;
                    if (data.status == "fail") {
                        toastr["error"](data.messages);
                    }
                },
                complete: function() {
                    loadButton($('#btnUbahStatus'), false, 'Ubah Status')
                }
            });
        })

        $('body').on('change', '[name=status]', function() {
            let status = $(this).find(':selected').text()
            if (status == "Pencairan BRI") {
                $('#div-nominal').show()
                $('#div-norek_kredit').show()
            } else {
                $('#div-nominal').hide()
                $('#div-norek_kredit').hide()
                $('[name=nominal_cair]').val(null)
                $('[name=norek_kredit]').val(null)
            }

            if (status == "Perbaikan BRI") {
                $('#div-alasan_perbaikan').show()
            } else {
                $('#div-alasan_perbaikan').hide()
            }

            if (status == "Putus Tolak BRI") {
                $('#div-alasan_tolak').show()
            } else {
                $('#div-alasan_tolak').hide()
            }
        })
        $('body').on('change', '[name=filter_kanwil]', function() {
            let val = $(this).find(':selected').val()
            console.log(val)
            getKanCa(val)
            table.draw()
        })

        $('body').on('change', '[name=filter_kanca]', function() {
            console.log($(this).val())
            table.draw()
        })
        $('body').on('change', '[name=filter_status]', function() {

            table.draw()
        })

        $('body').on('change', '[name=filter_jenis_kpr]', function() {
            table.draw()
        })
        $('body').on('change', '[name=filter_tanggal_mulai]', function() {
            table.draw()
        })
        $('body').on('change', '[name=filter_tanggal_selesai]', function() {
            console.log($(this).val())
            table.draw()
        })

        $('body').on('input', '[name=nominal_cair]', function() {
            let _val = $(this).val()
            $(this).val(formatRp(_val))
        })
    })
</script>
@endsection
