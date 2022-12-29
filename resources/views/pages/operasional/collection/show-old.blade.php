@extends('layouts.app')
@section('operasional.collection', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Verifikasi Collection Files</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('operasional.collection.update', $data->id)}}" method="POST" id="form-verifikasi-collection">
				@csrf
				@method('PUT')
				<input type="hidden" name="status">
				<div class="widget-content widget-content-area">
					<h4 style="display: inline-block;">Dokumen Utama</h4>
					<a href="{{route('operasional.zip-download')}}" class="btn btn-success btn-sm float-right" style="display: inline">Download Zip</a>
					<hr>
					<div class="form-row mb-1">
						<div class="form-group col-md-3">
							<label for="inputEmail4">KTP</label>
							<img class="img-thumbnail" src="{{\Helper::showImage('collection/ktp', $data->ktp)}}" alt="">
						</div>
						<div class="form-group col-md-3">
							<label for="inputPassword4">Keterangan</label>
							@include('partials.select-keterangan', ['name' => 'keterangan_ktp', 'is_lolos' => $data->dokumenKualifikasi])
						</div>
						<div class="form-group col-md-3">
							<label for="inputEmail4">NPWP</label>
							<img class="img-thumbnail" src="{{\Helper::showImage('collection/npwp', $data->npwp)}}" alt="">
						</div>
						<div class="form-group col-md-3">
							<label for="inputPassword4">Keterangan</label>
							@include('partials.select-keterangan', ['name' => 'keterangan_npwp', 'is_lolos' => $data->dokumenKualifikasi])
						</div>
					</div>
					<div class="form-row mb-1">
						<div class="form-group col-md-3">
							<label for="inputEmail4">Kartu Keluarga</label>
							<img class="img-thumbnail" src="{{\Helper::showImage('collection/kk', $data->kk)}}" alt="">
						</div>
						<div class="form-group col-md-3">
							<label for="inputPassword4">Keterangan</label>
							@include('partials.select-keterangan', ['name' => 'keterangan_kk', 'is_lolos' => $data->dokumenKualifikasi])
						</div>
						<div class="form-group col-md-3">
							<label for="inputEmail4">Slip Gaji</label>
							<img class="img-thumbnail" src="{{\Helper::showImage('collection/slip_gaji', $data->slip_gaji)}}" alt="">
						</div>
						<div class="form-group col-md-3">
							<label for="inputPassword4">Keterangan</label>
							@include('partials.select-keterangan', ['name' => 'keterangan_slip_gaji', 'is_lolos' => $data->dokumenKualifikasi])
						</div>
					</div>
					<div class="form-row mb-3">
						<div class="form-group col-md-3">
							<label for="inputEmail4">SPR</label>
							<img class="img-thumbnail" src="{{\Helper::showImage('collection/spr', $data->spr)}}" alt="">
						</div>
						<div class="form-group col-md-3">
							<label for="inputPassword4">Keterangan</label>
							@include('partials.select-keterangan', ['name' => 'keterangan_spr', 'is_lolos' => $data->dokumenKualifikasi])
						</div>
						<div class="form-group col-md-3">
							<label for="inputEmail4">IMB/PBG</label>
							<img class="img-thumbnail" src="{{\Helper::showImage('collection/imb_pbg', $data->imb_pbg)}}" alt="">
						</div>
						<div class="form-group col-md-3">
							<label for="inputPassword4">Keterangan</label>
							@include('partials.select-keterangan', ['name' => 'keterangan_imb_pbg', 'is_lolos' => $data->dokumenKualifikasi])
						</div>
					</div>
					@if(count($data->fileAdditional) > 0)
					<h4>Dokumen Lainnya</h4>
					<hr>
					<div class="form-row mb-1" id="dokumenLainnya">
						@foreach($data->fileAdditional as $val)
						<div class="form-group col-md-3">
							<label for="inputEmail4">{{$val->files->name}}</label>
							<img class="img-thumbnail" src="{{\Helper::showImage($val->files->folder, $val->nama_file)}}" alt="">
						</div>
						<div class="form-group col-md-3">
							<label for="inputPassword4">Keterangan</label>
							<select name="{{'keterangans_lainnya'.$val->id}}" id="{{$val->files->name}}" class="form-control">
								<option value="">Pilih </option>
								<option value="1" {{$val->dokumenKualifikasi()->exists() ? ($val->dokumenKualifikasi->lolos ? 'selected' : '') : ''}} >Lolos</option>
								<option value="0" {{$val->dokumenKualifikasi()->exists() ? (!$val->dokumenKualifikasi->lolos ? 'selected' : '') : ''}}>Tidak Lolos</option>
							</select>
						</div>
						@endforeach
					</div>
					@endif
					<a href="{{route('operasional.collection.index')}}" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right" data-text="Apa anda yakin ingin verifikasi data ini ?">Terima</button>
					<a class="btn btn-danger mx-2 my-2 float-right" data-text="Apa anda yakin ingin menolak data ini ?" id="btnTolak" {{!$data->is_terima && !is_null($data->is_terima) ? 'disabled' : ''}}>Tolak</a>
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
		function validateInputTerima(){
			let validcount = 0;
			
			$('[name^="keterangan_"]').each(function(i, obj) {
				if ($('[name="'+this.name+'"] option:selected').val() == "0") {
					validcount += 1
					toastr["error"](`Keterangan dokumen ${this.id} masih tidak lolos `);
				}
			});

			$('[name^="keterangans_lainnya"]').each(function(i, obj) {
				if ($('[name="'+this.name+'"] option:selected').val() == "0") {
					validcount += 1
					toastr["error"](`Keterangan dokumen lainnya ${this.id} masih tidak lolos `);
				}
			});

			$('[name^="keterangans_lainnya"]').each(function(i, obj) {
				if ($('[name="'+this.name+'"] option:selected').val() == "") {
					validcount += 1
					toastr["error"](`Keterangan dokumen lainnya ${this.id} wajib diisi`);
				}
			});
			return validcount
		}

		function validateInput(){
			let valid;
			$('[name^="keterangans_lainnya"]').each(function(i, obj) {
				if ($('[name="'+this.name+'"] option:selected').val() == "") {
					valid = false
					toastr["error"](`Keterangan dokumen lainnya ${this.id} wajib diisi`);
					return
				}
			});
		}	

		$('#form-verifikasi-collection').submit(function(e) {
			$('[name=status]').val('diterima')
			e.preventDefault();			
			if (validateInputTerima() > 0) {
				return
			}

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: 'post',
				url: $(this).attr("action"),
				data: $(this).serialize(),
				dataType: 'json',
				beforeSend: function(){
					loadButton($('#form-verifikasi-collection button'))
				},
				success: function(data) {
					if(data.status == "ok"){
						toastr["success"](data.messages);
					}
					setTimeout(() => {
						location.reload()
					}, 500)
				},
				error: function(data){
					var data = data.responseJSON;
					if(data.status == "fail"){
						toastr["error"](data.messages);
					}
				},
				complete: function(){
					loadButton($('#form-verifikasi-collection button'), false, 'Terima')
				}
			});	
		})

		$('#btnTolak').click(function(){
			if ($(this).attr('disabled') != undefined) {
				return
			}
			
			$('[name=status]').val('ditolak')
			validateInput()

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type: 'post',
				url: $('#form-verifikasi-collection').attr("action"),
				data: $('#form-verifikasi-collection').serialize(),
				dataType: 'json',
				beforeSend: function(){
					loadButton($('#form-verifikasi-collection #btnTolak'))
				},
				success: function(data) {
					if(data.status == "ok"){
						toastr["success"](data.messages);
					}
					setTimeout(() => {
						location.reload()
					}, 500)
				},
				error: function(data){
					var data = data.responseJSON;
					if(data.status == "fail"){
						toastr["error"](data.messages);
					}
				},
				complete: function(){
					loadButton($('#form-verifikasi-collection #btnTolak'), false, 'Tolak')
				}
			});
		})
	})
</script>
@endsection