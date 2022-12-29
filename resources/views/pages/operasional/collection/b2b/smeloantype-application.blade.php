
<h5 class="mt-3 mb-3" style="padding:10px !important;">Insert SME Housing Loan Applicaation</h5>
<div class="statbox widget box box-shadow">
    <form action="#" method="post" enctype="multipart/form-data" id="form_smehousing">
        <div  style="padding:10px !important;" id="tambah-data-smehousingloan">
            <fieldset>
                <legend style="margin-bottom:10px;font-size:16px;">Informasi Data Pribadi</legend>
                <div class="form-row">
                    <div class="form-group col-md-6 form-channel">
                        <label for="channel">Channel</label>
                        <input type="text" class="form-control" name="channel" placeholder="channel" id="channel">
                    </div>
                    <div class="form-group col-md-6 form-cabang">
                        <label for="cabang">Branch Office</label>
                        <input type="text" class="form-control" name="cabang" placeholder="Bracnh Office" id="cabang">
                    </div>
                    <div class="form-group col-md-6 form-jenis_kredit">
                        <label for="jenis_kredit">Jenis Kredit</label>
                        <input type="text" class="form-control" name="jenis_kredit" placeholder="Jenis Kredit" id="jenis_kredit">
                    </div>
                    <div class="form-group col-md-6 form-nomor_ktp">
                        <label for="nomor_ktp">Nomor KTP</label>
                        <input type="number" class="form-control" name="nomor_ktp" placeholder="Nomor KTP" id="nomor_ktp">
                    </div>
                    <div class="form-group col-md-6 form-nama">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" id="nama">
                    </div>
                    <div class="form-group col-md-6 form-tempat_lahir">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" id="tempat_lahir">
                    </div>
                    <div class="form-group col-md-6 form-tanggal_lahir">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="text" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" id="tanggal_lahir">
                    </div>
                    <div class="form-group col-md-6 form-jenis_kelamin">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control jenis_kelamin" id="jenis_kelamin">
                            <option value="">Pilih </option>
                            <option value="Pria">Pria </option>
                            <option value="Wanita">Wanita </option>
                        </select>           
                    </div>
                    <div class="form-group col-md-6 form-nohp">
                        <label for="nohp">Nomor Handphone </label>
                        <input type="number" class="form-control" name="nohp" placeholder="Nomor Handphone" id="nohp">
                    </div>
                    <div class="form-group col-md-6 form-email">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" id="email">
                    </div>                
                    <div class="form-group col-md-6 form-alamat">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control" name="alamat" placeholder="Masukan Alamat" id="alamat"></textarea>
                    </div>
                    <div class="form-group col-md-6 form-rt">
                        <label for="rt">RT</label>
                        <input type="text" class="form-control" name="rt" placeholder="RT" id="rt">
                    </div>
                    <div class="form-group col-md-6 form-rw">
                        <label for="rw">RW</label>
                        <input type="text" class="form-control" name="rw" placeholder="RW" id="rw">
                    </div>
                    <div class="form-group col-md-6 form-select_prop">
                        <label for="select_prop">Select Propinsi</label>
                        <select name="i_prop" class="form-control select-prop" id="select_prop" onchange="selectPropinsi('bio')">
                            <option value="">Pilih </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 form-select_city" style="display:none;">
                        <label for="select_city">Select Kabupaten</label>
                        <select name="i_city" class="form-control select-city" id="select_city" onchange="selectKabupaten('bio')">
                            <option value="">Pilih </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 form-select_district" style="display:none;">
                        <label for="select_district">Select Kecamatan</label>
                        <select name="i_district" class="form-control select-district" id="select_district" onchange="selectKecamatan('bio')">
                            <option value="">Pilih </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 form-select_subdistrict" style="display:none;">
                        <label for="select_subdistrict">Kelurahan</label>
                        <select name="i_subdistrict" class="form-control select-subdistrict" id="select_subdistrict" >
                            <option value="">Pilih </option>
                        </select>
                    </div> 
                    <div class="form-group col-md-6 form-kodepos">
                        <label for="kodepos">Kode Pos</label>
                        <input type="text" class="form-control" name="kodepos" placeholder="Kode Pos" id="kodepos">
                    </div>
                    <div class="form-group col-md-6 form-status">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" name="status" placeholder="Status" id="status">
                    </div>
                </div>
            </fieldset>
           
            <fieldset>
                <legend style="margin-bottom:10px;font-size:16px;">Informasi Data Usaha</legend>
                <div class="form-row">
                    <div class="form-group col-md-6 form-alamat_usaha">
                        <label for="alamat_usaha">Alamat Usaha</label>
                        <textarea type="text" class="form-control" name="alamat_usaha" placeholder="Masukan Alamat Usaha" id="alamat_usaha"></textarea>
                    </div>
                    <div class="form-group col-md-6 form-rt_usaha">
                        <label for="rt_usaha">RT Tempat Usaha</label>
                        <input type="text" class="form-control" name="rt_usaha" placeholder="RT Tempat Usaha" id="rt_usaha">
                    </div>
                    <div class="form-group col-md-6 form-rw_usaha">
                        <label for="rw_usaha">RW Tempat Usaha</label>
                        <input type="text" class="form-control" name="rw_usaha" placeholder="RW Tempat Usaha" id="rw_usaha">
                    </div>
                    <div class="form-group col-md-6 form-select_prop_usaha">
                        <label for="select_prop_usaha">Select Propinsi</label>
                        <select name="i_prop_usaha" class="form-control select-prop_usaha" id="select_prop_usaha" onchange="selectPropinsi('usaha')">
                            <option value="">Pilih </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 form-select_city_usaha" style="display:none;">
                        <label for="select_city_usaha">Select Kabupaten</label>
                        <select name="i_city_usaha" class="form-control select-city_usaha" id="select_city_usaha" onchange="selectKabupaten('usaha')">
                            <option value="">Pilih </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 form-select_district_usaha" style="display:none;">
                        <label for="select_district_usaha">Select Kecamatan</label>
                        <select name="i_district_usaha" class="form-control select-district_usaha" id="select_district_usaha" onchange="selectKecamatan('usaha')">
                            <option value="">Pilih </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 form-select_subdistrict_usaha" style="display:none;">
                        <label for="select_subdistrict_usaha">Kelurahan</label>
                        <select name="i_subdistrict_usaha" class="form-control select-subdistrict_usaha" id="select_subdistrict_usaha" >
                            <option value="">Pilih </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 form-kodepos_usaha">
                        <label for="kodepos_usaha">Kode Pos Tempat Usaha</label>
                        <input type="text" class="form-control" name="kodepos_usaha" placeholder="Kode Pos Tempat Usaha" id="kodepos_usaha">
                    </div>
                    <div class="form-group col-md-6 form-status_tt">
                        <label for="status_tt">Status Tempat Usaha</label>
                        <input type="text" class="form-control" name="status_tt" placeholder="Status Tempat Usaha" id="status_tt">
                    </div>
                    <div class="form-group col-md-6 form-lama_usaha">
                        <label for="lama_usaha">Lama Tempat Usaha</label>
                        <input type="text" class="form-control" name="lama_usaha" placeholder="Lama Tempat Usaha" id="lama_usaha">
                    </div>
                    <div class="form-group col-md-6 form-nama_usaha">
                        <label for="nama_usaha">Nama Tempat Usaha</label>
                        <input type="text" class="form-control" name="nama_usaha" placeholder="Nama Tempat Usaha" id="nama_usaha">
                    </div>
                    <div class="form-group col-md-6 form-sektor_usaha">
                        <label for="sektor_usaha">Sektor Tempat Usaha</label>
                        <input type="text" class="form-control" name="sektor_usaha" placeholder="Lama Tempat Usaha" id="sektor_usaha">
                    </div>
                    <div class="form-group col-md-6 form-omset_usaha">
                        <label for="omset_usaha">Omset Tempat Usaha</label>
                        <input type="text" class="form-control" name="omset_usaha" placeholder="Nama Tempat Usaha" id="omset_usaha">
                    </div>         
                    <div class="form-group col-md-6 form-plafon_kur">
                        <label for="plafon_kur">Plaafon KUR</label>
                        <input type="text" class="form-control" name="plafon_kur" placeholder="Plaafon KUR" id="plafon_kur">
                    </div>
                    <div class="form-group col-md-6 form-tujuan_kur">
                        <label for="tujuan_kur">Tujuan KUR</label>
                        <input type="text" class="form-control" name="tujuan_kur" placeholder="Tujuan KUR" id="tujuan_kur">
                    </div>
                    <div class="form-group col-md-6 form-tujuan_detail">
                        <label for="tujuan_detail">Tujuan Detail</label>
                        <input type="text" class="form-control" name="tujuan_detail" placeholder="Tujuan Detail" id="tujuan_detail">
                    </div>                    
                    <div class="form-group col-md-6 form-jangka_waktu">
                        <label for="jangka_waktu">Jangka Waktu</label>
                        <input type="text" class="form-control" name="jangka_waktu" placeholder="Jangka Waktu" id="jangka_waktu">
                    </div>
                    <div class="form-group col-md-6 form-foto_debitur">
                        <label for="foto_debitur">Foto Debitur</label>
                        <input type="file" class="form-control" name="foto_debitur" placeholder="Foto Debitur" id="foto_debitur">
                    </div>
                    <div class="form-group col-md-6 form-foto_ktp">
                        <label for="foto_ktp">Foto KTP</label>
                        <input type="file" class="form-control" name="foto_ktp" placeholder="Foto KTP" id="foto_ktp">
                    </div>
                    <div class="form-group col-md-6 form-foto_npwp">
                        <label for="foto_npwp">Foto NPWP</label>
                        <input type="file" class="form-control" name="foto_npwp" placeholder="Foto NPWP" id="foto_npwp">
                    </div>
                    <div class="form-group col-md-6 form-foto_izin_usaha">
                        <label for="foto_izin_usaha">Foto Izin Usaha</label>
                        <input type="file" class="form-control" name="foto_izin_usaha" placeholder="Foto Izin Usaha" id="foto_izin_usaha">
                    </div>
                </div>
            </fieldset>
           
            <fieldset>
                <legend style="margin-bottom:10px;font-size:16px;">Informasi Data Pasangan</legend>
                <div class="form-row">
                    <div class="form-group col-md-6 form-status_menikah">
                        <label for="status_menikah">Status Menikah</label>
                        <input type="text" class="form-control" name="status_menikah" placeholder="Status Menikah" id="status_menikah">
                    </div>
                    <div class="form-group col-md-6 form-nama_pasangan">
                        <label for="nama_pasangan">Nama Pasangan</label>
                        <input type="text" class="form-control" name="nama_pasangan" placeholder="Nama Pasangan" id="nama_pasangan">
                    </div>
                    <div class="form-group col-md-6 form-hp_pasangan">
                        <label for="hp_pasangan">No Handphone Pasangan</label>
                        <input type="number" class="form-control" name="hp_pasangan" placeholder="No Handphone Pasangan" id="hp_pasangan">
                    </div>                    
                    <div class="form-group col-md-6 form-tempat_lahir_pasangan">
                        <label for="tempat_lahir_pasangan">Tempat Lahir Pasangan</label>
                        <input type="text" class="form-control" name="tempat_lahir_pasangan" placeholder="Tempat Lahir Pasangan" id="tempat_lahir_pasangan">
                    </div>
                    <div class="form-group col-md-6 form-tanggal_lahir_pasangan">
                        <label for="tanggal_lahir_pasangan">Tanggal Lahir Pasangan</label>
                        <input type="text" class="form-control" name="tanggal_lahir_pasangan" placeholder="Nama Pasangan" id="tanggal_lahir_pasangan">
                    </div>
                    <div class="form-group col-md-6 form-file_ktp_pasangan">
                        <label for="file_ktp_pasangan">File KTP Pasangan</label>
                        <input type="file" class="form-control" name="file_ktp_pasangan" placeholder="File KTP Pasangan" id="file_ktp_pasangan">
                    </div>
                </div>
            </fieldset>
            <div class="form-row">
            <button type="submit" class="btn btn-success mx-2 my-2 float-left savedata_sme" id="btn-savedata_sme">Save</button>
            </div>
        </div>
    </form>
</div>

 <script>
    getDataProperties();
    getDataProvice();
    getDataEmployment();

    flatpickr('#tanggal_lahir', {dateFormat: "Y-m-d"});
    flatpickr('#tanggal_lahir_pasangan', {dateFormat: "Y-m-d"});
    
    $("#form_smehousing").submit(function(e) {
        e.preventDefault();
        // var tanggal_lahir = $('#tanggal_lahir').val();
        const fd = new FormData(this);
        $("#btn-savedata_sme").text('Adding...');
        $.ajax({
            url: "{{ route('operasional.smeLoanInsertApplication') }}",
            method: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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


    function tambahDataHousingLoan(){
        $("#form-getdata-housing-loan").hide();
        $("#table-houseloan_list").hide();
        $("#tambah-data-housingloan").show();
    }
   
    // function getDataAction(){
    //     var channel = $("#channel").val();
    //     var bt = $("#bulan_tahun").val();
    //     var splitbt = bt.split(",");
    //     var bulan = splitbt[0];
    //     var tahun = splitbt[1];

    //     $.ajax({
    //         url : "{{ route('operasional.housingLoanApplicationList') }}",
    //         method : "GET",
    //         data : {
    //             channel:channel,
    //             bulan:bulan,
    //             tahun:tahun,
    //         },
    //         beforeSend: function() {
    //         },
    //         dataType : 'json',
    //         success: function(json){
    //             console.log(json);
    //             $("#table-houseloan_list").DataTable({
    //                 data: json.data,
    //                 "columns": [
    //                     {data: 'id', name: 'id'},
    //                     {data: 'nm_lnkp', name: 'nm_lnkp'},
    //                     {data: 'cbng', name: 'cbng'},
    //                     {data: 'tgl_msk', name: 'tgl_msk'},
    //                     {data: 'stts', name: 'stts'},
    //                     {data: 'nl_dstj', name: 'nl_dstj'},
    //                     {data: 'tgl_updt', name: 'tgl_updt'},
    //                 ]
    //             })
    //         }
    //     });
      
    // }

    function getDataEmployment(){
        $.ajax({
            url : "{{ route('operasional.employmentType') }}",
            method : "GET",
            dataType : 'json',
            success: function(json){
                var $el = $("#jenis_pekerjaan");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.kd).text(value.nl));
                })
            }
        });
    }

    function getDataProperties(){
        $.ajax({
            url : "{{ route('operasional.retrieveHousing') }}",
            method : "GET",
            dataType : 'json',
            success: function(json){
                var $el = $("#properties");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr({"value": value.ID, "data-cabang": value.CABANG}).text(value.NAMA_PROPER));
                })
            }
        });
    }

    function selectProperties(){
        var i_prpt = $("#properties").val();
        var cabang = $("#properties").find(':selected').attr('data-cabang')
        var i_prpt = $("#cabang").val(cabang).prop( "disabled", true );  
        // getDataBranch(i_prpt);
    } 

    function getDataProvice(){
        $.ajax({
            url : "{{ route('operasional.searchProvince') }}",
            method : "GET",
            dataType : 'json',
            success: function(json){
                var $el = $("#select_prop");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.n));
                });
                var $el_usaha = $("#select_prop_usaha");
                $el_usaha.empty(); 
                $.each(json.data , function (key, value) {
                    $el_usaha.append($("<option></option>").attr("value", value.id).text(value.n));
                })
            }
        });
    }

    function selectPropinsi(part){
        var i_prop = document.getElementById("select_prop").value;
        var i_prop_usaha = document.getElementById("select_prop_usaha").value;
        if(part == 'usaha'){
            var id = i_prop_usaha;
            $(".form-select_city_usaha").show();
        }else{
            $(".form-select_city").show();
            var id = i_prop;
        }
        getDataKabupaten(id, part);
    } 

    function getDataKabupaten(i_prop, part){
        $.ajax({
           url : "{{ route('operasional.searchCity') }}",
            method : "GET",
            data : {i_prop:i_prop},
            dataType : 'json',
            success: function(json){
                if(part == 'usaha'){
                    var $el = $("#select_city_usaha");
                }else{
                    var $el = $("#select_city");
                }
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.n));
                })
            }
        });
    }

    function selectKabupaten(part){
        var i_kot = document.getElementById("select_city").value;
        var i_kot_usaha = document.getElementById("select_city_usaha").value;
        if(part == 'usaha'){
            var id = i_kot_usaha;
            $(".form-select_district_usaha").show();
        }else{
            $(".form-select_district").show();
            var id = i_kot;
        }
        
        getDataKecamatan(id, part);

    }

    function getDataKecamatan(i_kot, part){
        $.ajax({
           url : "{{ route('operasional.searchDistrict') }}",
            method : "GET",
            data : {i_kot:i_kot},
            dataType : 'json',
            success: function(json){
                if(part == 'usaha'){
                    var $el = $("#select_district_usaha");
                }else{
                    var $el = $("#select_district");
                }
                
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.n));
                })
            }
        });
    }

    function selectKecamatan(part){
        var i_kec = document.getElementById("select_district").value;
        var i_kec_usaha = document.getElementById("select_district_usaha").value;
        if(part == 'usaha'){
            var id = i_kec_usaha;
            $(".form-select_subdistrict_usaha").show();
        }else{
            $(".form-select_subdistrict").show();
            var id = i_kec;
        }
        getDataKelurahan(id, part);
        
    }

    function getDataKelurahan(i_kec, part){
        $.ajax({
           url : "{{ route('operasional.searchSubDistrict') }}",
            method : "GET",
            data : {i_kec:i_kec},
            dataType : 'json',
            success: function(json){
                if(part == 'usaha'){
                    var $el = $("#select_subdistrict_usaha");
                }else{
                    var $el = $("#select_subdistrict");
                }
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.id).text(value.n));
                })
            }
        });
    }
</script>