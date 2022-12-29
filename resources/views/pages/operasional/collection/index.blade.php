@extends('layouts.app')
@section('operasional.collection', 'active')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
<link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">

<style type="text/css">
	nav > .nav.nav-tabs{
		border: none;
		color:#fff;
		background:#5c1ac3;
		border-radius:0;

	}
	nav > div button.nav-link,
	nav > div button.nav-link.active
	{
		border: none;
		padding: 18px 25px;
		color:#fff;
		background:#5c1ac3;
		border-radius:0;
	}

	nav > div button.nav-link.active:after
	{
		content: "";
		position: relative;
		bottom: -60px;
		left: -10%;
		border: 15px solid transparent;
		border-top-color: #5c1ac3 ;
	}
	.tab-content{
		background: #fdfdfd;
		line-height: 25px;
		border: 1px solid #ddd;
		border-top:5px solid #5c1ac3;
		border-bottom:5px solid #5c1ac3;
		padding:30px 25px;
	}

	nav > div button.nav-item.nav-link:hover,
	nav > div button.nav-item.nav-link:focus
	{
		border: none;
		background: #5c1ac3;
		color:#fff;
		border-radius:0;
		transition:background 0.20s linear;
	}

	.tab {overflow: hidden; border: 1px solid #ccc; 
		background-color: #f1f1f1;
	}

	.tabcontent {display: none; padding: 6px 12px; border: 1px solid #ccc;
		border-top: none;}
		
	.tab button {background-color: inherit; float: left; border: none;
		outline: none; cursor: pointer; padding: 14px 16px; 
		transition: 0.3s;}
		
	.tab button:hover {background-color: #ddd;}

	.tab .active {background-color: #1b55e2;}

	.tabcontent {
		display: none; padding: 6px 12px;
		border: 1px solid #ccc; border-top: none;
	}
	
</style>

<div class="page-header">
	<div class="page-title">
		<h3>File Collection</h3>
	</div>
</div>
<div class="row layout-top-spacing" id="cancel-row">
	<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
		<div class="widget-content widget-content-area br-6">
			<div class="col-xs-12 ">				
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<button class="nav-link bt-link  B2B" onclick="openCollectionTab(event, 'nav-b2b')" id="nav-b2b-tab" style="background:rgb(33, 37, 41);">B2B </button>
						<button class="nav-link bt-link" onclick="openCollectionTab(event, 'nav-property')" id="nav-property-tab" >PROPERTY </button>
						<button class="nav-link bt-link" onclick="openCollectionTab(event, 'nav-submission')" id="nav-submission-tab">SUBMISSION </button>
						<button class="nav-link bt-link" onclick="openCollectionTab(event, 'nav-simulation')" id="nav-simulation-tab">SIMULATION</button>
					</div>
				</nav>
				
				<div style="padding-top:5px;">
					<div class="tab-content py-3 px-3 px-sm-3 " id="nav-tabContent">						
						<div class="tab-pane show active tabcontent-main" id="nav-b2b" role="tabpanel" aria-labelledby="nav-b2b-tab">
						</div>
						<!-- PROPERTY -->
						<div class="tab-pane tabcontent-main" id="nav-property" role="tabpanel" aria-labelledby="nav-property-tab">
						</div>

						<!-- SUBMISSION  -->
						<div class="tab-pane tabcontent-main" id="nav-submission" role="tabpanel" aria-labelledby="nav-submission-tab">
						</div>

						<!-- SIMULATION -->
						<div class="tab-pane tabcontent-main" id="nav-simulation" role="tabpanel" aria-labelledby="nav-simulation-tab">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/js/helper.js')}}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<!-- <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script> -->
<script src="{{ asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
<script src="https://npmcdn.com/flatpickr@4.6.3/dist/l10n/zh-tw.js"></script>

<script>
	clearDatatableB2B();
	$(document).ready(function() {
		$('#nav-b2b').load('{{ route("operasional.b2btab") }}');
	})

	function openCollectionTab(evt, pages) {
        var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent-main");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("bt-link");
            $(".nav-link").css('color', '#fff');

		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace("active", "");
			tablinks[i].style.background = "#5c1ac3";
        }
            
		document.getElementById(pages).style.display = "block";
        evt.currentTarget.style.color = "#fff";
        evt.currentTarget.style.background = "#212529";
		evt.currentTarget.className += " active";
		if(pages == 'nav-property'){
			$('#nav-property').load('{{ route("operasional.propertytab") }}');
        }else if(pages == 'nav-submission'){
			$('#nav-submission').load('{{ route("operasional.submissiontab") }}');
		}else if(pages == 'nav-simulation'){
			$('#nav-simulation').load('{{ route("operasional.simulationtab") }}');
        }else{
			$('#nav-b2b').load('{{ route("operasional.b2btab") }}');
		}

	}

	function clearDatatableB2B(){
        $("#FinanceType").empty();
        $("#LoanType").empty();
        $("#EmploymentType").empty();
        $("#SearchData").empty();
        $("#HousingLoanApplication").empty();
        $("#FinanceType").empty();
        $("#table-houseloan_list").empty();

        $('#financetype-table').dataTable().fnClearTable();
        $('#financetype-table').dataTable().fnDestroy();
    }

</script>

@include('partials.alert')

@endsection