<h5 class="mt-3 mb-3" style="padding:10px !important;">Search Data</h5>
<div class="statbox widget box box-shadow">
    <form action="#" method="post" enctype="multipart/form-data" id="form_properti_search">
        <div class="form-row" style="padding:10px !important;">
            <div class="form-group col-md-6">
                <label for="lokasi">Lokasi</label>
                <input  type="text" class="form-control" name="lokasi" id="lokasi"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="hargaMin">Harga Minimal</label>
                <input  type="number" class="form-control" name="hargaMin" id="hargaMin"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="hargaMax">Harga Maximal</label>
                <input  type="number" class="form-control" name="hargaMax" id="hargaMax"/>
            </div> 
            <div class="form-group col-md-6">
                <label for="select_option">Select Properti</label>
                <select name="select-properties" class="form-control select-properties" id="select_properties" onchange="selectProperti()">
                    <option value="">Pilih </option>               
                </select>
            </div>
            <div class="form-group col-md-6" id="form-type_properti" style="display:none;">
                <label for="type_properti">Type Properti</label>
                <select name="type_properti" class="form-control type_properti" id="type_properti">
                    <option value="">Pilih </option>               
                </select>
            </div>       
            <div class="form-group col-md-6">
                <label for="kamarTidur">Kamar Tidur</label>
                <input  type="text" class="form-control" name="kamarTidur" id="kamarTidur"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="kamarMandi">Kamar Mandi</label>
                <input  type="text" class="form-control" name="kamarMandi" id="kamarMandi"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="namaDeveloper">Nama Developer</label>
                <input  type="text" class="form-control" name="namaDeveloper" id="namaDeveloper"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="namaProper">Nama Proper</label>
                <input  type="text" class="form-control" name="namaProper" id="namaProper"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="luasTanahMin">Luas Tanah Minimal</label>
                <input  type="text" class="form-control" name="luasTanahMin" id="luasTanahMin"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="luasTanahMax">Luas Tanah Maximal</label>
                <input  type="text" class="form-control" name="luasTanahMax" id="luasTanahMax"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="luasBangunanMin">Luas Bangunan Minimal</label>
                <input  type="text" class="form-control" name="luasBangunanMin" id="luasBangunanMin"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="luasBangunanMax">Luas Bangunan Maximal</label>
                <input  type="text" class="form-control" name="luasBangunanMax" id="luasBangunanMax"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="subsidi">Subsidi</label>
                <input  type="text" class="form-control" name="subsidi" id="subsidi"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="fasilitas">Fasilitas</label>
                <input  type="text" class="form-control" name="fasilitas" id="fasilitas"/>
            </div>       
            <div class="form-group col-md-6">
                <label for="sort">Sort</label>
                <select name="sort" class="form-control sort" id="sort" >
                    <option value="asc">Ascending </option>               
                    <option value="desc">Descending </option>               
                </select>
            </div>       
            <div class="form-group col-md-6">
                <label for="halKe">Hal Ke</label>
                <input  type="text" class="form-control" name="halKe" id="halKe"/>
            </div>        
        </div>
        <div class="form-row" style="padding:10px !important;">
            <button type="submit" class="btn btn-success mx-2 my-2 float-right search" id="btn-save" >Save</button>
        </div>
    </form>
    <div  style="padding:10px !important;" id="table-searchproperti" class="table table-responsive">
        <table class="table  table-hover table-bordered dataTable no-footer" id="table-result-searchproperti" role="grid" aria-describedby="table-Datatable_info" >
            <thead>
                <tr>               
                    <th>#ID</th>
                    <th>NAMA PROPERTY</th>
                    <th>NAMA DEVELOPER</th>
                    <th>JENIS</th>
                    <th>CABANG</th>
                    <th>HARGA MULAI</th>
                    <th>HARGA SAMPAI</th>
                    <th>FASILITAS</th>
                    <th>LOGO</th>
                    <th>GBR</th>
                    <th>EMBED 360</th>
                    <th>DESKRIPSI</th>
                    <th>NOMOR TELEPON</th>
                    <th>ALAMAT</th>
                    <th>PROPINSI</th>
                    <th>KABUPATEN</th>
                    <th>KECAMATAN</th>
                    <th>KELURAHAN</th>
                    <th>KODE POS</th>                    
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    getAllData();
    getDataProperties();

    $("#form_properti_search").submit(function(e) {
        e.preventDefault();
        var formValues= $(this).serialize();
        $("#table-searchproperti").show();
        $.ajax({
            url : "{{ url('api/propertySearch') }}",
            method : "GET",
            data : formValues,
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                console.log(json);
                $("#table-result-searchproperti").DataTable({
                    data: json.data,
                    "columns": [
                        {data: 'ID', name: 'ID'},
                        {data: 'NAMA_PROPER', name: 'NAMA_PROPER'},
                        {data: 'NAMA_DEV', name: 'NAMA_DEV'},
                        {data: 'JENIS', name: 'JENIS'},
                        {data: 'CABANG', name: 'CABANG'},
                        {data: 'HARGA_MULAI', name: 'HARGA_MULAI'},
                        {data: 'HARGA_SAMPAI', name: 'HARGA_SAMPAI'},
                        {data: 'FASILITAS', name: 'FASILITAS'},
                        {data: 'LOGO', name: 'LOGO'},
                        {data: 'GBR1', name: 'GBR1'},
                        {data: 'embed360', name: 'embed360'},
                        {data: 'GBR1', name: 'GBR1'},
                        {data: 'DESKRIPSI', name: 'DESKRIPSI'},
                        {data: 'NO_TELP', name: 'NO_TELP'},
                        {data: 'ALAMAT', name: 'ALAMAT'},
                        {data: 'PROV', name: 'PROV'},
                        {data: 'KOTA', name: 'KOTA'},
                        {data: 'KEC', name: 'KEC'},
                        {data: 'KEL', name: 'KEL'},
                        {data: 'KODE_POS', name: 'KODE_POS'},
                        {data: 'LAT', name: 'LAT'},
                        {data: 'LONG', name: 'LONG'},
                    ]
                })
            }
        });
    });


    function getAllData(){
        $("#table-retrieve-house-type").show();
        var formValues= $(this).serialize();
        $("#table-searchproperti").show();
        $.ajax({
            url : "{{ url('api/propertySearch') }}",
            method : "GET",
            data : formValues,
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                console.log(json.data);
                $("#table-result-searchproperti").DataTable({
                    data: json.data,
                    "columns": [
                        {data: 'ID', name: 'ID'},
                        {data: 'NAMA_PROPER', name: 'NAMA_PROPER'},
                        {data: 'NAMA_DEV', name: 'NAMA_DEV'},
                        {data: 'JENIS', name: 'JENIS'},
                        {data: 'CABANG', name: 'CABANG'},
                        {data: 'HARGA_MULAI', name: 'HARGA_MULAI'},
                        {data: 'HARGA_SAMPAI', name: 'HARGA_SAMPAI'},
                        {data: 'FASILITAS', name: 'FASILITAS'},
                        {data: 'LOGO', name: 'LOGO'},
                        {data: 'GBR1', name: 'GBR1'},
                        {data: 'embed360', name: 'embed360'},
                        {data: 'DESKRIPSI', name: 'DESKRIPSI'},
                        {data: 'NO_TELP', name: 'NO_TELP'},
                        {data: 'ALAMAT', name: 'ALAMAT'},
                        {data: 'PROV', name: 'PROV'},
                        {data: 'KOTA', name: 'KOTA'},
                        {data: 'KEC', name: 'KEC'},
                        {data: 'KEL', name: 'KEL'},
                        {data: 'KODE_POS', name: 'KODE_POS'},
                    ]
                })
            }
        });

    }

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

    function selectProperti(){
        $("#form-type_properti").show();
        var proper_id = $("#type_properti").val();
        $.ajax({
            url : "{{ url('api/retrieveHouseType') }}",
            method : "GET",
            data : {
                proper_id:proper_id,
                halKe:"",
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},   
            dataType : 'json',
            success: function(json){
                var $el = $("#type_properti");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr({"value": value.ID, "data-cabang": value.CABANG}).text(value.NAMA_PROPER));
                })
            }
        });
    }

</script>

