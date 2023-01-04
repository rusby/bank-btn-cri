
<h5 class="mt-3 mb-3" style="padding:10px !important;">Spouse Information</h5>
<div class="statbox widget box box-shadow">
    <div style="padding:10px !important" id="tambah-data-housingloan">
        <form action="#" method="post" enctype="multipart/form-data" id="form_spouseinformation"> 
            <div class="form-row" >
                <div class="form-group col-md-6 form-channel">
                    <label for="nama_lengkap_pasangan">Nama Lengkap Pasangan</label>
                    <input type="text" class="form-control" name="nama_lengkap_pasangan" placeholder="Nama Lengkap Pasangan" id="nama_lengkap_pasangan">
                </div>
                <div class="form-group col-md-6 form-no_ktp">
                    <label for="no_ktp_pasangan">No KTP Pasangan</label>
                    <input type="text" class="form-control" name="no_ktp_pasangan" placeholder="No KTP Pasangan" id="no_ktp_pasangan">
                </div>
                <div class="form-group col-md-6 form-tempat_lahir_pasangan">
                    <label for="tempat_lahir_pasangan">Tempat Lahir Pasangan</label>
                    <input type="text" class="form-control" name="tempat_lahir_pasangan" placeholder="Tempat Lahir Pasangan" id="tempat_lahir_pasangan">
                </div>      
                <div class="form-group col-md-6 form-tgl_lahir_pasangan">
                    <label for="tgl_lahir_pasangan">Tanggal Lahir Pasangan</label>
                    <input type="date" class="form-control" name="tgl_lahir_pasangan" placeholder="Tanggal Lahir" id="tgl_lahir_pasangan">
                </div>
                <div class="form-group col-md-12 form-no_telp">
                    <button type="submit" class="btn btn-success mx-2 my-2 float-left savedata" id="btn-savedata">Save</button>   
                </div>
            </div>
        </form>
    </div>
</div>

 <script>
    
    $("#form_spouseinformation").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#btn-savedata").text('Adding...');
        $.ajax({
            url: "{{ url('api/spouse-information') }}",
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