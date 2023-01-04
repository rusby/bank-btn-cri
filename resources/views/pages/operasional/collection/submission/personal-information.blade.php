
<h5 class="mt-3 mb-3" style="padding:10px !important;">Personal Information</h5>
<div class="statbox widget box box-shadow">
    <div style="padding:10px !important" id="tambah-data-housingloan">
        <form action="#" method="post" enctype="multipart/form-data" id="form_personalinformation"> 
            <div class="form-row" >
                <div class="form-group col-md-6 form-channel">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" id="nama_lengkap">
                </div>
                <div class="form-group col-md-6 form-no_ktp">
                    <label for="no_ktp">No KTP</label>
                    <input type="text" class="form-control" name="no_ktp" placeholder="No KTP" id="no_ktp">
                </div>
                <div class="form-group col-md-6 form-tempat_lahir">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" id="tempat_lahir">
                </div>      
                <div class="form-group col-md-6 form-tgl_lahir">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir" id="tgl_lahir">
                </div>
                <div class="form-group col-md-6 form-alamat">
                    <label for="alamat">Alamat</label>
                    <textarea type="text" class="form-control" name="alamat" placeholder="Alamat" id="alamat"></textarea>
                </div>
                <div class="form-group col-md-6 form-rt">
                    <label for="rt">RT</label>
                    <input type="text" class="form-control" name="rt" placeholder="RT" id="rt">
                </div>
                <div class="form-group col-md-6 form-rw">
                    <label for="rw">RW</label>
                    <input type="text" class="form-control" name="rw" placeholder="RW" id="rw">
                </div>
                <div class="form-group col-md-6 form-kodepos">
                    <label for="kodepos">Kode Pos</label>
                    <input type="text" class="form-control" name="kodepos" placeholder="Kode Pos" id="kodepos">
                </div>
                <div class="form-group col-md-6 form-select_prop">
                    <label for="select_prop">Select Propinsi</label>
                    <select name="i_prop" class="form-control select-prop" id="select_prop" onchange="selectPropinsi()">
                        <option value="">Pilih </option>
                    </select>
                </div>
                <div class="form-group col-md-6 form-select_city" style="display:none;">
                    <label for="select_city">Select Kabupaten</label>
                    <select name="i_city" class="form-control select-city" id="select_city" onchange="selectKabupaten()">
                        <option value="">Pilih </option>
                    </select>
                </div>
                <div class="form-group col-md-6 form-select_district" style="display:none;">
                    <label for="select_district">Select Kecamatan</label>
                    <select name="i_district" class="form-control select-district" id="select_district" onchange="selectKecamatan()">
                        <option value="">Pilih </option>
                    </select>
                </div>
                <div class="form-group col-md-6 form-select_subdistrict" style="display:none;">
                    <label for="select_subdistrict">Kelurahan</label>
                    <select name="i_subdistrict" class="form-control select-subdistrict" id="select_subdistrict" onchange="selectKelurahan()">
                        <option value="">Pilih </option>
                    </select>
                </div> 
                <div class="form-group col-md-6 form-no_telp">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="number" class="form-control" name="no_telp" placeholder="Nomor Telepon" id="no_telp">
                </div>
                <div class="form-group col-md-6 form-nohp1">
                    <label for="nohp1">Nomor Handphone 1</label>
                    <input type="number" class="form-control" name="nohp1" placeholder="Nomor Handphone 1" id="nohp1">
                </div>
                <div class="form-group col-md-6 form-email">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" id="email">
                </div>
                <div class="form-group col-md-6 form-status_nikah">
                    <label for="status_nikah">Status Nikah</label>
                    <input type="text" class="form-control" name="status_nikah" placeholder="Status Nikah" id="status_nikah">
                </div>
                <div class="form-group col-md-12 form-no_telp">
                    <button type="submit" class="btn btn-success mx-2 my-2 float-left savedata" id="btn-savedata">Save</button>   
                </div>
            </div>
        </form>
    </div>
</div>

 <script>
    getDataProvice();

    flatpickr('#tanggal_lahir', {dateFormat: "Y-m-d"});
    
    $("#form_personalinformation").submit(function(e) {
        e.preventDefault();
        // var tanggal_lahir = $('#tanggal_lahir').val();
        const fd = new FormData(this);
        $("#btn-savedata").text('Adding...');
        $.ajax({
            url: "{{ url('api/personal-information') }}",
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

    function selectProperties(){
        var i_prpt = $("#properties").val();
        var cabang = $("#properties").find(':selected').attr('data-cabang')
        var i_prpt = $("#cabang").val(cabang).prop( "disabled", true );  
        // getDataBranch(i_prpt);
    }

    function getDataProvice(){
        $.ajax({
            url : "{{url('api/searchProvince') }}",
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
        $(".form-select_city").show();
    } 

    function getDataKabupaten(i_prop){
        $.ajax({
           url : "{{url('api/searchCity') }}",
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
        $(".form-select_district").show();

    }

    function getDataKecamatan(i_kot){
        $.ajax({
           url : "{{url('api/searchDistrict') }}",
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
        getDataKelurahan(i_kec);
        $(".form-select_subdistrict").show();
    }

    function getDataKelurahan(i_kec){
        $.ajax({
           url : "{{url('api/searchSubDistrict') }}",
            method : "GET",
            data : {i_kec:i_kec},
            dataType : 'json',
            success: function(json){
                var $el = $("#select_subdistrict");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.n));
                })
            }
        });
    }
       
</script>