@extends('layouts.app')
@section('admin.user', 'active')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<div class="page-header">
	<div class="page-title">
		<h3>Edit User</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{ route('admin.user.update', $data->id) }}" method="POST" id="form-store-user" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="widget-content widget-content-area">
					<h4>Edit User</h4>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Name</label>
							<input type="text" class="form-control" value="{{$data->name}}" name="name" placeholder="Name">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Username</label>
							<input type="text" class="form-control" value="{{$data->username}}" name="username" placeholder="Username">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Email</label>
							<input type="text" class="form-control" value="{{$data->email}}" name="email" placeholder="Email">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Password</label>
							<span style="color: red;font-size: 12px;">*Jika password terisi, akan diupdate</span>
							<input type="Password" class="form-control" name="password" placeholder="Password">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Status</label>
							<select name="status" class="form-control">
								<option value="">Pilih Status</option>
								<?php $status = [0 => 'Belum diverifikasi', 1 => 'Verifikasi', 2 => 'Tolak Verifikasi']; ?>
								@foreach($status as $key => $s)
								<option value="{{$key}}" {{$key == $data->is_approved ? 'selected' : '' }} >{{$s}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Role</label>
							<select name="nama_role" class="form-control">
								<option value="">Pilih Role</option>
								@foreach($roles as $r)
								<option value="{{$r->name}}" {{$r->name == $data->getRoleNames()[0] ? 'selected' : '' }} >{{$r->name}}</option>
								@endforeach
							</select>
						</div> 
						<div class="form-group col-md-6">
							<label for="inputEmail4">No HP</label>
							<input type="number" class="form-control" name="no_hp" value="{{$data->no_hp}}" placeholder="No HP">
						</div>              
					</div>
					<div class="form-row">
						@if($data->roles->pluck('name')[0] == "sales developer")
						<div class="form-group col-md-6">
							<label for="inputEmail4">Nama Developer</label>
							<input type="text" value="{{$data->nama_developer ?? '-'}}" class="form-control" disabled>
						</div>
						@endif
						<div class="form-group col-md-6">
							<label for="inputEmail4">Nama Perumahan</label>
							<input type="text" class="form-control" name="no_hp" value="{{$data->nama_perumahan ?? '-'}}" placeholder="No HP" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Tanggal Pendaftaran</label>
							<input type="text" value="{{$data->created_at}}" class="form-control" disabled>
						</div>
						<div class="form-group col-md-4">
							<label for="inputEmail4">Tanggal Perubahan Data Terakhir</label>
							<input type="text" class="form-control" name="no_hp" value="{{$data->updated_at}}" placeholder="Tanggal Perubahan Data Terakhir" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<div class="form-group mb-4" id="div-ktp">
								<label>Pilih file KTP</label>
								<input type="file" class="form-control-file" name="ktp">
							</div>
						</div>
						<div class="form-group mb-4" id="div-kartu_nama" style="display: {{$data->getRoleNames()->first() == 'sales developer' ? 'block' : 'none'}}">
							<label>Pilih file Kartu Nama</label>
							<input type="file" class="form-control-file" name="kartu_nama">
						</div>
					</div>
					<div class="row">
						@if($data->getRoleNames()[0] == "sales lepas" || $data->getRoleNames()[0] == "sales developer")
						<div class="col-md-2">
							<p class="">Foto KTP</p>
							<div class="input-group mb-4">
								<img src="{{\Helper::showImage($data->files->path_ktp, $data->files->ktp)}}" class="zoom" alt="" style="width: 150px;height: 80px; border-radius: 5px;">
							</div>
						</div>
						@endif
						@if($data->getRoleNames()[0] == "sales developer")
						<div class="col-md-2">
							<p class="">Foto Kartu Nama</p>
							<div class="input-group mb-4">
								<img src="{{\Helper::showImage($data->files->path_kartu_nama, $data->files->kartu_nama)}}" class="zoom" alt="" style="width: 150px;height: 80px; border-radius: 5px;">
							</div>
						</div>
						@endif
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
		@if($data->getRoleNames()[0] == "Kantor Wilayah")
		$('#div-kanwil').show(400)
		getKanwil('{{$data->userBri->kanwil_id}}')
		@endif

		@if($data->getRoleNames()[0] == "Kantor Cabang")
		$('#div-kanwil').show(400)
		$('#div-kanca').show(400)
		getKanwil('{{$data->userBri->kanwil_id}}')
		getKanCa('{{$data->userBri->kanwil_id}}','{{$data->userBri->kanca_kode}}')
		@endif

		@if($data->getRoleNames()[0] == "Kantor Cabang Pembantu")
		$('#div-kanwil').show(400)
		$('#div-kanca').show(400)
		getKanwil('{{$data->userBri->kanwil_id}}')
		getKanCa('{{$data->userBri->kanwil_id}}','{{$data->userBri->kcp_kode}}')
		@endif
		function getKanwil(selected_id='') {
			$.ajax({
				type: 'get',
				url: "{{ url('api/general/kota?is_kanwil=true') }}",
				beforeSend: function() {

				},
				success: function(data) {
					let opt = '<option value="">Pilih</option>'
					$.each(data.data, function(k, v) {
						opt += `<option value=${v.id} ${v.id == selected_id ? 'selected' : ''} >${v.kota}</option>`
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

		function getKanCa(kota_id = '', selected_id='') {            	
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
                        				`<option value=${v2.kode} ${v2.kode == selected_id ? 'selected' : ''}>&nbsp;&nbsp;&nbsp;&nbsp;${v2.nama}</option>`
                        			})
                        		}
                        	})
                        } else if (_nama_role == "Kantor Cabang") {
                        	$.each(data.data, function(k, v) {
                        		opt += `<option value=${v.id} ${v.id == selected_id ? 'selected' : ''}>${v.nama}</option>`
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