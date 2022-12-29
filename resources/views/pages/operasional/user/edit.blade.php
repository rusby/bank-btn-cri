@extends('layouts.app')
@section('operasional.user', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Edit User</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('operasional.user.update', $data->id)}}" method="POST" id="form-edit-user">
				@csrf
				@method('PUT')
				<div class="widget-content widget-content-area">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Name</label>
							<input type="text" class="form-control" placeholder="" aria-label="" value="{{$data->name}}" name="name">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Username</label>
							<input type="text" class="form-control" placeholder="" aria-label="" value="{{$data->username}}" name="username">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Email</label>
							<input type="text" class="form-control" placeholder="" aria-label="" value="{{$data->email}}" name="email">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4">Password</label>
							<span style="color: red;font-size: 12px;">*Jika password terisi, akan diupdate</span>
							<input type="password" class="form-control" placeholder="" aria-label="" placeholder="Masukkan password" name="password">					
						</div>
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
							<label for="inputEmail4">Status</label>
							<select name="status" class="form-control">
								<option value="">Pilih Status</option>
								<?php $status = [0 => 'Belum dicek', 1 => 'Verifikasi', 2 => 'Tolak Verifikasi']; ?>
								@foreach($status as $key => $s)
								<option value="{{$key}}" {{$key == $data->is_approved ? 'selected' : '' }} >{{$s}}</option>
								@endforeach
							</select>
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
						<div class="col-md-2">
							<p class="">Foto KTP</p>
							<div class="input-group mb-4">
								<img src="{{\Helper::showImage($data->files->path_ktp, $data->files->ktp)}}" class="zoom" alt="" style="width: 150px;height: 80px; border-radius: 5px;">
							</div>
						</div>
						@if(!is_null($data->files->kartu_nama))
						<div class="col-md-2">
							<p class="">Foto Kartu Nama</p>
							<div class="input-group mb-4">
								<img src="{{\Helper::showImage($data->files->path_kartu_nama, $data->files->kartu_nama)}}" class="zoom" alt="" style="width: 150px;height: 80px; border-radius: 5px;">
							</div>
						</div>
						@endif
					</div>
					<a href="{{route('operasional.user.index')}}" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right" data-text="Apa anda yakin ingin menyimpan data ini ?">Simpan</button>
					
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/js/helper.js')}}"></script>
<script>
	$(document).ready(function(){
		$('[name=nama_role]').change(function(){
			let val = $(this).val()
			if (val == "sales developer") {
				$('#div-kartu_nama').show(400)
			}else{
				$('#div-kartu_nama').hide(400)
				$('[name=kartu_nama]').val(null)
			}
		})

		$('#form-edit-user').submit(function(e) {
			e.preventDefault();			

			if ($('[name=nama_role] option:selected').val() == "") {
				toastr["error"]("Nama role wajib dipilih");
				return
			}

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('input[name="_token"]').val()
				}
			});

			var form_data = new FormData($(this)[0]);
			form_data.append('ktp', $('[name=ktp]').prop('files')[0]);
			if ($('#div-kartu_nama').css('display') != 'none') {
				form_data.append('kartu_nama', $('[name=kartu_nama]').prop('files')[0]);
			}

			$.ajax({
				type: 'post',
				url: $(this).attr("action"),
				data: form_data,
				dataType: 'json',
				processData: false,
				contentType: false,
				beforeSend: function(){
					loadButton($('button[type=submit]'))
				},
				success: function(data) {
					console.log(data)
					if(data.status == "ok"){
						toastr["success"](data.messages);
					}
					setTimeout(function(){
						window.location.href = "/operasional/user";
					}, 1500);
				},
				error: function(data){
					console.log(data.responseText)
					var data = data.responseJSON;
					if(data.status == "fail"){
						toastr["error"](data.messages);
					}
				},
				complete: function(){
					loadButton($('button[type=submit]'), false, 'Simpan')
				}
			});	
		})
		// $('#form-edit-user').submit(function(e) {
		// 	e.preventDefault();
		// 	swal({
		// 		text: $(this).find('button').attr('data-text'),
		// 		type: 'warning',
		// 		showCancelButton: true,
		// 		confirmButtonText: 'Yakin',
		// 		padding: '2em'
		// 	}).then(function(result) {
		// 		if (result.value) {
		// 			$('#form-edit-user')[0].submit()
		// 			swal({
		// 				type: 'success',
		// 				timer: 2000
		// 			})
		// 		}
		// 	})
		// })
	})
</script>
@endsection