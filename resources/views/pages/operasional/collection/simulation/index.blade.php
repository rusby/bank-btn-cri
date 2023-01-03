<div class="tab-pane fade show statbox widget box box-shadow active" id="nav-Conventional" role="tabpanel" aria-labelledby="nav-Conventional-tab">
    <div class="tab">
        <button class="tablinks active" style="color:#fff;" onclick="openSimulationtab(event, 'HousingLoanConventional')">Housing Loan Conventional </button>
        <button class="tablinks" onclick="openSimulationtab(event, 'HousingLoanSharia')">Housing Loan Sharia </button>
    </div>
    <div id="HousingLoanConventional" class="tabcontent">
        @include('pages.operasional.collection.simulation.housingloan-conventional')
    </div>

    <div id="HousingLoanSharia" class="tabcontent w3-animate-opacity" style="display:none;">
        @include('pages.operasional.collection.simulation.housingloan-sharia')
    </div>
</div>

<script>
	function openSimulationtab(evt, pages) {
		$('#table-result-sharia').DataTable().clear();
        $('#table-result-sharia').DataTable().draw();
        $('#table-result-sharia').DataTable().destroy();
		$('#table-result-conventional').DataTable().clear();
        $('#table-result-conventional').DataTable().draw();
        $('#table-result-conventional').DataTable().destroy();

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
	} 
   
    function getDataConventional(){      
        $("#table-conventional").show();
        var jenis_simulasi = $("#jenis_simulasi").val();
        var jenis_suku_bunga = $("#jenis_suku_bunga").val();
        var sub_or_nonsub = $("#sub_or_nonsub").val();
        var harga = $("#harga").val();
        var uang_muka = $("#uang_muka").val();
        var suku_bunga = $("#suku_bunga").val();
        var lama_pinjaman = $("#lama_pinjaman").val();
        var ms_kredit_fix = $("#masa_kredit_fix").val();
        var sk_bga_flting = $("#suku_bunga_fiting").val();
        
        $.ajax({
            url : "{{ url('api/simulationHousingLoanConventional') }}",
            method : "GET",
            data : {
                jenis_simulasi:jenis_simulasi,
                jenis_suku_bunga:jenis_suku_bunga,
                sub_or_nonsub:sub_or_nonsub,
                harga:harga,
                uang_muka:uang_muka,
                suku_bunga:suku_bunga,
                lama_pinjaman:lama_pinjaman,
                ms_kredit_fix:ms_kredit_fix,
                sk_bga_flting:sk_bga_flting,
            },
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                console.log(json);
                // $("#table-result-conventional").DataTable({
                //     data: json.data,
                //     "columns": [
                //         {data:'jns_simulasi', name:'jns_simulasi'},
                //         {data:'suku_bunga', name:'suku_bunga'},
                //         {data:'suku_bunga_float', name:'suku_bunga_float'},
                //         {data:'kredit_fix', name:'kredit_fix'},
                //         {data:'lama_pinjam', name:'lama_pinjam'},
                //         {data:'uang_muka', name:'uang_muka'},
                //         {data:'b_bank_appraisal', name:'b_bank_appraisal'},
                //         {data:'b_bank_admin', name:'b_bank_admin'},
                //         {data:'b_bank_provisi', name:'b_bank_provisi'},
                //         {data:'b_bank_asuransi', name:'b_bank_asuransi'},
                //         {data:'b_bank_proses', name:'b_bank_proses'},
                //         {data:'total_biaya_bank', name:'total_biaya_bank'},
                //         {data:'b_notaris_aktejualbeli', name:'b_notaris_aktejualbeli'},
                //         {data:'b_notaris_baliknama', name:'b_notaris_baliknama'},
                //         {data:'b_notaris_akte_skmht', name:'b_notaris_akte_skmht'},
                //         {data:'b_notaris_akte_apht', name:'b_notaris_akte_apht'},
                //         {data:'b_notaris_perjanjian_ht', name:'b_notaris_perjanjian_ht'},
                //         {data:'b_notaris_cek_sertif', name:'b_notaris_cek_sertif'},
                //         {data:'total_biaya_notaris', name:'total_biaya_notaris'},
                //         {data:'angsuran_perbulan', name:'angsuran_perbulan'},
                //         {data:'pembayaran_pertama', name:'pembayaran_pertama'},
                //         {data:'notes', name:'notes'},
                //         {data:'uang_muka', name:'uang_muka'}, 
                //         {data:'b_bank_appraisal', name:'b_bank_appraisal'}, 
                //         {data:'b_bank_admin', name:'b_bank_admin'}, 
                //         {data:'b_bank_provisi', name:'b_bank_provisi'}, 
                //         {data:'b_bank_asuransi', name:'b_bank_asuransi'}, 
                //         {data:'b_bank_proses', name:'b_bank_proses'}, 
                //         {data:'b_notaris_aktejualbeli', name:'b_notaris_aktejualbeli'}, 
                //         {data:'b_notaris_baliknama', name:'b_notaris_baliknama'}, 
                //         {data:'b_notaris_akte_skmht', name:'b_notaris_akte_skmht'}, 
                //         {data:'b_notaris_akte_apht', name:'b_notaris_akte_apht'}, 
                //         {data:'b_notaris_perjanjian_ht', name:'b_notaris_perjanjian_ht'}, 
                //         {data:'b_notaris_cek_sertif', name:'b_notaris_cek_sertif'},                                 
                //     ]
                // })
            }
        });
        
    }

	function getDataSharia(){
        $("#table-sharia").show();
        var jenis_simulasi = $("#jenis_simulasi_sharia").val();
        var jenis_suku_bunga = $("#jenis_suku_bunga_sharia").val();
        var sub_or_nonsub = $("#sub_or_nonsub_sharia").val();
        var harga = $("#harga_sharia").val();
        var uang_muka = $("#uang_muka_sharia").val();
        var suku_bunga = $("#suku_bunga_sharia").val();
        var lama_pinjaman = $("#lama_pinjaman_sharia").val();
        var margin_total = $("#margin_total_sharia").val();
        
        $.ajax({
            url : "{{ url('api/simulationHousingLoanSharia') }}",
            method : "GET",
            data : {
                jenis_simulasi:jenis_simulasi,
                jenis_suku_bunga:jenis_suku_bunga,
                sub_or_nonsub:sub_or_nonsub,
                harga:harga,
                uang_muka:uang_muka,
                suku_bunga:suku_bunga,
                lama_pinjaman:lama_pinjaman,
                margin_total:margin_total,
            },
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                console.log(json);
                $("#table-result-sharia").DataTable({
                    data: json.data,
                    "columns": [
                        {data:'jns_simulasi', name:'jns_simulasi'},
                        {data:'suku_bunga', name:'suku_bunga'},
                        {data:'suku_bunga_float', name:'suku_bunga_float'},
                        {data:'kredit_fix', name:'kredit_fix'},
                        {data:'lama_pinjam', name:'lama_pinjam'},
                        {data:'uang_muka', name:'uang_muka'},
                        {data:'b_bank_appraisal', name:'b_bank_appraisal'},
                        {data:'b_bank_admin', name:'b_bank_admin'},
                        {data:'b_bank_provisi', name:'b_bank_provisi'},
                        {data:'b_bank_asuransi', name:'b_bank_asuransi'},
                        {data:'b_bank_proses', name:'b_bank_proses'},
                        {data:'total_biaya_bank', name:'total_biaya_bank'},
                        {data:'b_notaris_aktejualbeli', name:'b_notaris_aktejualbeli'},
                        {data:'b_notaris_baliknama', name:'b_notaris_baliknama'},
                        {data:'b_notaris_akte_skmht', name:'b_notaris_akte_skmht'},
                        {data:'b_notaris_akte_apht', name:'b_notaris_akte_apht'},
                        {data:'b_notaris_perjanjian_ht', name:'b_notaris_perjanjian_ht'},
                        {data:'b_notaris_cek_sertif', name:'b_notaris_cek_sertif'},
                        {data:'total_biaya_notaris', name:'total_biaya_notaris'},
                        {data:'angsuran_perbulan', name:'angsuran_perbulan'},
                        {data:'pembayaran_pertama', name:'pembayaran_pertama'},
                        {data:'notes', name:'notes'},
                        {data:'uang_muka', name:'uang_muka'}, 
                        {data:'b_bank_appraisal', name:'b_bank_appraisal'}, 
                        {data:'b_bank_admin', name:'b_bank_admin'}, 
                        {data:'b_bank_provisi', name:'b_bank_provisi'}, 
                        {data:'b_bank_asuransi', name:'b_bank_asuransi'}, 
                        {data:'b_bank_proses', name:'b_bank_proses'}, 
                        {data:'b_notaris_aktejualbeli', name:'b_notaris_aktejualbeli'}, 
                        {data:'b_notaris_baliknama', name:'b_notaris_baliknama'}, 
                        {data:'b_notaris_akte_skmht', name:'b_notaris_akte_skmht'}, 
                        {data:'b_notaris_akte_apht', name:'b_notaris_akte_apht'}, 
                        {data:'b_notaris_perjanjian_ht', name:'b_notaris_perjanjian_ht'}, 
                        {data:'b_notaris_cek_sertif', name:'b_notaris_cek_sertif'},                                 
                    ]
                })
            }
        });
        
    }

</script>