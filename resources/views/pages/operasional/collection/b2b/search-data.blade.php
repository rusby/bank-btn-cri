<h5 class="mt-3 mb-3" style="padding:10px !important;">Serach Data</h5>
<div class="statbox widget box box-shadow">
    <div class="form-row" style="padding:10px !important;">
        <div class="form-group col-md-12">
            <label for="select_option">Serach Data By</label>
            <select name="select-option" class="form-control select-option" id="select_option" onchange="selectOption()">
                <option value="">Pilih </option>
                <option value="propinsi">Province</option>
                <option value="city">City</option>
                <option value="district">District</option>
                <option value="subdistrict">Subdistrict</option>
                <option value="postcode">Post Code</option>
                <option value="branchoffice">Branch Office</option>
            </select>
        </div>
        <div class="form-group col-md-12 form-select_prop" style="display:none;">
            <label for="select_prop">Select Propinsi</label>
            <select name="select-prop" class="form-control select-prop" id="select_prop" onchange="selectPropinsi()">
                <option value="">Pilih </option>
            </select>
        </div>
        <div class="form-group col-md-12 form-select_city" style="display:none;">
            <label for="select_city">Select Kabupaten</label>
            <select name="select-city" class="form-control select-city" id="select_city" onchange="selectKabupaten()">
                <option value="">Pilih </option>
            </select>
        </div>
        <div class="form-group col-md-12 form-select_district" style="display:none;">
            <label for="select_district">Select Kecamatan</label>
            <select name="select-district" class="form-control select-district" id="select_district" onchange="selectKecamatan()">
                <option value="">Pilih </option>
            </select>
        </div>       
        <div class="form-group col-md-12 form-postcode" style="display:none;">
            <label for="poscode">Input postcode</label>
            <input type="text" class="form-control" name="poscode" placeholder="poscode" id="poscode">
        </div>
        <div class="form-group col-md-12 form-branchoffice" style="display:none;">
            <label for="id_branch">Input ID </label>
            <input type="text" class="form-control" name="id_branch" placeholder="ID" id="id_branch">
        </div>
        <div class="form-group col-md-12 form-jns" style="display:none;">
            <label for="jns">Input jns</label>
            <select name="jns" class="form-control jns" id="jns" >
                <option value="">Pilih </option>
                <option value="1">Konvensional</option>
                <option value="2">Syariah</option>
            </select>
        </div>
        
        <input type="hidden"  name="btn-action" id="btn-action" value="postcode_action"/>
        <button type="button" class="btn btn-success mx-2 my-2 float-right search" id="btn-search" style="display:none;" onClick="searchAction()">Search</button>   
    </div>
    <div  style="padding:10px !importantdisplay:none;;" id="table-propinsi" >
        <table class="table table-hover table-bordered dataTable no-footer"  id="table-result-prop" role="grid" aria-describedby="table-Datatable_info" >
            <thead>
                <tr>
                    <th>#ID Propinsi</th>
                    <th>Nama Propinsi</th>
                </tr>
            </thead>
        </table>
    </div>
    <div  style="padding:10px !important;display:none;" id="table-kabupaten" >
        <table class="table table-hover table-bordered dataTable no-footer"  id="table-result-city" role="grid" aria-describedby="table-Datatable_info" >
            <thead>
                <tr>
                    <th>#ID Kabupaten</th>
                    <th>Nama Kabupaten</th>
                    <th>Nama Propinsi</th>
                </tr>
            </thead>
        </table>
    </div>
     <div  style="padding:10px !important;display:none;" id="table-kecamatan" >
        <table class="table table-hover table-bordered dataTable no-footer" id="table-result-district" role="grid" aria-describedby="table-Datatable_info" >
            <thead>
                <tr>
                    <th>#ID Kecamatan</th>
                    <th>Nama Kecamatan</th>
                    <th>Nama Kabupaten</th>
                    <th>Nama Propinsi</th>
                </tr>
            </thead>
        </table>
    </div>
    <div  style="padding:10px !important;display:none;" id="table-kelurahan" >
        <table class="table table-hover table-bordered dataTable no-footer" id="table-result-subdistrict" role="grid" aria-describedby="table-Datatable_info" >
            <thead>
                <tr>
                    <th>#ID Kelurahan</th>
                    <th>Nama Kelurahan</th>
                    <th>Nama Kecamatan</th>
                    <th>Nama Kabupaten</th>
                    <th>Nama Propinsi</th>
                </tr>
            </thead>
        </table>
    </div>

    <div  style="padding:10px !important;display:none;" id="table-postcode" >
        <table class="table table-hover table-bordered dataTable no-footer" id="table-result-postcode" role="grid" aria-describedby="table-Datatable_info" >
            <thead>
                <tr>
                    <th>#ID Kelurahan</th>
                    <th>Nama Kelurahan</th>
                    <th>Nama Kecamatan</th>
                    <th>Nama Kabupaten</th>
                    <th>Nama Propinsi</th>
                    <th>Kode Pos</th>
                </tr>
            </thead>
        </table>
    </div>

    <div  style="padding:10px !important;display:none;" id="table-branchoffice" >
        <table class="table table-hover table-bordered dataTable no-footer" id="table-result-branchoffice" role="grid" aria-describedby="table-Datatable_info" >
            <thead>
                <tr>
                    <th>#ID Branch</th>
                    <th>Nama Kelurahan</th>
                    <th>Nama Kecamatan</th>
                    <th>Nama Kabupaten</th>
                    <th>Nama Propinsi</th>
                    <th>Cabang</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Fax</th>
                    <th>Email</th>
                    <th>Wilayah</th>
                    <th>Kode Pos</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
     $(document).ready(function (){
        $.ajax({
            url : "{{ url('api/searchProvince') }}",
            method : "GET",
            dataType : 'json',
            success: function(json){
                var $el = $("#select_prop");
                $el.empty(); 
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.n));
                })
            }
        });         
    }); 

    function selectOption(){
        $("#btn-search").hide();
        clearDataTable();
        var selopt = document.getElementById("select_option").value;
        if(selopt == "propinsi"){
            $(".form-select_prop").hide();
            $(".form-city").hide();
            $(".form-select_city").hide();
            $(".form-district").hide();
            $(".form-select_district").hide();
            $(".form-subdistrict").hide();
            $(".form-select_subdistrict").hide();
            $(".form-postcode").hide();
            $(".form-select_postcode").hide();
            $(".form-branchoffice").hide();

            $("#table-propinsi").show();
            $("#table-kabupaten").hide();
            $("#table-kecamatan").hide();
            $("#table-kelurahan").hide();
            $("#table-postcode").hide();
            var table = $('#table-result-prop').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ url('api/searchProvince') }}",
                "type": "GET",
                "dataSrc":"data",
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'n', name: 'n'},
                ]
            });

        }else if(selopt == "city"){
            $("#table-propinsi").hide();
            $("#table-kabupaten").show();
            $("#table-kecamatan").hide();
            $("#table-kelurahan").hide();
            $("#table-postcode").hide();

            $(".form-select_prop").show();
            $(".form-select_city").hide();            
            $(".form-city").show();
            $(".form-district").hide();
            $(".form-select_district").hide();
            $(".form-subdistrict").hide();
            $(".form-select_subdistrict").hide();
            $(".form-postcode").hide();
            $(".form-select_postcode").hide();
            $(".form-branchoffice").hide();
            getDataProvice();
        }else if(selopt == "district"){
            getDataProvice();

            $("#table-propinsi").hide();
            $("#table-kabupaten").hide();
            $("#table-kecamatan").show();
            $("#table-kelurahan").hide();

            $(".form-select_prop").show();
            $(".form-select_city").show();
            $(".form-district").show();
            $(".form-select_district").hide();
            $(".form-subdistrict").hide();
            $(".form-select_subdistrict").hide();
            $(".form-postcode").hide();
            $(".form-select_postcode").hide();
            $(".form-branchoffice").hide();
        }else if(selopt == "subdistrict"){
            getDataProvice();
            getDataKabupaten();

            $("#table-propinsi").hide();
            $("#table-kabupaten").hide();
            $("#table-kecamatan").hide();
            $("#table-kelurahan").show();
            $("#table-postcode").hide();

            $(".form-select_prop").show();
            $(".form-select_city").show();
            $(".form-select_district").show();
            $(".form-select_subdistrict").show();
            $(".form-district").show();
            $(".form-subdistrict").show();
            $(".form-postcode").hide();
            $(".form-select_postcode").hide();
            $(".form-branchoffice").hide();
        }else if(selopt == "postcode"){
            $("#btn-action").val("postcode_action"); 
            $("#table-propinsi").hide();
            $("#table-kabupaten").hide();
            $("#table-kecamatan").hide();
            $("#table-kelurahan").hide();
            $("#table-postcode").show();

            $("#btn-search").show();
            $(".form-select_prop").hide();
            $(".form-city").hide();
            $(".form-select_city").hide();
            $(".form-district").hide();
            $(".form-select_district").hide();
            $(".form-subdistrict").hide();
            $(".form-select_subdistrict").hide();
            $(".form-postcode").show();
            $(".form-select_postcode").hide();
            $(".form-branchoffice").hide();
        }else if(selopt == "branchoffice"){
            getDataProvice();
            getDataKabupaten();
            $("#table-propinsi").hide();
            $("#table-kabupaten").hide();
            $("#table-kecamatan").hide();
            $("#table-kelurahan").hide();
            $("#table-postcode").hide();
            $("#table-branchoffice").show();

            $("#btn-action").val("branchoffice"); 
            $(".form-branchoffice").show();
            // $(".form-select_sort").show();
            $(".form-select_prop").show();
            $(".form-select_city").show();
            $(".form-select_district").show();
            $(".form-select_subdistrict").show();
            $(".form-postcode").show();
            $(".form-jns").show();
            $("#btn-search").show();
        }
    }

    function getDataProvice(){
        $.ajax({
            url : "{{ url('api/searchProvince') }}",
            method : "GET",
            dataType : 'json',
            success: function(json){
                var $el = $("#select_prop");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.n));
                })
            }
        });
    }

    function selectPropinsi(){
        var i_prop = document.getElementById("select_prop").value;
        getDataKabupaten(i_prop);
        $.ajax({
            url : "{{ url('api/searchCity') }}",
            method : "GET",
            data : {i_prop:i_prop},
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                $("#table-result-city").DataTable({
                    data: json.data,
                    "columns": [
                        {data: 'id', name: 'id'},
                        {data: 'n', name: 'n'},
                        {data: 'n_prop', name: 'n_prop'},
                    ]
                })
            }
        });
    } 

    function getDataKabupaten(i_prop){
        clearDataTable();
        $.ajax({
           url : "{{ url('api/searchCity') }}",
            method : "GET",
            data : {i_prop:i_prop},
            dataType : 'json',
            success: function(json){
                var $el = $("#select_city");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.n));
                })
            }
        });
    }

    function selectKabupaten(){
        var i_kot = document.getElementById("select_city").value;
        getDataKecamatan(i_kot);
        $.ajax({
            url : "{{ url('api/searchDistrict') }}",
            method : "GET",
            data : {i_kot:i_kot},
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                console.log(json);
                $("#table-result-district").DataTable({
                    data: json.data,
                    "columns": [
                        {data: 'id', name: 'id'},
                        {data: 'n', name: 'n'},
                        {data: 'n_kot', name: 'n_kot'},
                        {data: 'n_prop', name: 'n_prop'},
                    ]
                })
            }
        });

    }

    function getDataKecamatan(i_kot){
        clearDataTable();

        $.ajax({
           url : "{{ url('api/searchDistrict') }}",
            method : "GET",
            data : {i_kot:i_kot},
            dataType : 'json',
            success: function(json){
                var $el = $("#select_district");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.n));
                })
            }
        });
    }

    function selectKecamatan(){
        var i_kec = document.getElementById("select_district").value;
        $.ajax({
            url : "{{ url('api/searchSubDistrict') }}",
            method : "GET",
            data : {i_kec:i_kec},
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                console.log(json);
                $("#table-result-subdistrict").DataTable({
                    data: json.data,
                    "columns": [
                        {data: 'id', name: 'id'},
                        {data: 'n', name: 'n'},
                        {data: 'n_kec', name: 'n_kec'},
                        {data: 'n_kot', name: 'n_kot'},
                        {data: 'n_prop', name: 'n_prop'},
                    ]
                })
            }
        });

    }

    function searchAction(){
       clearDataTable();

        var act = $("#btn-action").val(); 
        var i_prop = $("#select_prop").val();
        var i_kot = $("#select_city").val();
        var jns = $("#jns").val(); 
        var id = $("#id_branch").val(); 
        // var sort = $("#select_sort").val(); 
        var poscode = $("#poscode").val(); 

        if(act == "postcode_action"){
            $.ajax({
                url : "{{ url('api/searchPostCodeLocation') }}",
                method : "GET",
                data : {poscode:poscode},
                beforeSend: function() {
                },
                dataType : 'json',
                success: function(json){
                    console.log(json);
                    $("#table-result-postcode").DataTable({
                        data: json.data,
                        "columns": [
                            {data: 'i_kel', name: 'i_kel'},
                            {data: 'n_kel', name: 'n_kel'},
                            {data: 'n_kec', name: 'n_kec'},
                            {data: 'n_kot', name: 'n_kot'},
                            {data: 'n_prop', name: 'n_prop'},
                            {data: 'pos', name: 'pos'},
                        ]
                    })
                }
            });
        }else{
            $.ajax({
                url : "{{ url('api/searchBranchOffice') }}",
                method : "GET",
                data : {
                    i_prop:i_prop,
                    i_kot:i_kot,
                    jns:jns,
                    // sort:sort,
                    id:id,
                    poscode:poscode,
                },
                beforeSend: function() {
                },
                dataType : 'json',
                success: function(json){
                    console.log(json);
                    $("#table-result-branchoffice").DataTable({
                        data: json.data,
                        "columns": [
                            {data: 'id', name: 'id'},
                            {data: 'n_kel', name: 'n_kel'},
                            {data: 'n_kec', name: 'n_kec'},
                            {data: 'n_kot', name: 'n_kot'},
                            {data: 'n_prop', name: 'n_prop'},
                            {data: 'cbg', name: 'cbg'},
                            {data: 'almt', name: 'almt'},
                            {data: 'no_telp', name: 'no_telp'},
                            {data: 'no_fax', name: 'no_fax'},
                            {data: 'eml', name: 'eml'},
                            {data: 'wlyh', name: 'wlyh'},
                            {data: 'pos', name: 'pos'},
                        ]
                    })
                }
            });
        }
    }

    function clearDataTable(){
        $('#table-result-prop').DataTable().clear();
        $('#table-result-prop').DataTable().draw();
        $('#table-result-prop').DataTable().destroy();

        $('#table-result-city').DataTable().clear();
        $('#table-result-city').DataTable().draw();
        $('#table-result-city').DataTable().destroy();

        $('#table-result-district').DataTable().clear();
        $('#table-result-district').DataTable().draw();
        $('#table-result-district').DataTable().destroy();

        $('#table-result-subdistrict').DataTable().clear();
        $('#table-result-subdistrict').DataTable().draw();
        $('#table-result-subdistrict').DataTable().destroy();

        $('#table-result-postcode').DataTable().clear();
        $('#table-result-postcode').DataTable().draw();
        $('#table-result-postcode').DataTable().destroy();
        
        $('#table-result-branchoffice').DataTable().clear();
        $('#table-result-branchoffice').DataTable().draw();
        $('#table-result-branchoffice').DataTable().destroy();
    }

</script>
