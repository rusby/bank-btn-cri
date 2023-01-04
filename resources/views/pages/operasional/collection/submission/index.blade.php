<div class="tab-pane fade show statbox widget box box-shadow active" id="nav-b2b" role="tabpanel" aria-labelledby="nav-b2b-tab">
    <div class="tab">
        <button class="tablinks active" onclick="openSimulationTab(event, 'InitialEntry')" style="color: rgb(255, 255, 255);">Initial Entry</button>
        <button class="tablinks" onclick="openSimulationTab(event, 'PersonalInformation')">Personal Information </button>
        <button class="tablinks" onclick="openSimulationTab(event, 'SpouseInformation')">Spouse Information</button>
        <button class="tablinks" onclick="openSimulationTab(event, 'JobInformation')">Job Information</button>
        <button class="tablinks" onclick="openSimulationTab(event, 'LoanApplication')">Loan Application</button>
        <button class="tablinks" onclick="openSimulationTab(event, 'UploadDocument')">Upload Document</button>
        <button class="tablinks" onclick="openSimulationTab(event, 'ConfirmDocument')">Confirm Document</button>
    </div>
    <!-- B2B -->
    <div id="InitialEntry" class="tabcontent" style="display:block;">
    </div>

    <div id="PersonalInformation" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="SpouseInformation" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="JobInformation" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="LoanApplication" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="UploadDocument" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="ConfirmDocument" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>
</div>
<script>
    clearDataTableSubmission();
    $('#InitialEntry').load('{{ route("operasional.initialentrytab") }}');
    function openSimulationTab(evt, pages) {
        clearDataTableSubmission();

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
        // alert(pages);
        if(pages == 'PersonalInformation'){
            $('#PersonalInformation').load('{{ route("operasional.personalinformationtab") }}');
        }else if(pages == 'SpouseInformation'){
            $('#SpouseInformation').load('{{ route("operasional.spouseinformationtab") }}');
        }else if(pages == 'JobInformation'){
            $('#JobInformation').load('{{ route("operasional.jobinformationtab") }}');
        }else if(pages == 'LoanApplication'){
            $('#LoanApplication').load('{{ route("operasional.loanapplicationtab") }}');
        }else if(pages == 'UploadDocument'){
            $('#UploadDocument').load('{{ route("operasional.uploaddocumenttab") }}');
        }else if(pages == 'ConfirmDocument'){
            $('#ConfirmDocument').load('{{ route("operasional.confirmdocumenttab") }}');
        }else{
            $('#InitialEntry').load('{{ route("operasional.initialentrytab") }}');
        }
	}
    function clearDataTableSubmission(){
        $("#PersonalInformation").empty();
        $("#InitialEntry").empty();
        $("#SpouseInformation").empty();
        $("#JobInformation").empty();
        $("#LoanApplication").empty();
        $("#UploadDocument").empty();
        $("#ConfirmDocument").empty();
    }
</script>