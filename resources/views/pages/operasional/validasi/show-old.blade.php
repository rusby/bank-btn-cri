@extends('layouts.app')
@section('operasional.validasi', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Verifikasi Collection Validasi</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<form action="{{route('operasional.validasi.update', $data->id)}}" method="POST" id="form-verifikasi-validasi">
				@csrf
				@method('PUT')
				<input type="hidden" name="status">
				<div class="widget-content widget-content-area">
					<div class="table-responsive mb-4 mt-4">				
						<table class="table table-hover table-bordered table-sm" id="table-Datatable" style="width:100%;">
							<tbody>
								<tr style="background-color: #dfdede">
									<td colspan="2">
										<h6>Data Diri</h6>
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1" id="dokumendataDiriCheck">
											</label>
										</div>
									</td>
								</tr>
								@foreach($colDataDiri as $key => $cd)
								<tr id="tr-dataDiri">
									<td style="width: 30%">{{explode("-", $cd)[0]}}</td>
									<td>
										<?php $fix = explode("-", $cd)[1]; ?>
										{{$data->dataDiri->$fix}}
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1">
											</label>
										</div>
									</td>
								</tr>
								@endforeach
								@if(!is_null($data->dataDiri->pasangan))
								<tr style="background-color: #dfdede">
									<td colspan="2">
										<h6>Data Pasangan</h6>
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1" id="dokumendataPasanganCheck">
											</label>
										</div>
									</td>
								</tr>
								@foreach($colDataPasangan as $key => $cp)
								<tr id="tr-dataPasangan">
									<td>{{explode("-", $cp)[0]}}</td>
									<td>
										<?php $fix = explode("-", $cp)[1]; ?>
										{{$data->dataDiri->pasangan->$fix}}
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1">
											</label>
										</div>
									</td>
								</tr>
								@endforeach
								@endif
								@if(!is_null($data->dataDiri->analisaFinansial))
								<tr style="background-color: #dfdede">
									<td colspan="2">
										<h6>Data Analisa Finansial</h6>
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1" id="dokumendataAnalisaCheck">
											</label>
										</div>
									</td>
								</tr>
								@foreach($colDataAnalisa as $key => $cda)
								<tr id="tr-dataAnalisa">
									<td>{{explode("-", $cda)[0]}}</td>
									<td>
										<?php $fix = explode("-", $cda)[1]; ?>
										{{$data->dataDiri->analisaFinansial->$fix}}
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1">
											</label>
										</div>
									</td>
								</tr>
								@endforeach
								@endif
								@if(!is_null($data->dataDiri->agunan))
								<tr style="background-color: #dfdede">
									<td colspan="2">
										<h6>Data Agunan</h6>
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1" id="dokumendataAgunanCheck">
											</label>
										</div>
									</td>
								</tr>
								@foreach($colDataAgunan as $key => $cdan)
								<tr id="tr-dataAgunan">
									<td>{{explode("-", $cdan)[0]}}</td>
									<td>
										<?php $fix = explode("-", $cdan)[1]; ?>
										{{$data->dataDiri->agunan->$fix}}
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1">
											</label>
										</div>
									</td>
								</tr>
								@endforeach
								@endif
								@if(!is_null($data->dataDiri->ujiFlpp))
								<tr style="background-color: #dfdede">
									<td colspan="2">
										<h6>Uji Data FLPP</h6>
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1" id="dokumendataFlppCheck">
											</label>
										</div>
									</td>
								</tr>
								@foreach($colDataFlpp as $key => $cdf)
								<tr id="tr-dataFlpp">
									<td>{{explode("-", $cdf)[0]}}</td>
									<td>
										<?php $fix = explode("-", $cdf)[1]; ?>
										{{$data->dataDiri->ujiFlpp->$fix}}
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1">
											</label>
										</div>
									</td>
								</tr>
								@endforeach
								@endif
								<tr style="background-color: #dfdede">
									<td colspan="2">
										<h6>Dokumen Utama</h6>
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1" id="dokumenUtamaCheck">
											</label>
										</div>
									</td>
								</tr>
								@foreach($column as $key => $c)
								<tr id="tr-utama">
									<td>{{$c}}</td>
									<td>
										<img class="img-thumbnail zoom" src="{{\Helper::showImage('collection/'.$data->nama_developer.'/'.$data->nama_calon_debitur, $data->$c)}}" alt="" style="max-width: 100px;">
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1" id="{{'dokumenUtama'.$key}}" name="{{'keterangan_'.$c}}" {{!is_null($data->dokumenKualifikasi) ? ($data->dokumenKualifikasi->$c ? 'checked' : '') : ''}}>
											</label>
										</div>
									</td>
								</tr>
								@endforeach
								@if($data->fileAdditional()->exists())
								<tr style="background-color: #dfdede">
									<td colspan="2">
										<h6>Dokumen Lainnya</h6>
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="1" id="dokumenLainnyaCheck">
											</label>
										</div>
									</td>
								</tr>
								@foreach($data->fileAdditional as $key => $v)
								<tr id="tr-lainnya">
									<td>{{$v->files->name}}</td>
									<td>
										<img class="img-thumbnail zoom" src="{{\Helper::showImage('collection/'.$data->nama_developer.'/'.$data->nama_calon_debitur, $v->files->name)}}" alt="" style="max-width: 100px;">
									</td>
									<td>
										<div class="n-chk new-checkbox checkbox-outline-primary">
											<label class="new-control new-checkbox checkbox-outline-primary">
												<input type="checkbox" class="new-control-input" value="{{$v->id}}" id="{{'dokumenLainnya'.$key}}" name="dokumen_lain[]" {{$v->lolos ? 'checked' : ''}}>
											</label>
										</div>
									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
					<a href="{{route('operasional.collection.index')}}" class="btn btn-warning mx-2 my-2">Kembali</a>
					<button type="submit" class="btn btn-success mx-2 my-2 float-right" data-text="Apa anda yakin ingin verifikasi data ini ?">Terima</button>
					<a class="btn btn-danger mx-2 my-2 float-right" data-text="Apa anda yakin ingin menolak data ini ?" id="btnTolak" {{$data->status_id == 6 ? 'disabled' : ''}}>Tolak</a>
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
		let allCheckboxUtama 	= $('#tr-utama [type=checkbox]').length
		let allCheckboxUtamaSel = $('#tr-utama [type=checkbox]:checked').length

		let allCheckboxlainnya 	= $('#tr-lainnya [type=checkbox]').length
		let allCheckboxlainnyaSel = $('#tr-lainnya [type=checkbox]:checked').length
		if (allCheckboxUtama == allCheckboxUtamaSel) {
			$('#dokumenUtamaCheck').prop('checked', true)
		}

		if (allCheckboxlainnya == allCheckboxlainnyaSel) {
			$('#dokumenLainnyaCheck').prop('checked', true)
		}
		$('#dokumendataDiriCheck').click(function(){
			if ($(this).prop('checked')) {
				$('#tr-dataDiri [type=checkbox]').prop('checked', true);
			}else{
				$('#tr-dataDiri [type=checkbox]').prop('checked', false);
			}
		})
		$('#dokumendataPasanganCheck').click(function(){
			if ($(this).prop('checked')) {
				$('#tr-dataPasangan [type=checkbox]').prop('checked', true);
			}else{
				$('#tr-dataPasangan [type=checkbox]').prop('checked', false);
			}
		})
		$('#dokumendataAnalisaCheck').click(function(){
			if ($(this).prop('checked')) {
				$('#tr-dataAnalisa [type=checkbox]').prop('checked', true);
			}else{
				$('#tr-dataAnalisa [type=checkbox]').prop('checked', false);
			}
		})
		$('#dokumendataAgunanCheck').click(function(){
			if ($(this).prop('checked')) {
				$('#tr-dataAgunan [type=checkbox]').prop('checked', true);
			}else{
				$('#tr-dataAgunan [type=checkbox]').prop('checked', false);
			}
		})
		$('#dokumendataFlppCheck').click(function(){
			if ($(this).prop('checked')) {
				$('#tr-dataFlpp [type=checkbox]').prop('checked', true);
			}else{
				$('#tr-dataFlpp [type=checkbox]').prop('checked', false);
			}
		})
		$('#dokumenUtamaCheck').click(function(){
			if ($(this).prop('checked')) {
				$('[id^=dokumenUtama]').prop('checked', true);
			}else{
				$('[id^=dokumenUtama]').prop('checked', false);
			}
		})
		$('#dokumenLainnyaCheck').click(function(){
			if ($(this).prop('checked')) {
				$('[id^=dokumenLainnya]').prop('checked', true);
			}else{
				$('[id^=dokumenLainnya]').prop('checked', false);
			}
		})
		
		function sendData(is_validasi=false){			
			if (is_validasi) {
				$('[name=status]').val('diterima')

				let allCheckbox = $('[name^=keterangan_]').length + $('[name^=dokumen_lain]').length
				let selCheckbox = $('[name^=keterangan_]:checked').length + $('[name^=dokumen_lain]:checked').length
				console.log(`${allCheckbox}++${selCheckbox}`)
				if (selCheckbox < allCheckbox) {
					toastr["error"]("Masih ada data yang belum lolos.");
					return
				}
			}else{
				$('[name=status]').val('ditolak')
			}

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name=_token]').val()
				}
			});
			$.ajax({
				type: 'post',
				url: $('#form-verifikasi-validasi').attr("action"),
				data: $('#form-verifikasi-validasi').serialize(),
				dataType: 'json',
				beforeSend: function(){
					if(is_validasi){
						loadButton($('#form-verifikasi-validasi button[type=submit]'))
						return
					}						

					loadButton($('#form-verifikasi-validasi #btnTolak'))
				},
				success: function(data) {
					console.log(data)
					if(data.status == "ok"){
						toastr["success"](data.messages);
					}
					setTimeout(() => {
						location.reload()
					}, 1500)
				},
				error: function(data){
					console.log(data.responseText)
					var data = data.responseJSON;
					if(data.status == "fail"){
						toastr["error"](data.messages);
					}
					if(is_validasi){
						loadButton($('#form-verifikasi-validasi button[type=submit]'), false, 'Terima')
						return
					}						

					loadButton($('#form-verifikasi-validasi #btnTolak'), false, 'Tolak')
				},
				complete: function(){
					if(is_validasi){
						loadButton($('#form-verifikasi-validasi button[type=submit]'), false, 'Terima')
						return
					}						

					loadButton($('#form-verifikasi-validasi #btnTolak'), false, 'Tolak')
				}
			});	
		}

		$('#form-verifikasi-validasi').submit(function(e) {
			e.preventDefault();	
			sendData(true)			
		})

		$('#btnTolak').click(function(){
			if ($(this).attr('disabled') != undefined) {
				return
			}
			sendData(false)
		})
	})
</script>
@endsection