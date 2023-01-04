    <h5 class="mt-3 mb-3" style="padding:10px !important;">Housing Loan Sharia</h5>
    <div class="statbox widget box box-shadow">
        <div class="form-row" style="padding:10px !important;">
            <div class="form-group col-md-6 form-jenis_simulasi_sharia">
                <label for="jenis_simulasi_sharia">Jenis Simulasi</label>
                <input type="text" class="form-control" name="jenis_simulasi_sharia" placeholder="Jenis simulasi" id="jenis_simulasi_sharia">
            </div>
            <div class="form-group col-md-6 form-jenis_suku_bungai_sharia">
                <label for="jenis_suku_bunga_sharia">Jenis Suku Bunga</label>
                <input type="text" class="form-control" name="jenis_suku_bunga_sharia" placeholder="Jenis Suku Bunga" id="jenis_suku_bunga_sharia">
            </div>
            <div class="form-group col-md-6 form-sub_or_nonsub_sharia">
                <label for="sub_or_nonsub_sharia">Sub Non Sub</label>
                <input type="text" class="form-control" name="sub_or_nonsub_sharia" placeholder="Sub Non Sub" id="sub_or_nonsub_sharia">
            </div>       
            <div class="form-group col-md-6 form-harga_sharia">
                <label for="harga_sharia">Harga</label>
                <input type="number" class="form-control" name="harga_sharia" placeholder="Masukan harga" id="harga_sharia">
            </div>
            <div class="form-group col-md-6 form-uang_muka_sharia">
                <label for="uang_muka_sharia">Uang Muka</label>
                <input type="number" class="form-control" name="uang_muka_sharia" placeholder="Uang Muka" id="uang_muka_sharia">
            </div>
            <div class="form-group col-md-6 form-suku_bunga_sharia">
                <label for="suku_bunga_sharia">Suku Bunga</label>
                <input type="text" class="form-control" name="suku_bunga_sharia" placeholder="Suku Bunga" id="suku_bunga_sharia">
            </div>
            <div class="form-group col-md-6 form-lama_pinjaman_sharia">
                <label for="lama_pinjaman_sharia">Lama Pinjaman</label>
                <input type="text" class="form-control" name="lama_pinjaman_sharia" placeholder="Lama Pinjaman" id="lama_pinjaman_sharia">
            </div>
            <div class="form-group col-md-6 form-margin_total">
                <label for="margin_total">Margin Total</label>
                <input type="text" class="form-control" name="margin_total_sharia" placeholder="Margin Total" id="margin_total">
            </div>
            <div class="form-group col-md-12 ">
                <button type="button" class="btn btn-success mx-2 my-2 float-left save" id="btn-save"  onClick="getDataHouseLoanSharia()">Save</button>   
            </div>
        </div>
        <div   class="form-row" style="padding:10px !important;display:none;" id="table-sharia" >
            <table class="table table-hover table-responsive table-bordered dataTable no-footer" id="table-result-sharia" role="grid" aria-describedby="table-Datatable_info" >
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
        function getDataHouseLoanSharia() {
            var jenis_simulasi =  $("#jenis_simulasi_sharia").val();
            var jenis_suku_bunga =  $("#jenis_suku_bungai_sharia").val();
            var sub_or_nonsub =  $("#sub_or_nonsub_sharia").val();
            var harga =  $("#harga_sharia").val();
            var uang_muka =  $("#uang_muka_sharia").val();
            var suku_bunga =  $("#suku_bunga_sharia").val();
            var lama_pinjaman =  $("#lama_pinjaman_sharia").val();
            var ms_kredit_fix =  $("#margin_total").val();

            $("#btn-save-conventional").text('Adding...');
            $.ajax({
                url: "{{ url('api/simulationHousingLoanSharia') }}",
                method: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    jenis_simulasi:jenis_simulasi,
                    jenis_suku_bunga:jenis_suku_bunga,
                    sub_or_nonsub:sub_or_nonsub,
                    harga:harga,
                    uang_muka:uang_muka,
                    suku_bunga:suku_bunga,
                    lama_pinjaman:lama_pinjaman,
                    margin_total:margin_total,
                },
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $("#table-result-conventional").DataTable({
                        data: json.data,
                        "columns": [
                            {data: 'jns_simulasi', name: 'jns_simulasi'},
                            {data: 'suku_bunga', name: 'suku_bunga'},
                            {data: 'suku_bunga_float', name: 'suku_bunga_float'},
                            {data: 'kredit_fix', name: 'kredit_fix'},
                            {data: 'lama_pinjam', name: 'lama_pinjam'},
                            {data: 'uang_muka', name: 'uang_muka'},
                            {data: 'b_bank_appraisal', name: 'b_bank_appraisal'},
                            {data: 'b_bank_admin', name: 'b_bank_admin'},
                            {data: 'b_bank_provisi', name: 'b_bank_provisi'},
                            {data: 'b_bank_asuransi', name: 'b_bank_asuransi'},
                            {data: 'b_bank_proses', name: 'b_bank_proses'},
                            {data: 'total_biaya_bank', name: 'total_biaya_bank'},
                            {data: 'b_notaris_aktejualbeli', name: 'b_notaris_aktejualbeli'},
                            {data: 'b_notaris_baliknama', name: 'b_notaris_baliknama'},
                            {data: 'b_notaris_akte_skmht', name: 'b_notaris_akte_skmht'},
                            {data: 'b_notaris_akte_apht', name: 'b_notaris_akte_apht'},
                            {data: 'b_notaris_perjanjian_ht', name: 'b_notaris_perjanjian_ht'},
                            {data: 'b_notaris_cek_sertif', name: 'b_notaris_cek_sertif'},
                            {data: 'total_biaya_notaris', name: 'total_biaya_notaris'},
                            {data: 'angsuran_perbulan', name: 'angsuran_perbulan'},
                            {data: 'notes', name: 'notes'},
                        ]
                    })
                }
            });
        }
    </script>
  
