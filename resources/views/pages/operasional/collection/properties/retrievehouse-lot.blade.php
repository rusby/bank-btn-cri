<style>
    .modal-detail {
        width: 750px;
        margin: auto;
    }
</style>

<h5 class="mt-3 mb-3" style="padding:10px !important;">Retrieve House Lot</h5>
<div class="statbox widget box box-shadow">
    <div class="form-row" style="padding:10px !important;">
        <div class="form-group col-md-12">
            <label for="select_option">Select Properti</label>
            <select name="select-properties" class="form-control select-properties" id="select_retrieve-house" onchange="selectRetrieveHouse()">
                <option value="">Pilih </option>               
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="select_retrieve-housetype">House Type</label>
            <select name="select_retrieve-housetype" class="form-control select_retrieve-housetype" id="select_retrieve-housetype" onchange="selectRetrieveHouseType()">
                <option value="">Pilih </option>               
            </select>
        </div>
    </div>

    <div  style="padding:10px !important; display:none;" id="table-retrieve-house-type-lot" class="table table-responsive"  >
        <table class="table table-responsive table-hover table-bordered dataTable no-footer" id="table-result-retrieve-houselot" role="grid" aria-describedby="table-Datatable_info" >
            <thead>         
                <tr>
                    <th>#ID</th>
                    <th>NAMA NAMA</th>
                    <th>NAMA TIPE</th>
                    <th>NAMA DEVELOPER</th>
                    <th>NAMA PROPERTY</th>
                    <th>BLOK</th>
                    <th>NO</th>
                    <th>KLASTER</th>
                    <th>HARGA</th>
                    <th>BOOKING FEE</th>
                    <th>GBR1</th>
                    <th>GBR2</th>
                    <th>GBR3</th>
                    <th>GBR4</th>
                    <th>GBR5</th>
                    <th>EMBED360</th>
                    <th>DESKRIPSI</th>      
                    <th>SUBSIDI</th>
                    <th>LUAS TANAH</th>
                    <th>LUAS BANGUNAN</th>
                    <th>TAHUN_BANGUN</th>
                    <th>STATUS UNIT</th>
                    <th>ACTION</th>
                </tr>
            </thead>
        </table>
    </div>

    <div  style="padding:10px !important; display:none;" id="table-retrieve-house-type-lot_detail" class="table table-responsive"  >
        <table class="table table-responsive table-hover table-bordered dataTable no-footer" id="table-result-retrieve-houselot_detail" role="grid" aria-describedby="table-Datatable_info" >
            <thead>         
                <tr>
                    <th>#ID</th>
                    <th>NAMA NAMA</th>
                    <th>NAMA TIPE</th>
                    <th>NAMA DEVELOPER</th>
                    <th>NAMA PROPERTY</th>
                    <th>BLOK</th>
                    <th>NO</th>
                    <th>KLASTER</th>
                    <th>HARGA</th>
                    <th>BOOKING FEE</th>
                    <th>GBR1</th>
                    <th>GBR2</th>
                    <th>GBR3</th>
                    <th>GBR4</th>
                    <th>GBR5</th>
                    <th>EMBED360</th>
                    <th>DESKRIPSI</th>      
                    <th>SUBSIDI</th>
                    <th>LUAS TANAH</th>
                    <th>LUAS BANGUNAN</th>
                    <th>TAHUN_BANGUN</th>
                    <th>STATUS UNIT</th>
                </tr>
            </thead>
        </table>
    </div>

</div>

<script>
    getDataAllRetrieveHouse();
    function getDataAllRetrieveHouse(){
        $.ajax({
           url : "{{ route('operasional.retrieveHousing') }}",
            method : "GET",
            dataType : 'json',
            beforeSend: function() {
            },
            success: function(json){
                console.log(json);
                var $el = $("#select_retrieve-house");
                $el.empty(); 
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.ID).text(value.NAMA_PROPER));
                })
            }
        });
    }

    function selectRetrieveHouse(){
        var proper_id = $("#select_retrieve-house").val();
        getDataRetrieveHouseType(proper_id);
    } 

    function getDataRetrieveHouseType(proper_id){
        $.ajax({
           url : "{{ route('operasional.retrieveHouseType') }}",
            method : "GET",
            dataType : 'json',
            beforeSend: function() {
            },
            success: function(json){
                console.log(json);
                var $el = $("#select_retrieve-housetype");
                $el.empty(); 
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.ID).text(value.NAMA));
                })
            }
        });
    }

    function selectRetrieveHouseType(){
        $("#table-retrieve-house-type-lot").show();
        var tipeRumah_id = $("#select_retrieve-housetype").val();
        $.ajax({
           url : "{{ route('operasional.retrieveHouseLot') }}",
            method : "GET",
            data : {
                tipeRumah_id:tipeRumah_id,
            },
            dataType : 'json',
            beforeSend: function() {
            },
            success: function(json){
                // console.log(data);
                $("#table-result-retrieve-houselot").DataTable({
                    data: json.data,
                    "columns": [
                        {data: 'ID', name: 'ID'},
                        {data: 'NAMA', name: 'NAMA'},
                        {data: 'NAMA_TIPE', name: 'NAMA_TIPE'},
                        {data: 'NAMA_DEV', name: 'NAMA_DEV'},
                        {data: 'NAMA_PROPER', name: 'NAMA_PROPER'},
                        {data: 'BLOK', name: 'BLOK'},
                        {data: 'NO', name: 'NO'},
                        {data: 'KLASTER', name: 'KLASTER'},
                        {data: 'HARGA', name: 'HARGA'},
                        {data: 'BOOKING_FEE', name: 'BOOKING_FEE'},
                        {data: 'GBR1', name: 'GBR1'},
                        {data: 'GBR2', name: 'GBR2'},
                        {data: 'GBR3', name: 'GBR3'},
                        {data: 'GBR4', name: 'GBR4'},
                        {data: 'GBR5', name: 'GBR5'},
                        {data: 'EMBED360', name: 'EMBED360'},
                        {data: 'DESKRIPSI', name: 'DESKRIPSI'},
                        {data: 'SUBSIDI', name: 'SUBSIDI'},
                        {data: 'LUAS_TANAH', name: 'LUAS_TANAH'},
                        {data: 'LUAS_BANGUNAN', name: 'LUAS_BANGUNAN'},
                        {data: 'TAHUN_BANGUN', name: 'TAHUN_BANGUN'},
                        {data: 'STATUS_UNIT', name: 'STATUS_UNIT'},
                        {
                            data: 'ID',
                            "render": function ( data, type, row ) {
                                return '<button class="btn btn-primary" id="'+data+'" onclick="detailData(this.id)">Detail</button>';
                            }, 
                        },
                    ]
                })
            }
        });
    } 

    function  detailData(kavling_id){
        $("#table-retrieve-house-type-lot").hide();
        $("#table-retrieve-house-type-lot_detail").show();
        $.ajax({
           url : "{{ route('operasional.retrieveHouseLotById') }}",
            method : "GET",
            data : {
                kavling_id:kavling_id,
            },
            dataType : 'json',
            beforeSend: function() {
            },
            success: function(json){
                console.log(json.data);
                $("#table-result-retrieve-houselot_detail").DataTable({
                    data: json.data,
                    "columns": [
                        {data: 'ID', name: 'ID'},
                        {data: 'NAMA', name: 'NAMA'},
                        {data: 'NAMA_TIPE', name: 'NAMA_TIPE'},
                        {data: 'NAMA_DEV', name: 'NAMA_DEV'},
                        {data: 'NAMA_PROPER', name: 'NAMA_PROPER'},
                        {data: 'BLOK', name: 'BLOK'},
                        {data: 'NO', name: 'NO'},
                        {data: 'KLASTER', name: 'KLASTER'},
                        {data: 'HARGA', name: 'HARGA'},
                        {data: 'BOOKING_FEE', name: 'BOOKING_FEE'},
                        {data: 'GBR1', name: 'GBR1'},
                        {data: 'GBR2', name: 'GBR2'},
                        {data: 'GBR3', name: 'GBR3'},
                        {data: 'GBR4', name: 'GBR4'},
                        {data: 'GBR5', name: 'GBR5'},
                        {data: 'EMBED360', name: 'EMBED360'},
                        {data: 'DESKRIPSI', name: 'DESKRIPSI'},
                        {data: 'SUBSIDI', name: 'SUBSIDI'},
                        {data: 'LUAS_TANAH', name: 'LUAS_TANAH'},
                        {data: 'LUAS_BANGUNAN', name: 'LUAS_BANGUNAN'},
                        {data: 'TAHUN_BANGUN', name: 'TAHUN_BANGUN'},
                        {data: 'STATUS_UNIT', name: 'STATUS_UNIT'},
                    ]
                })
            }
        });
    }
</script>