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
			<form action="{{ url('save_profile') }}" method="POST" id="form-update-user" enctype="multipart/form-data">
				@csrf
				<div class="widget-content widget-content-area">
					<h4>Edit User</h4>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Name</label>
							<input type="text" class="form-control" value="{{$data->name}}" name="name" placeholder="Name">
							<input type="hidden" value="{{$data->id}}" name="id">
							<input type="hidden" value="{{$data->username}}" name="username">
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
							<label for="inputEmail4">No HP</label>
							<input type="number" class="form-control" name="no_hp" value="{{$data->no_hp}}" placeholder="No HP">
						</div>      
						
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Role</label>
							<input type="text" class="form-control" value="{{$data->getRoleNames()[0]}}" readonly>
						</div> 
						<div class="form-group col-md-6">
							<label for="inputEmail4">Status</label>
							<select name="status" class="form-control" readonly>
								<option value="">Pilih Status</option>
								<?php $status = [0 => 'Belum diverifikasi', 1 => 'Verifikasi', 2 => 'Tolak Verifikasi']; ?>
								@foreach($status as $key => $s)
								<option value="{{$key}}" {{$key == $data->is_approved ? 'selected' : '' }} >{{$s}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-row">
						@if($data->getRoleNames()[0] == "Kantor Wilayah")
						<div class="form-group col-md-6" id="div-kanwil" style="display: none">
							<label for="inputEmail4">Kantor Wilayah</label>
							<input type="text" class="form-control" value="{{$data->userBri->kantorWilayah->kota}}">
						</div>
						@endif
						@if($data->getRoleNames()[0] == "Kantor Cabang")
						<div class="form-group col-md-6" id="div-kanca" style="display: none">
							<label for="inputEmail4">Unit Kerja BRI</label>
							<input type="text" class="form-control" value="{{$data->userBri->unitKerja->nama}}">
						</div>
						@endif
					</div>

					<a href="{{ url('/') }}" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right">Ubah</button>
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

		$('#form-update-user').submit(function(e) {
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
					if (data.status == "ok") {
						toastr["success"](data.messages);
					}
					setTimeout(function() {
						window.location.href = "/";
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
