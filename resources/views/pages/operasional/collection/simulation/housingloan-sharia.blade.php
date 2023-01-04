    <h5 class="mt-3 mb-3" style="padding:10px !important;">Housing Loan Sharia</h5>
    <div class="statbox widget box box-shadow">
        <div class="form-row" style="padding:10px !important;">
            <div class="form-group col-md-12 form-jenis_simulasi_sharia">
                <label for="jenis_simulasi_sharia">Jenis Simulasi</label>
                <input type="text" class="form-control" name="jenis_simulasi_sharia" placeholder="Jenis simulasi" id="jenis_simulasi_sharia">
            </div>
            <div class="form-group col-md-12 form-jenis_suku_bungai_sharia">
                <label for="jenis_suku_bunga_sharia">Jenis Suku Bunga</label>
                <input type="text" class="form-control" name="jenis_suku_bunga_sharia" placeholder="Jenis Suku Bunga" id="jenis_suku_bunga_sharia">
            </div>
            <div class="form-group col-md-12 form-sub_or_nonsub_sharia">
                <label for="sub_or_nonsub_sharia">Sub Non Sub</label>
                <input type="text" class="form-control" name="sub_or_nonsub_sharia" placeholder="Sub Non Sub" id="sub_or_nonsub_sharia">
            </div>       
            <div class="form-group col-md-12 form-harga_sharia">
                <label for="harga_sharia">Harga</label>
                <input type="number" class="form-control" name="harga_sharia" placeholder="Masukan harga" id="harga_sharia">
            </div>
            <div class="form-group col-md-12 form-uang_muka_sharia">
                <label for="uang_muka_sharia">Uang Muka</label>
                <input type="number" class="form-control" name="uang_muka_sharia" placeholder="Uang Muka" id="uang_muka_sharia">
            </div>
            <div class="form-group col-md-12 form-suku_bunga_sharia">
                <label for="suku_bunga_sharia">Suku Bunga</label>
                <input type="text" class="form-control" name="suku_bunga_sharia" placeholder="Suku Bunga" id="suku_bunga_sharia">
            </div>
            <div class="form-group col-md-12 form-lama_pinjaman_sharia">
                <label for="lama_pinjaman_sharia">Lama Pinjaman</label>
                <input type="text" class="form-control" name="lama_pinjaman_sharia" placeholder="Lama Pinjaman" id="lama_pinjaman_sharia">
            </div>
            <div class="form-group col-md-12 form-margin_total">
                <label for="margin_total">Margin Total</label>
                <input type="text" class="form-control" name="margin_total_sharia" placeholder="Margin Total" id="margin_total">
            </div>
            
            <button type="button" class="btn btn-success mx-2 my-2 float-right save" id="btn-save"  onClick="getDataSharia()">Save</button>   
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

  
