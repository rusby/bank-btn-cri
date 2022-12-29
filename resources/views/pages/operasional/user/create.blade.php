@extends('layouts.app')
@section('operasional.user', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Tambah User</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('operasional.user.store')}}" method="POST" id="form-store-user" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="status">
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
								@foreach($roles as $r)
								<option value="{{$r->name}}">{{$r->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group mb-4" id="div-ktp">
						<label>Pilih file KTP</label>
						<input type="file" class="form-control-file" name="ktp">
					</div>
					<div class="form-group mb-4" id="div-kartu_nama" style="display: none">
						<label>Pilih file Kartu Nama</label>
						<input type="file" class="form-control-file" name="kartu_nama">
					</div>
					<a href="{{route('operasional.user.index')}}" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
<script src="{{asset('assets/js/helper.js')}}"></script>
@section('js')
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
		$('#form-store-user').submit(function(e) {
			e.preventDefault();			

			if ($('#div-kartu_nama').css('display') != 'none') {
				if ($("[name=kartu_nama]")[0].files.length == 0) {
					toastr["error"]('Kartu nama belum diupload, Silakan upload Kartu nama terlebih dahulu');
					return
				}

				let ext = $("[name=kartu_nama]")[0].files[0].name.split('.')[1]
				if($.inArray(ext, ['jpg', 'png', 'jpeg', 'bmp']) == -1){
					toastr["error"]('Kartu nama harus berformat jpg, png, atau bmp');
					return
				}				
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
	})
</script>
@endsection