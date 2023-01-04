
<h5 class="mt-3 mb-3" style="padding:10px !important;">Confirm Document</h5>
<div class="statbox widget box box-shadow">
    <div style="padding:10px !important" id="tambah-data-housingloan">
        <form action="#" method="post" enctype="multipart/form-data" id="form_confirmdocument"> 
            <div class="form-row" >
                <div class="form-group col-md-6 form-channel">
                    <label for="file_ktp">File KTP</label>
                    <input type="file" class="form-control" name="file_ktp" placeholder="File KTP" id="file_ktp">
                </div>
                <div class="form-group col-md-6 form-channel">
                    <label for="file_slip_gaji">File Slip Gaji</label>
                    <input type="file" class="form-control" name="file_slip_gaji" placeholder="File Slip Gaji" id="file_slip_gaji">
                </div>
                <div class="form-group col-md-6 form-channel">
                    <label for="file_rek_koran">File Rek Koran</label>
                    <input type="file" class="form-control" name="file_rek_koran" placeholder="File Rek Koran" id="file_rek_koran">
                </div>
                <div class="form-group col-md-6 form-channel">
                    <label for="file_pas_foto">File Pas Foto</label>
                    <input type="file" class="form-control" name="file_pas_foto" placeholder="File Pas Foto" id="file_pas_foto">
                </div>
                <div class="form-group col-md-12 form-no_telp">
                    <button type="submit" class="btn btn-success mx-2 my-2 float-left savedata" id="btn-savedata">Save</button>   
                </div>
            </div>
        </form>
    </div>
</div>

 <script>
    
    $("#form_confirmdocument").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#btn-savedata").text('Adding...');
        $.ajax({
            url: "{{ url('api/confirm-document') }}",
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