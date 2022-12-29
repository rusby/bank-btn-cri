@extends('layouts.app')
@section('draft.index', 'active')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<div class="page-header">
	<div class="page-title">
		<h3>File Collection Draft</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">
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
							<th width="20%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/js/helper.js')}}"></script>
@include('partials.alert')
<script>
	$(document).ready(function(){
		var table = $('#table-Datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url : "{{ route('draft.index') }}"
			},
			columns: [
			{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
			{
				data: function(row){
					return `${row.nama_calon_debitur}-${row.no_ktp}`
				}, orderable: false, name: 'nama_calon_debitur'
			},
			{data: 'nama_developer', name: 'nama_developer'},
			{data: 'nama_project', name: 'nama_project'},
			{data: 'jenis_kredit', name: 'jenis_kredit'},
			{data: 'nama_uker', name: 'kantor_cabangs.nama', orderable: false, searchable: false},
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

	})
</script>
@endsection