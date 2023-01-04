    <h5 class="mt-3 mb-3" style="padding:10px !important;">Housing Loan Conventional</h5>
    <div class="statbox widget box box-shadow">
        <div class="form-row" style="padding:10px !important;">
            <div class="form-group col-md-12 form-jenis_simulasi">
                <label for="jenis_simulasi">Jenis Simulasi</label>
                <input type="text" class="form-control" name="jenis_simulasi" placeholder="Jenis simulasi" id="jenis_simulasi">
            </div>
            <div class="form-group col-md-12 form-jenis_suku_bunga">
                <label for="jenis_suku_bunga">Jenis Suku Bunga</label>
                <input type="text" class="form-control" name="jenis_suku_bunga" placeholder="Jenis Suku Bunga" id="jenis_suku_bunga">
            </div>
            <div class="form-group col-md-12 form-sub_or_nonsub">
                <label for="sub_or_nonsub">Sub Non Sub</label>
                <input type="text" class="form-control" name="sub_or_nonsub" placeholder="Sub Non Sub" id="sub_or_nonsub">
            </div>       
            <div class="form-group col-md-12 form-harga">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" placeholder="Masukan harga" id="harga">
            </div>
            <div class="form-group col-md-12 form-uang_muka">
                <label for="uang_muka">Uang Muka</label>
                <input type="number" class="form-control" name="uang_muka" placeholder="Uang Muka" id="uang_muka">
            </div>
            <div class="form-group col-md-12 form-suku_bunga">
                <label for="suku_bunga">Suku Bunga</label>
                <input type="text" class="form-control" name="suku_bunga" placeholder="Suku Bunga" id="suku_bunga">
            </div>
            <div class="form-group col-md-12 form-lama_pinjaman">
                <label for="lama_pinjaman">Lama Pinjaman</label>
                <input type="text" class="form-control" name="lama_pinjaman" placeholder="Lama Pinjaman" id="lama_pinjaman">
            </div>
            <div class="form-group col-md-12 form-ms_kredit_fix">
                <label for="ms_kredit_fix">Masa Kredit FIx</label>
                <input type="text" class="form-control" name="ms_kredit_fix" placeholder="Masa Kredit FIx" id="ms_kredit_fix">
            </div>
            <div class="form-group col-md-12 form-sk_bga_flting">
                <label for="sk_bga_flting">Suku BUnga Fiting</label>
                <input type="text" class="form-control" name="sk_bga_flting" placeholder="Suku BUnga Fiting" id="sk_bga_flting">
            </div>
            <button type="button" class="btn btn-success mx-2 my-2 float-right save" id="btn-save-conventional"  onclick="getDataHouseLoanConventional()">Save</button>   
        </div>
        <div   class="form-row" style="padding:10px !important;" id="table-conventional" >
            <table class="table table-hover table-responsive table-bordered dataTable no-footer" id="table-result-conventional" role="grid" aria-describedby="table-Datatable_info" >
                <thead>
                    <tr>                      
                        <th>Jenis Simulasi</th>
                        <th>Suku Bunga</th>
                        <th>Suku Bunga Float</th>
                        <th>Kredit FIx</th>
                        <th>Lama Pinjam</th>
                        <th>Biaya Bank Appraisal</th>
                        <th>Biaya Bank Admin</th>
                        <th>Biaya Bank Provisi</th>
                        <th>Biaya Bank Asuransi</th>
                        <th>Biaya Bank Proses</th>
                        <th>Total Biaya Bank</th>
                        <th>Biaya Notaris Akte Jual Beli</th>
                        <th>Biaya Notaris Balik Nama</th>
                        <th>Biaya Notaris Akte SKMHT</th>
                        <th>Biaya Notaris Akte APHT</th>
                        <th>Biaya Notaris Perjanjian HT</th>
                        <th>Biaya Notaris Ccek Sertifikat</th>
                        <th>Total Biaya Notaris</th>
                        <th>Angsuran Per Bulan</th>
                        <th>Pembayaran Pertama</th>
                        <th>Notes</th>
                        <th>Uang Muka</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script>
    function getDataHouseLoanConventional() {
        var jenis_simulasi =  $("#jenis_simulasi").val();
        var jenis_suku_bunga =  $("#jenis_suku_bunga").val();
        var sub_or_nonsub =  $("#sub_or_nonsub").val();
        var harga =  $("#harga").val();
        var uang_muka =  $("#uang_muka").val();
        var suku_bunga =  $("#suku_bunga").val();
        var lama_pinjaman =  $("#lama_pinjaman").val();
        var ms_kredit_fix =  $("#ms_kredit_fix").val();
        var sk_bga_flting =  $("#sk_bga_flting").val();

        $("#btn-save-conventional").text('Adding...');
        $.ajax({
            url: "{{ url('api/simulationHousingLoanConventional') }}",
            method: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                jenis_simulasi:"",
                jenis_suku_bunga:"",
                sub_or_nonsub:"",
                harga:"",
                uang_muka:"",
                suku_bunga:"",
                lama_pinjaman:"",
                ms_kredit_fix:"",
                sk_bga_flting:"",
            },
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                alert("Data has been successfully saved");
            }
        });
    }
</script>
    <script>
        // function getDataHouseLoanConventional(){
        //     alert("jenis_simulasi");

            // var jenis_simulasi =  $("#jenis_simulasi").val();
            // var jenis_suku_bunga =  $("#jenis_suku_bunga").val();
            // var sub_or_nonsub =  $("#sub_or_nonsub").val();
            // var harga =  $("#harga").val();
            // var uang_muka =  $("#uang_muka").val();
            // var suku_bunga =  $("#suku_bunga").val();
            // var lama_pinjaman =  $("#lama_pinjaman").val();
            // var ms_kredit_fix =  $("#ms_kredit_fix").val();
            // var sk_bga_flting =  $("#sk_bga_flting").val();
            // $("#btn-save-conventional").text('Adding...');
            // $.ajax({
            //     url: "{{ url('api/simulationHousingLoanConventional') }}",
            //     method: "POST",
            //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //     data: {
            //       jenis_simulasi:"",
            //       jenis_suku_bunga:"",
            //       sub_or_nonsub:"",
            //       harga:"",
            //       uang_muka:"",
            //       suku_bunga:"",
            //       lama_pinjaman:"",
            //       ms_kredit_fix:"",
            //       sk_bga_flting:""
            //     },
            //     cache: false,
            //     contentType: false,
            //     processData: false,
            //     dataType: 'json',
            //     success: function(response) {
            //         alert("Data has been successfully saved");
            //     }
            // });
        // }

    </script>

