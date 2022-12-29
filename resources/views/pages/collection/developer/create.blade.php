@extends('layouts.app')
@section('collection.developer', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Tambah Developer</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('collection.developer.store')}}" method="POST" id="form-store-developer">
				@csrf
				<div class="widget-content widget-content-area">
					<h4>Tambah Developer</h4>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Developer Name</label>
							<input type="text" class="form-control" name="developer_name" placeholder="Developer Name">
						</div>
					</div>
					<a href="{{route('collection.developer.index')}}" class="btn btn-warning mx-2 my-2">Kembali</a>
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
		$('#form-store-developer').submit(function(e) {
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
				data: $(this).serialize(),
				beforeSend: function(){
					loadButton($('button[type=submit]'))
				},
				success: function(data) {
					if(data.status == "ok"){
						toastr["success"](data.messages);
					}
					setTimeout(function(){
                        window.location.href = "/collection/developer";
                    }, 1500);
				},
				error: function(data){
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