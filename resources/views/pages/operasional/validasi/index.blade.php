@extends('layouts.app')
@section('operasional.validasi', 'active')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">
<div class="page-header">
	<div class="page-title">
		<h3>Verifikasi Collection</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">
			<div class="row">
				<div class="col-md-3">
					<label><strong>Jenis KPR</strong></label>
					<select name="filter_jenis_kpr" class="form-control" style="width: 200px">
						<option value="">Pilih Jenis KPR</option>
						<option value="KPR Subsidi FLPP (Fix Income)">KPR Subsidi FLPP (Fix Income)</option>
						<option value="KPR Komersial (Baru atau Secondary)">KPR Komersial (Baru atau Secondary)</option>
						<option value="KPR BP2BT (Non Fix Income)">KPR BP2BT (Non Fix Income)</option>
						<option value="KPR Tapera (Peserta Tapera)">KPR Tapera (Peserta Tapera)</option>
					</select>
				</div>
			</div>
			<div class="table-responsive mb-4 mt-4">				
				<table class="table table-hover table-bordered" id="table-Datatable" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama Debitur</th>
							<th>Nama Developer</th>
							<th>Nama Project</th>
							<th>Jenis Kredit</th>
							<th>Unit Kerja</th>
							<th>Status</th>
							<th width="17%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalKirimData" role="dialog">
	<div class="modal-dialog" role="document">
		<form action="{{route('operasional.validasi.kirim_data')}}" method="POST" id="form-kirimdata" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-body">
					@csrf
					<h4>Kirim Data</h4>
					<hr>
					<div class="form-row">
						<input type="hidden" name="collection_id">
						<div class="form-group col-md-12">
							<label for="inputEmail4">Nama Debitur</label>
							<input type="text" class="form-control" name="sel_nama_debitur" disabled placeholder="Nama Debitur">
						</div>
						<div class="form-group col-md-12">
							<label for="inputEmail4">No KTP</label>
							<input type="text" class="form-control" name="sel_no_ktp" disabled placeholder="No KTP">
						</div>
						<div class="form-group col-md-12">
							<label for="inputEmail4">Nama Project</label>
							<input type="text" class="form-control" name="sel_nama_project" disabled placeholder="Nama Project">
						</div>
						<div class="form-group col-md-12">
							<label for="inputEmail4">Jenis Kredit</label>
							<input type="text" class="form-control" name="sel_jenis_kredit" disabled placeholder="Unit Kerja">
						</div>
						<div class="form-group col-md-12">
							<label for="inputEmail4">Unit Kerja BRI saat ini</label>
							<input type="text" class="form-control" name="sel_unit_kerja" disabled placeholder="Unit Kerja">
						</div>
						<div class="form-group col-md-12">
							<label for="inputEmail4">Kantor Wilayah / KCK</label>
							<select name="kantor_wilayah" class="form-control">
								
							</select>
						</div>
						<div class="form-group col-md-12" id="div-unitkerjabri" style="margin-top: -15px;">
							<label for="inputEmail4">Kantor Unit Kerja BRI</label>
							<select name="kantor_cabang" class="form-control" disabled>

							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-warning" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
					<button type="submit" class="btn btn-primary" id="btnKirimData">Kirim</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/js/helper.js')}}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
@include('partials.alert')
<script>
	$(document).ready(function(){
		
		$('[name=kantor_wilayah]').select2({
			dropdownParent: $('#modalKirimData .modal-content')
		})
		$('[name=kantor_cabang]').select2({
			dropdownParent: $('#modalKirimData .modal-content')
		})
		$('#form-kirimdata').submit(function(e) {
			e.preventDefault();			

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('input[name="_token"]').val()
				}
			});

			$.ajax({
				type: 'get',
				url: $(this).attr("action"),
				data: $(this).serialize(),
				beforeSend: function(){
					loadButton($('#btnKirimData'))
				},
				success: function(data) {
					console.log(data)
					table.ajax.reload()
					if(data.status == "ok"){
						toastr["success"](data.messages);
					}
					$('#modalKirimData').modal('hide')
				},
				error: function(data){
					console.log(data.responseText)
					var data = data.responseJSON;
					if(data.status == "fail"){
						toastr["error"](data.messages);
					}
				},
				complete: function(){
					loadButton($('#btnKirimData'), false, 'Kirim')					
				}
			});	
		})

		var table = $('#table-Datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url : "{{ route('operasional.validasi.dataTables') }}",
				data: function(d){
                    d.filter_jenis_kpr = $('[name=filter_jenis_kpr]').find(':selected').val()
				}
			},
			columns: [
			{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
			{
				data: function(row){
					return `${row.nama_calon_debitur}-${row.no_ktp}`
				},orderable: false,searchable: false
			},
			{data: 'nama_developer', name: 'nama_developer'},
			{data: 'nama_project', name: 'nama_project'},
			{data: 'jenis_kredit', name: 'jenis_kredit'},
			{data: 'nama_uker', name: 'kantor_cabangs.nama', orderable: false,searchable: false},
			{
				data: 'status', 
				name: 'status', 
				orderable: true, 
				searchable: true
			},
			{
				data: 'action', 
				name: 'action', 
				orderable: true, 
				searchable: true
			},
			]
		});
		var selKanwilId = ''

		$('body').on('click', '#btnShowModal', function(){
			selKanwilId = $(this).attr('data-kanwil_id')
			selCabangKode = $(this).attr('data-cabang_kode')
			$('[name=sel_nama_debitur]').val($(this).attr('data-nama_debitur'))
			$('[name=sel_no_ktp]').val($(this).attr('data-no_ktp'))
			$('[name=sel_nama_project]').val($(this).attr('data-nama_project'))
			$('[name=sel_jenis_kredit]').val($(this).attr('data-jenis_kredit'))
			$('[name=sel_unit_kerja]').val($(this).attr('data-unit_kerja'))
			$('[name=collection_id]').val($(this).attr('data-collection_id'))

			selCabangKode = parseInt(selCabangKode)
			if (selCabangKode == 1039) {
				getKanwil(selKanwilId, true)
				getKanCa(null, '', true)
				return
			}
			getKanwil(selKanwilId)
			getKanCa(selKanwilId, selCabangKode)
		})	

		function getKanwil(kota_id, is_kck=false){
			$.ajax({
				type: 'get',
				url: "{{url('api/general/kota?is_kanwil=true')}}",
				data: {
					adding_kck: true
				},
				beforeSend: function(){
					$('[name=kantor_wilayah]').html('<option value="">Load ...</option>')
				},
				success: function(data) {
					if (is_kck) {
						let opt = '<option value="">Pilih</option>'
						$.each(data.data, function(k, v){
							opt += `<option value=${v.id} ${1039 == v.id ? "selected" : ""} >${v.kota}</option>`
						})
						$('[name=kantor_wilayah]').html(opt)
						$('#div-unitkerjabri').hide()
						return
					}
					let opt = '<option value="">Pilih</option>'
					$.each(data.data, function(k, v){
						opt += `<option value=${v.id} ${kota_id == v.id ? "selected" : ""} >${v.kota}</option>`
					})
					$('[name=kantor_wilayah]').html(opt)
					$('#div-unitkerjabri').show()
					
				},
				error: function(data){
					console.log(data.responseText)
					var data = data.responseJSON;
					if(data.status == "fail"){
						toastr["error"](data.messages);
					}
				}
			});
		}	

		function getKanCa(kota_id='', kode='', is_kck=false){
			$.ajax({
				type: 'get',
				url: "{{url('api/general/kantor_cabang')}}",
				data: {
					kota_id: kota_id
				},
				beforeSend: function(){
					$('[name=kantor_cabang]').html('<option value="">Load ...</option>')
				},
				success: function(data) {
					let opt = ''
					$.each(data.data, function(k, v){
						opt += `<option value=${v.kode} ${kode == v.kode ? "selected" : ""}>${v.nama}</option>`

						if (v.kcp.length > 0) {
							$.each(v.kcp, function(k2, v2){
								opt += `<option value=${v2.kode} ${kode == v2.kode ? "selected" : ""}>&nbsp;&nbsp;&nbsp;&nbsp;${v2.nama}</option>`
							})						
						}
					})
					$('[name=kantor_cabang]').prop('disabled', false).html(opt)
				},
				error: function(data){
					console.log(data.responseText)
					var data = data.responseJSON;
					if(data.status == "fail"){
						toastr["error"](data.messages);
					}
				}
			});
		}
		$('body').on('change', '[name=kantor_wilayah]', function(){
			if ($('[name=kantor_wilayah] option:selected').text() == "Kantor Cabang Khusus") {
				$('#div-unitkerjabri').hide()
				return
			}
			getKanCa($(this).val())
			$('#div-unitkerjabri').show()	
		})
		$('[name=filter_jenis_kpr]').select2()
		$('body').on('change', '[name=filter_jenis_kpr]', function() {
            table.draw()
        })
	})
</script>
@endsection