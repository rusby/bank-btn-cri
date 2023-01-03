
<h5 class="mt-3 mb-3" style="padding:10px !important;">Loan Application</h5>
<div class="statbox widget box box-shadow">
    <div style="padding:10px !important" id="tambah-data-housingloan">
        <form action="#" method="post" enctype="multipart/form-data" id="form_loanapplication"> 
            <div class="form-row" >
                <div class="form-group col-md-6 form-channel">
                    <label for="cabang">Cabang</label>
                    <input type="text" class="form-control" name="cabang" placeholder="Cabang" id="cabang">
                </div>
                <div class="form-group col-md-6 form-harga_jual">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="text" class="form-control" name="harga_jual" placeholder="Harga Jual" id="harga_jual">
                </div>
                <div class="form-group col-md-6 form-uang_muka">
                    <label for="uang_muka">Uang Muka</label>
                    <input type="text" class="form-control" name="uang_muka" placeholder="Uang Muka" id="uang_muka">
                </div>
                <div class="form-group col-md-6 form-nilai_pembiyaan">
                    <label for="nilai_pembiyaan">Nilai Pembiyaan</label>
                    <input type="text" class="form-control" name="nilai_pembiyaan" placeholder="Nilai Pembiyaan" id="nilai_pembiyaan">
                </div>
                <div class="form-group col-md-6 form-jangka_waktu">
                    <label for="jangka_waktu">Jangka Waktu</label>
                    <input type="text" class="form-control" name="jangka_waktu" placeholder="Jangka Waktu" id="jangka_waktu">
                </div>
                <div class="form-group col-md-6 form-jenis_suku_bunga">
                    <label for="jenis_suku_bunga">Jenis Suku Bunga</label>
                    <input type="text" class="form-control" name="jenis_suku_bunga" placeholder="Jenis Suku Bunga" id="jenis_suku_bunga">
                </div>
                <div class="form-group col-md-6 form-bunga">
                    <label for="bunga">Bunga</label>
                    <input type="text" class="form-control" name="bunga" placeholder="Bunga" id="bunga">
                </div>
                <div class="form-group col-md-6 form-angsuran">
                    <label for="angsuran">Angsuran</label>
                    <input type="text" class="form-control" name="angsuran" placeholder="Angsuran" id="angsuran">
                </div>
                <div class="form-group col-md-6 form-total_angsuran">
                    <label for="total_angsuran">Total Angsuran</label>
                    <input type="text" class="form-control" name="total_angsuran" placeholder="Total Angsuran" id="total_angsuran">
                </div>
                <div class="form-group col-md-12 form-no_telp">
                    <button type="submit" class="btn btn-success mx-2 my-2 float-left savedata" id="btn-savedata">Save</button>   
                </div>
            </div>
        </form>
    </div>
</div>

 <script>
    
    $("#form_loanapplication").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#btn-savedata").text('Adding...');
        $.ajax({
            url: "{{ url('api/loan-application') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'PATCH',
            method: "POST",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                alert("Data has been successfully saved");
            }
        });
    });
       
</script>