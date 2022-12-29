@extends('layouts.app')
@section('operasional.verification.project', 'active')
@section('content')
<div class="page-header">
	<div class="page-title">
		<h3>Verifikasi Project</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">
			<div class="table-responsive mb-4 mt-4">				
				<table class="table table-hover" id="table-Datatable" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Project Belum Verif</th>
							<th>Project Verif</th>
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
              ajax: "{{ route('operasional.verification.project.dataTables') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'name', name: 'name'},
                  {data: 'email', name: 'email'},
                  {
                      data: 'project_notverif', 
                      name: 'project_notverif', 
                      orderable: true, 
                      searchable: true
                  },
                  {
                      data: 'project_verif', 
                      name: 'project_verif', 
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