@if(\Session::has('alert-success'))
<script>
	swal({
		title: '{{\Session::get('alert-success')}}',
		type: 'success',
		timer: 3000
	})
</script>
@endif

@if(\Session::has('alert-error'))
<script>
	swal({
		title: '{{\Session::get('alert-error')}}',
		type: 'error',
		timer: 3000
	})
</script>
@endif