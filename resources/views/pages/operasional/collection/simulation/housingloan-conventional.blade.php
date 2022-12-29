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
        <div class="form-group col-md-12 form-masa_kredit_fix">
            <label for="masa_kredit_fix">Masa Kredit FIx</label>
            <input type="text" class="form-control" name="masa_kredit_fix" placeholder="Masa Kredit FIx" id="masa_kredit_fix">
        </div>
        <div class="form-group col-md-12 form-suku_bunga_fiting">
            <label for="suku_bunga_fiting">Suku BUnga Fiting</label>
            <input type="text" class="form-control" name="suku_bunga_fiting" placeholder="Suku BUnga Fiting" id="suku_bunga_fiting">
        </div>
        <button type="button" class="btn btn-success mx-2 my-2 float-right save" id="btn-save"  onClick="getDataConventional()">Save</button>   
    </div>
    <div   class="form-row" style="padding:10px !important;display:none;" id="table-conventional" >
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

