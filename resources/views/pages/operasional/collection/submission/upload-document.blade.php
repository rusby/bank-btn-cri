
<h5 class="mt-3 mb-3" style="padding:10px !important;">Upload Document</h5>
<div class="statbox widget box box-shadow">
    <div style="padding:10px !important" id="tambah-data-housingloan">
        <form action="#" method="post" enctype="multipart/form-data" id="form_uploaddocument"> 
            <div class="form-row" >
                <div class="form-group col-md-6 form-channel">
                    <label for="document_file">Upload File</label>
                    <input type="file" class="form-control" name="document_file" placeholder="Upload File" id="document_file">
                </div>
                <div class="form-group col-md-12 form-no_telp">
                    <button type="submit" class="btn btn-success mx-2 my-2 float-left savedata" id="btn-savedata">Save</button>   
                </div>
            </div>
        </form>
    </div>
</div>

 <script>
    
    $("#form_uploaddocument").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#btn-savedata").text('Adding...');
        $.ajax({
            url: "{{ url('api/upload-document') }}",
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