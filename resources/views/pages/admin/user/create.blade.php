@extends('layouts.app')
@section('admin.user', 'active')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
    <div class="page-header">
        <div class="page-title">
            <h3>Tambah User</h3>
        </div>
    </div>
    <div class="row layout-top-spacing" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <form action="{{ route('admin.user.store') }}" method="POST" id="form-store-user"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="widget-content widget-content-area">
                        <h4>Tambah User</h4>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Password</label>
                                <input type="Password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Role</label>
                                <select name="nama_role" class="form-control">
                                    <option value="">Pilih Role</option>
                                    @foreach ($roles as $r)
                                        <option value="{{ $r->name }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6" id="div-kanwil" style="display: none">
                                <label for="inputEmail4">Kantor Wilayah</label>
                                <select name="kantor_wilayah" class="form-control">

                                </select>
                            </div>
                            <div class="form-group col-md-6" id="div-kanca" style="display: none">
                                <label for="inputEmail4">Unit Kerja BRI</label>
                                <select name="kantor_cabang" class="form-control" disabled>

                                </select>
                            </div>
                        </div>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-warning mx-2 my-2">Kembali</a>
                        <button type="submit" class="btn btn-success mx-2 my-2 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('assets/js/helper.js') }}"></script>
@section('js')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('[name=status]').select2()
            $('[name=nama_role]').select2()
            $('[name=kantor_wilayah]').select2()
            $('[name=kantor_cabang]').select2()

            function getKanwil() {
                $.ajax({
                    type: 'get',
                    url: "{{ url('api/general/kota?is_kanwil=true') }}",
                    beforeSend: function() {

                    },
                    success: function(data) {
                        let opt = '<option value="">Pilih</option>'
                        $.each(data.data, function(k, v) {
                            opt += `<option value=${v.id}>${v.kota}</option>`
                        })
                        $('[name=kantor_wilayah]').html(opt)
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
                        // console.log(data.data)
                        let opt = '<option value="">Pilih</option>'
                        let _nama_role = $('[name=nama_role] option:selected').text()
                        if (_nama_role == "Kantor Cabang Pembantu") {
                            $.each(data.data, function(k, v) {
                                opt += `<option value=${v.kode} disabled>${v.nama}</option>`
                                if (v.kcp.length > 0) {
                                    $.each(v.kcp, function(k2, v2) {
                                        opt +=
                                            `<option value=${v2.kode}>&nbsp;&nbsp;&nbsp;&nbsp;${v2.nama}</option>`
                                    })
                                }
                            })
                        } else if (_nama_role == "Kantor Cabang") {
                            $.each(data.data, function(k, v) {
                                opt += `<option value=${v.id}>${v.nama}</option>`
                            })
                        } else {
                            $.each(data.data, function(k, v) {
                                opt += `<option value=${v.kode}>${v.nama}</option>`
                            })
                        }
                        $('[name=kantor_cabang]').prop('disabled', false).html(opt)
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
            $('body').on('change', '[name=kantor_wilayah]', function() {
                getKanCa($(this).val())
            })

            $('[name=nama_role]').change(function() {
                let val = $(this).val()
                console.log(val)
                if (val == "Kantor Wilayah") {
                    getKanwil()
                    $('#div-kanwil').show(400)
                    $('#div-kanca').hide()
                } else if (val == "Kantor Cabang" || val == "Kantor Cabang Pembantu") {
                    getKanwil()
                    $('#div-kanwil').show(400)
                    $('#div-kanca').show(400)
                } else {
                    $('#div-kanwil').hide(400)
                    $('#div-kanca').hide(400)
                }
            })

            $('#form-store-user').submit(function(e) {
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
                        setTimeout(function() {
                            window.location.href = "/admin/user";
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
