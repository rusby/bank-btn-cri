
<h5 class="mt-3 mb-3" style="padding:10px !important;">Job Information</h5>
<div class="statbox widget box box-shadow">
    <div style="padding:10px !important" id="tambah-data-housingloan">
        <form action="#" method="post" enctype="multipart/form-data" id="form_jobinformation"> 
            <div class="form-row" >
                <div class="form-group col-md-6 form-channel">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan" id="nama_perusahaan">
                </div>
                <div class="form-group col-md-6 form-no_ktp">
                    <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
                    <input type="text" class="form-control" name="jenis_pekerjaan" placeholder="Jenis Pekerjaan" id="jenis_pekerjaan">
                </div>
                <div class="form-group col-md-6 form-penghasilan">
                    <label for="penghasilan">Penghasilan</label>
                    <input type="text" class="form-control" name="penghasilan" placeholder="Penghasilan" id="penghasilan">
                </div>
                <div class="form-group col-md-6 form-jenis_pekerjaan_pasangan">
                    <label for="jenis_pekerjaan_pasangan">Jenis Pekerjaan Pasangan</label>
                    <input type="text" class="form-control" name="jenis_pekerjaan_pasangan" placeholder="Jenis Pekerjaan Pasangan" id="jenis_pekerjaan_pasangan">
                </div>
                <div class="form-group col-md-6 form-penghasilan_pasangan">
                    <label for="penghasilan_pasangan">Penghasilan Pasangan</label>
                    <input type="text" class="form-control" name="penghasilan_pasangan" placeholder="Penghasilan Pasangan" id="penghasilan_pasangan">
                </div>
                <div class="form-group col-md-6 form-biaya_rumah_tangga">
                    <label for="biaya_rumah_tangga">Biaya Rumah Tangga</label>
                    <input type="text" class="form-control" name="biaya_rumah_tangga" placeholder="Biaya Rumah Tangga" id="biaya_rumah_tangga">
                </div>
                <div class="form-group col-md-6 form-pengeluaran">
                    <label for="pengeluaran">Pengeluaran</label>
                    <input type="text" class="form-control" name="pengeluaran" placeholder="Pengeluaran" id="pengeluaran">
                </div>      
                <div class="form-group col-md-12 form-no_telp">
                    <button type="submit" class="btn btn-success mx-2 my-2 float-left savedata" id="btn-savedata">Save</button>   
                </div>
            </div>
        </form>
    </div>
</div>

 <script>
    
    $("#form_jobinformation").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#btn-savedata").text('Adding...');
        $.ajax({
            url: "{{ url('api/job-information') }}",
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