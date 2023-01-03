<div class="tab-pane fade show statbox widget box box-shadow"  role="tabpanel" aria-labelledby="nav-property-tab" >
    <div class="tab">
        <button class="tablinks RetrieveHousing active" onclick="openPropertiesTab(event, 'RetrieveHousing')" style="color: #fff;">Retrieve Housing </button>
        <button class="tablinks" onclick="openPropertiesTab(event, 'RetreiveHouseType')">Retreive House Type </button>
        <button class="tablinks" onclick="openPropertiesTab(event, 'RetreiveHouseLot')">Retreive House Lot </button>
        <button class="tablinks" onclick="openPropertiesTab(event, 'RetreiveNearbyHousing')">Retreive Nearby Housing</button>
        <button class="tablinks" onclick="openPropertiesTab(event, 'SearchDataProperties')">Search Data</button>
    </div>
    <!-- Prperties -->
    <div id="RetrieveHousing" class="tabcontent"  style="display:block;">
    </div>

    <div id="RetreiveHouseType" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="RetreiveHouseLot" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>

    <div id="RetreiveNearbyHousing" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>
    
    <div id="SearchDataProperties" class="tabcontent w3-animate-opacity" style="display:none;">
    </div>
</div>

<script>
    clearDataTableProperties();   
    clearDatatableB2B();    
    $('#RetrieveHousing').load('{{ route("operasional.retrievehousingtab") }}');
    $(document).ready(function (){
        var table = $('#retrieve-house-table').dataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "{{ url('api/retrieveHousing') }}",
			"type": "GET",
			"dataSrc":"data",
			"columns": [
				{data: 'ID', name: 'ID'},
				{data: 'NAMA_PROPER', name: 'NAMA_PROPER'},
				{data: 'JENIS', name: 'JENIS'},
				{data: 'CABANG', name: 'CABANG'},
				{data: 'HARGA_MULAI', name: 'HARGA_MULAI'},
				{data: 'HARGA_SAMPAI', name: 'HARGA_SAMPAI'},
				{data: 'FASILITAS', name: 'FASILITAS'},
				{data: 'LOGO', name: 'LOGO'},
				{data: 'GBR1', name: 'GBR1'},
				{data: 'GBR2', name: 'GBR2'},
				{data: 'GBR3', name: 'GBR3'},
				{data: 'GBR4', name: 'GBR4'},
				{data: 'GBR5', name: 'GBR5'},
				{data: 'embed360', name: 'embed360'},
				{data: 'DESKRIPSI', name: 'DESKRIPSI'},
				{data: 'NO_TELP', name: 'NO_TELP'},
				{data: 'ALAMAT', name: 'ALAMAT'},
				{data: 'PROV', name: 'PROV'},
				{data: 'KOTA', name: 'KOTA'},
				{data: 'KEC', name: 'KEC'},
				{data: 'KEL', name: 'KEL'},
				{data: 'KODE_POS', name: 'KODE_POS'},
				{data: 'LATITUDE', name: 'LATITUDE'},
				{data: 'LONGITUDE', name: 'LONGITUDE'},
				{data: 'pmt_konvensional', name: 'pmt_konvensional'},
				{data: 'pmt_syariah', name: 'pmt_syariah'},
				{data: 'sk_bga', name: 'sk_bga'},
				{data: 'sk_bga_syariah', name: 'sk_bga_syariah'},
			]
		});       
        
        // getDataAllRretrieveHouse();
    }); 

	function openPropertiesTab(evt, pages) {
        clearDataTableProperties();

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
        if(pages == 'RetreiveHouseType'){
            $('#RetreiveHouseType').load('{{ route("operasional.retrievehousetypetab") }}');
        }else if(pages == 'RetreiveHouseLot'){
            $('#RetreiveHouseLot').load('{{ route("operasional.retrievehouselottab") }}');
        }else if(pages == 'RetreiveNearbyHousing'){
            $('#RetreiveNearbyHousing').load('{{ route("operasional.retrievehousenearbytab") }}');
        }else if(pages == 'SearchDataProperties'){
            $('#SearchDataProperties').load('{{ route("operasional.searchdatapropertiestab") }}');
        }else{
            $('#RetrieveHousing').load('{{ route("operasional.retrievehousingtab") }}');
        }
	}

    function getDataAllRretrieveHouse(){
        $.ajax({
           url : "{{ url('api/retrieveHousing') }}",
            method : "GET",
            dataType : 'json',
            beforeSend: function() {
            },
            success: function(json){
                console.log(json);
                var $el = $("#select_properties");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.ID).text(value.NAMA_PROPER));
                })
            }
        });
    }

    function getDataRetrieveHouse(){
        var proper_id = $("#select_properties").val();
        var halKe = $("#halKe").val();
        var url = "{{ url('api/retrieveHouseType') }}";
        $.ajax({
            url : url,
            method : "GET",
            data : {
                proper_id:proper_id,
                halKe:halKe,
            },
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                console.log(json);
                var table = $("#table-result-retrieve_house_type").DataTable({
                    data: json.data,
                    "columns": [
                        {data: 'ID', name: 'ID'},
                        {data: 'NAMA', name: 'NAMA'},
                        {data: 'JENIS', name: 'JENIS'},
                        {data: 'KLASTER', name: 'CABANG'},
                        {data: 'BLOK', name: 'BLOK'},
                        {data: 'SUBSIDI', name: 'SUBSIDI'},
                        {data: 'GBR1', name: 'GBR1'},
                        {data: 'GBR2', name: 'GBR2'},
                        {data: 'GBR3', name: 'GBR3'},
                        {data: 'GBR4', name: 'GBR4'},
                        {data: 'GBR5', name: 'GBR5'},
                        {data: 'LATITUDE', name: 'LATITUDE'},
                        {data: 'LONGITUDE', name: 'LONGITUDE'},
                        {data: 'DESKRIPSI', name: 'DESKRIPSI'},
                        {data: 'KAMAR_TIDUR', name: 'KAMAR_TIDUR'},
                        {data: 'KAMAR_MANDI', name: 'KAMAR_MANDI'},
                        {data: 'FASILITAS', name: 'FASILITAS'},
                        {data: 'LANTAI', name: 'LANTAI'},
                        {data: 'DAYA_LISTRIK', name: 'DAYA_LISTRIK'},
                        {data: 'LUAS_TANAH', name: 'LUAS_TANAH'},
                        {data: 'LUAS_BANGUNAN', name: 'LUAS_BANGUNAN'},
                        {data: 'HARGA_MULAI', name: 'HARGA_MULAI'},
                        {data: 'HARGA_SAMPAI', name: 'HARGA_SAMPAI'},
                        {data: 'BOOKING_FEE', name: 'BOOKING_FEE'},
                        {data: 'SERTIFIKAT', name: 'SERTIFIKAT'},
                        {data: 'ALAMAT', name: 'ALAMAT'},
                        {data: 'KODEPOS', name: 'KODEPOS'},
                        {data: 'CATATAN', name: 'CATATAN'},
                        {data: 'GARASI_LAMA', name: 'GARASI_LAMA'},
                    ]
                })
            }
        });
    }

    function clearDataTableProperties(){
        $("#RetrieveHousing").empty();
        $("#RetreiveHouseType").empty();
        $("#RetreiveHouseLot").empty();
        $("#RetreiveNearbyHousing").empty();
        $("#SearchDataProperties").empty();
        $("#table_retrieve_house").empty();
        $("#table-retrieve-house-type").empty();
        $("#table-retrieve-house-type-lot").empty();

        $('#table-result-retrieve-houselot_detail').dataTable().fnClearTable();
        $('#table-result-retrieve-houselot_detail').dataTable().fnDestroy();
        $('#table-result-retrieve-houselot').dataTable().fnClearTable();
        $('#table-result-retrieve-houselot').dataTable().fnDestroy();
    }
  
</script>