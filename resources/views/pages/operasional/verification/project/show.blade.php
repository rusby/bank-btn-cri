@extends('layouts.app')
@section('operasional.verification.project', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Verifikasi Project</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('operasional.verification.project.update', $data->id)}}" method="POST" id="form-verifikasi">
				@csrf
				@method('PUT')
				<div class="widget-content widget-content-area">
					<p class="">Nama</p>
					<div class="input-group mb-4">
						<input type="text" class="form-control" placeholder="" aria-label="" value="{{$data->name}}" disabled>
					</div>
					<p class="">Email</p>
					<div class="input-group mb-4">
						<input type="text" class="form-control" placeholder="" aria-label="" value="{{$data->email}}" disabled>
					</div>
					<p class="">Project Sudah Verif</p>
					@forelse($data->devProjectVerif as $key => $val)
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" name="project_verif[]" id="{{'checkVerif'.$key}}" checked value="{{$val->id}}">
						<label class="custom-control-label" for="{{'checkVerif'.$key}}">{{$val->project_name}}</label>
					</div>
					@empty
					<div>
						<p>&nbsp;&nbsp;&nbsp;Belum ada project yang diverifikasi.</p>
					</div>
					@endforelse

					<p class="">Project Belum Verif</p>
					@forelse($data->devProjectNotVerif as $key => $val)
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" name="project_notverif[]" id="{{'checkNotVerif'.$key}}" value="{{$val->id}}">
						<label class="custom-control-label" for="{{'checkNotVerif'.$key}}">{{$val->project_name}}</label>
					</div>
					@empty
					<div>
						<p>&nbsp;&nbsp;&nbsp;Belum ada project yang belum diverifikasi.</p>
					</div>
					@endforelse
					<a href="{{route('operasional.verification.project.index')}}" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right" data-text="Apa anda yakin ?">Verifikasi</button>
					
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	$(document).ready(function(){
		$('#form-verifikasi').submit(function(e) {
			e.preventDefault();
			swal({
				text: $(this).find('button').attr('data-text'),
				type: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yakin',
				padding: '2em'
			}).then(function(result) {
				if (result.value) {
					$('#form-verifikasi')[0].submit()
					swal({
						type: 'success',
						timer: 2000
					})
				}
			})
		})
	})
</script>
@endsection