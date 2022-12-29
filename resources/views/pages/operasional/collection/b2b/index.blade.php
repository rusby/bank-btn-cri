<div class="tab-pane fade show statbox widget box box-shadow active" id="nav-b2b" role="tabpanel" aria-labelledby="nav-b2b-tab">
    <div class="tab">
        <button class="tablinks active" onclick="openB2bTab(event, 'FinanceType')" style="color: rgb(255, 255, 255);">Finance Type </button>
        <button class="tablinks" onclick="openB2bTab(event, 'LoanType')">Loan Type </button>
        <button class="tablinks" onclick="openB2bTab(event, 'EmploymentType')">Employment Type</button>
        <button class="tablinks" onclick="openB2bTab(event, 'SearchData')">Search Data</button>
        <button class="tablinks" onclick="openB2bTab(event, 'HousingLoanApplication')">Housing Loan Application</button>
        <button class="tablinks" onclick="openB2bTab(event, 'SMELoanApplication')">SME Loan Application</button>
    </div>
    <!-- B2B -->
    <div id="FinanceType" class="tabcontent" style="display:block;">
    </div>

    <div id="LoanType" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="EmploymentType" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="SearchData" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="HousingLoanApplication" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="SMELoanApplication" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>
</div>
<script>
    clearDatatableB2B();       
    $('#FinanceType').load('{{ route("operasional.financetypetab") }}');
    $(document).ready(function (){
        var table = $('#financetype-table').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "{{ route('operasional.financeType') }}",
			"type": "GET",
			"dataSrc":"data",
			"columns": [
				{data: 'kd', name: 'kd'},
				{data: 'nl', name: 'nl'},
				{data: 'urt', name: 'urt'},
			]
		});         
    });   

	function openB2bTab(evt, pages) {
        clearDatatableB2B();
        
        $("#nav-b2b-tab").addClass('active');
		$("#nav-b2b-tab").css('color','#fff');       

        var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
        }
			tablinks = document.getElementsByClassName("tablinks");
            $(".tablinks").css('color', 'black');

		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace("active", "");
        }
            
		document.getElementById(pages).style.display = "block";
        evt.currentTarget.style.color = "#FFF";
		evt.currentTarget.className += " active";

        if(pages == 'LoanType'){
            $('#LoanType').load('{{ route("operasional.loantypetab") }}');
        }else if(pages == 'EmploymentType'){
            $('#EmploymentType').load('{{ route("operasional.employmenttypetab") }}');
        }else if(pages == 'SearchData'){
            $('#SearchData').load('{{ route("operasional.searchdatatab") }}');
        }else if(pages == 'HousingLoanApplication'){
            $('#HousingLoanApplication').load('{{ route("operasional.housingloanapplicationtab") }}');
        }else if(pages == 'SMELoanApplication'){
            $('#SMELoanApplication').load('{{ route("operasional.smeloantypeapplicationtab") }}');
        }else{
            $('#FinanceType').load('{{ route("operasional.financetypetab") }}');
        }
        
	}

</script>
