@extends('layouts.app')
@section('operasional.user', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Detail User</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('operasional.user.store')}}" method="POST" id="form-store-user" enctype="multipart/form-data">
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
						<div class="form-group col-md-12">
							<label for="inputEmail4">Password</label>
							<input type="Password" class="form-control" name="password" placeholder="Password" value="{{$data->password}}" disabled>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Role</label>
							<input type="role" value="{{$data->roles->pluck('name')[0]}}" class="form-control" disabled>
						</div>
					</div>
					@if($data->files)
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">KTP</label> <br>
							<img src="{{\Helper::showImage('users/ktp', $data->files->ktp)}}" alt="" class="img-thumbnail" style="max-width: 300px;">
						</div>
					</div>
					@if($data->hasRole('sales developer'))
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Kartu Nama</label> <br>
							<img src="{{\Helper::showImage('users/kartu_nama', $data->files->kartu_nama)}}" alt="" class="img-thumbnail" style="max-width: 300px;">
						</div>
					</div>
					@endif
					@endif
					<a href="{{route('operasional.user.index')}}" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right" disabled>Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection