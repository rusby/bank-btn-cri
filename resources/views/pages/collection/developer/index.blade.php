@extends('layouts.app')
@section('collection.developer', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Developer</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">
			<a href="{{route('collection.developer.create')}}" class="btn btn-primary btn-sm">
				Tambah Data
			</a>
			<div class="table-responsive mb-4 mt-4">				
				<table class="table table-hover" id="table-Datatable" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama</th>
							<th>Tanggal Dibuat</th>
							<th>Aksi</th>
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
              ajax: "{{ route('collection.developer.dataTables') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'developer_name', name: 'developer_name'},
                  {
                  	data: function(data){
                  		return formatDate(data.created_at)
                  	}
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