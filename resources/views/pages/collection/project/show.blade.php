@extends('layouts.app')
@section('collection.project', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Detail Project</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('collection.project.store')}}" method="POST" id="form-store-project">
				@csrf
				<div class="widget-content widget-content-area">
					<h4>Detail Project</h4>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Name</label>
							<input type="text" class="form-control" name="project_name" placeholder="Name" value="{{$project->project_name}}" disabled>
						</div>
						<div class="form-group col-md-12">
							<label for="inputEmail4">Tanggal Dibuat</label>
							<input type="text" class="form-control" name="created_at" placeholder="Name" data-created_at="{{$project->created_at}}" disabled>
						</div>
					</div>
					<a href="{{route('collection.project.index')}}" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right" disabled>Simpan</button>
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
		$('[name=created_at]').val(formatDate($('[name=created_at]').data('created_at')))
	})
</script>
@endsection