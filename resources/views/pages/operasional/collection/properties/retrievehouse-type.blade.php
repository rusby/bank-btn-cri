<h5 class="mt-3 mb-3" style="padding:10px !important;">Retrieve House Type</h5>
<div class="statbox widget box box-shadow">
    <div class="form-row" style="padding:10px !important;">
        <div class="form-group col-md-12">
            <label for="select_option">Select Properti</label>
            <select name="select-properties" class="form-control select-properties" id="select_properties">
                <option value="">Pilih </option>               
            </select>
        </div>        
        <div class="form-group col-md-12">
            <label for="halKe">Hal Ke</label>
            <input  type="text" class="form-control" name="halKe" id="halKe"/>
        </div>        
    </div>
    <div class="form-row" style="padding:10px !important;">
        <button type="button" class="btn btn-success mx-2 my-2 float-right search" id="btn-save"  onClick="getDataRetrieveHouseType()">Save</button>
    </div>
    <div  style="padding:10px !important;display:none;" id="table-retrieve-house-type" class="table table-responsive">
        <table class="table  table-hover table-bordered dataTable no-footer" id="table-result-retrieve_house_type" role="grid" aria-describedby="table-Datatable_info" >
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>NAMA PROPERTY</th>
                    <th>JENIS</th>
                    <th>KLASTER</th>
                    <th>BLOK</th>
                    <th>SUBSIDI</th>
                    <th>GBR1</th>
                    <th>LATITUDE</th>
                    <th>LONGITUDE</th>
                    <th>DESKRIPSI</th>      
                    <th>KAMAR TIDUR</th>
                    <th>KAMAR MANDI</th>
                    <th>FASILITAS</th>
                    <th>LANTAI</th>
                    <th>DAYA LISTRIK</th>
                    <th>LUAS TANAH</th>
                    <th>LUAS BANGUNAN</th>
                    <th>HARGA MULAI</th>
                    <th>HARGA SAMPAI</th>
                    <th>BOOKING FEE</th>
                    <th>SERTIFIKAT</th>
                    <th>ALAMAT</th>
                    <th>KODEPOS</th>
                    <th>CATATAN</th>
                    <th>GARASI LAMA</th>
                    <th>NAMA DEVELOPER</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    getDataProperties();

    function getDataProperties(){
        $.ajax({
            url : "{{ url('api/retrieveHousing') }}",
            method : "GET",
            dataType : 'json',
            success: function(json){
                var $el = $("#select_properties");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr({"value": value.ID, "data-cabang": value.CABANG}).text(value.NAMA_PROPER));
                })
            }
        });
    }

    function getDataRetrieveHouseType(){
        $("#table-retrieve-house-type").show();
        var proper_id    = $("#select_properties").val();
        var halKe    = $("#halKe").val();
        $("#btn-savedata").text('Adding...');
        $.ajax({
            url : "{{ url('api/retrieveHouseType') }}",
            method : "GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},            
            data : {
                proper_id:proper_id,
                halKe:halKe,
            },
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                // console.log(json.data);
                if (json.data.length === 0){
                    alert("Data tidak ditemukan");
                }else{
                    console.log(json);
                    $("#table-result-retrieve_house_type").DataTable({
                        data: json.data,
                        "columns": [
                            {data: 'ID', name: 'ID'},
                            {data: 'NAMA', name: 'NAMA'},
                            {data: 'JENIS', name: 'JENIS'},
                            {data: 'KLASTER', name: 'KLASTER'},
                            {data: 'BLOK', name: 'BLOK'},
                            {data: 'SUBSIDI', name: 'SUBSIDI'},
                            {data: 'GBR1', name: 'GBR1'},
                            {data: 'LATITUDE', name: 'LATITUDE'},
                            {data: 'LONGITUDE', name: 'LONGITUDE'},
                            {data: 'DESKRIPSI', name: 'DESKRIPSI'},
                            {data: 'KAMAR_TIDUR', name: 'KAMAR_TIDUR'},
                            {data: 'KAMAR_MANDI', name: 'KAMAR_MANDI'},
                            {data: 'FASILITAS', name: 'FASILITAS'},
                            {data: 'LANTAI', name: 'LANTAI'},
                            {data: 'DAYA_LISTRIK', name: 'DAYA_LISTRIK'},
                            {data: 'LUAS_TANAH', name: 'LUAS_TANAH'},
                            {data: 'LUAS_BANGUNAN', name: 'LUAS_BANGUNAN'},
                            {data: 'HARGA_MULAI', name: 'HARGA_MULAI'},
                            {data: 'HARGA_SAMPAI', name: 'HARGA_SAMPAI'},
                            {data: 'BOOKING_FEE', name: 'BOOKING_FEE'},
                            {data: 'SERTIFIKAT', name: 'SERTIFIKAT'},
                            {data: 'ALAMAT', name: 'ALAMAT'},
                            {data: 'KODEPOS', name: 'KODEPOS'},
                            {data: 'CATATAN', name: 'CATATAN'},
                            {data: 'GARASI_LAMA', name: 'GARASI_LAMA'},
                            {data: 'NAMA_DEV', name: 'NAMA_DEV'},
                        ]
                    })
                }
               
            }
        });


    }

</script>

