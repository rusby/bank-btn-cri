@extends('layouts.app')
@section('collection.project', 'active')
<style>
	#btnRemove{
		background-color: red;
		padding: 5px;
		margin: 8px 0 0 0;
		color: #fff;
		border-radius: 5px;
	}
	#dokLainnya{
		max-width: 97%;
		display: inline;
	}

</style>
@section('content')
<link href="{{asset('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
<div class="page-header">
	<div class="page-title">
		<h3>Tambah Project</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('collection.project.store')}}" method="POST" id="form-store-project" enctype="multipart/form-data">
				@csrf
				<div class="widget-content widget-content-area">
					<h4>Tambah Project</h4>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Nama Project</label>
							<input type="text" class="form-control" name="project_name" placeholder="Nama Project">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Keterangan Project</label>
							<textarea name="project_description" class="form-control" rows="2" placeholder="Keterangan Project"></textarea>
							<!-- <input type="text" class="form-control" name="project_name" placeholder="Keterangan Project"> -->
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">No. Sertifikat</label>
							<input type="text" class="form-control" name="no_sertifikat" placeholder="No. Sertifikat">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Tanggal Sertifikat</label>
							<input value="{{date('d-M-Y')}}" class="form-control flatpickr flatpickr-input active" type="text" name="tgl_sertifikat" placeholder="Select Date..">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">No. IMB</label>
							<input type="text" class="form-control" name="no_imb" placeholder="No. IMB">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Tanggal IMB</label>
							<input value="{{date('d-M-Y')}}" class="form-control flatpickr flatpickr-input active" type="text" name="tgl_imb" placeholder="Select Date..">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Tambah Dokumen Lainnya</label>
							<div class="mb-1">
								<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnTambahDokumen">Tambah</a>
							</div>
							<div id="divInput">
								
							</div>
						</div>
					</div>					
					<a href="{{route('collection.project.index')}}" id="btnBack" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
<script src="{{asset('assets/js/helper.js')}}"></script>
<script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>
@section('js')
<script>
	$(document).ready(function(){
		flatpickr('[name=tgl_sertifikat]', {
			dateFormat: "d-M-Y"
		});
		flatpickr('[name=tgl_imb]', {
			dateFormat: "d-M-Y"
		});
		$('#form-store-project').submit(function(e) {
			e.preventDefault();			

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('input[name="_token"]').val()
				}
			});

			var form_data = new FormData($(this)[0]);
			form_data.append('total_file', $('[id^=dokLainnya]').length)

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
					if(data.status == "ok"){
						toastr["success"](data.messages);
					}
					setTimeout(function(){
						window.location.href = "/collection/project";
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
		
		let idCount = 0;
		$('#btnTambahDokumen').click(function(){
			idCount += 1
			let elem = `<input class="form-control my-1 cust-input${idCount}" type="file" name="dokumen_lainnya[]" id="dokLainnya">`
			elem += `<button type="button" class="close btn-input${idCount}" data-id=${idCount} aria-label="Close" id="btnRemove">`
			elem += '<span aria-hidden="true">&times;</span>'
			elem += '</button>'
			$('#divInput').append(elem)
		})

		$('body').on('click', '#btnRemove', function(){
			let id = $(this).attr('data-id')
			$('.cust-input'+id+'').remove()
			$('.btn-input'+id+'').remove()
		})
	})
</script>
@endsection