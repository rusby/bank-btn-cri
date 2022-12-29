@extends('layouts.app')
@section('admin.user', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Detail User</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('admin.user.store')}}" method="POST" id="form-store-user" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="status">
				<div class="widget-content widget-content-area">
					<h4>Detail User</h4>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Name</label>
							<input type="text" class="form-control" name="name" placeholder="Name" value="{{$data->name}}" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Username</label>
							<input type="text" class="form-control" name="username" placeholder="Username" value="{{$data->username}}" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Email</label>
							<input type="text" class="form-control" name="email" placeholder="Email" value="{{$data->email}}" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputEmail4">Role</label>
							<input type="text" value="{{$data->roles->pluck('name')[0]}}" class="form-control" disabled>
						</div>
						<div class="form-group col-md-4">
							<label for="inputEmail4">No HP</label>
							<input type="number" class="form-control" name="no_hp" value="{{$data->no_hp}}" placeholder="No HP" disabled>
						</div>
						<div class="form-group col-md-2">
							<label for="inputEmail4">Status</label>
							<br>
							@if ($data->is_approved == 1)
							<span class="btn-success btn-sm">Lolos Verifikasi</span>
							@elseif($data->is_approved == 0)
							<span class="btn-warning btn-sm">Belum diverifikasi</span>
							@else
							<span class="btn-danger btn-sm">Ditolak Verifikasi</span>
							@endif
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
						@if($data->hasRole('Kantor Wilayah') || $data->hasRole('Kantor Cabang'))
						<div class="form-group col-md-6">
							<label for="inputEmail4">Kantor Wilayah</label>
							<input type="role" value="{{$data->userBri->kantorWilayah->kota}}" class="form-control" disabled>
						</div>
						@endif

						@if($data->hasRole('Kantor Cabang'))
						<div class="form-group col-md-6">
							<label for="inputEmail4">Kantor Cabang</label>
							<input type="role" value="{{$data->userBri->unitKerja->nama}}" class="form-control" disabled>
						</div>
						@endif
					</div>
					<a href="{{route('admin.user.index')}}" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right" disabled>Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection