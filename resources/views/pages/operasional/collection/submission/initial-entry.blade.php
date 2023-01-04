
<h5 class="mt-3 mb-3" style="padding:10px !important;">Initial Entry List</h5>
<div class="statbox widget box box-shadow">
    <div class="form-row " id="form-getdata-housing-loan" style="padding:10px !important;">
        <div class="form-group col-md-12 form-tahun">
            <label for="select_prop">Select Property</label>
            <select name="select-prop" class="form-control select-prop" id="select_prop" onchange="selectProperty()">
                <option value="">Pilih </option>
            </select>
        </div>
        <div class="form-group col-md-12 form-pengajuan">
            <label for="pengajuan">Type Pengajuan</label>
            <input type="text" class="form-control" name="pengajuan" placeholder="pengajuan" id="pengajuan">
        </div>
        <button type="button" class="btn btn-success mx-2 my-2 float-right search" id="btn-search" onClick="getDataAction()">Search</button>   
    </div>

    <div  style="padding:10px !important;display:none;" id="table-houseloan_list" >
        <table class="table table-hover table-bordered dataTable no-footer"  id="table-houseloan_list" role="grid" aria-describedby="table-Datatable_info" >
            <thead>
                <tr>
                    <th>#ID Loan</th>
                    <th>Nama Lengkap</th>
                    <th>Nama Cabang</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                    <th>Nilai</th>
                    <th>Tanggal Update</th>
                </tr>
            </thead>
        </table>
    </div>

    <div style="padding:10px !important;display:none;" id="tambah-data-housingloan">
        <form action="#" method="post" enctype="multipart/form-data" id="form_loanhousing"> 
            <div class="form-row" >
                <div class="form-group col-md-6 form-channel">
                    <label for="channel">Channel</label>
                    <input type="text" class="form-control" name="channel" placeholder="channel" id="channel">
                </div>
                <div class="form-group col-md-6 form-properties">
                    <label for="properties">Properties</label>
                    <select name="properties" class="form-control properties" id="properties" onchange="selectProperties()">
                        <option value="">Pilih </option>
                    </select>
                    <!-- <input type="text" class="form-control" name="properties" placeholder="properties" id="properties"> -->
                </div>
                <div class="form-group col-md-6 form-url_properties">
                    <label for="url_properties">Url Properties</label>
                    <input type="text" class="form-control" name="url_properties" placeholder="Url properties" id="url_properties">
                </div>
                <div class="form-group col-md-6 form-cabang">
                    <label for="cabang">Branch Office</label>
                    <input type="text" class="form-control" name="cabang" placeholder="Bracnh Office" id="cabang">
                </div>
                <div class="form-group col-md-6 form-jenis_pengajuan">
                    <label for="jenis_pengajuan">Jenis Pengajuan</label>
                    <select name="jenis_pengajuan" class="form-control jenis_pengajuan" id="jenis_pengajuan" onchange="selectjenis_pengajuan()">
                        <option value="">Pilih </option>
                        <option value="1">Konvensional</option>
                        <option value="2">Syariah</option>
                    </select>
                </div>
                <div class="form-group col-md-6 form-type_pengajuan">
                    <label for="type_pengajuan">Type Pengajuan</label>
                    <select name="type_pengajuan" class="form-control type_pengajuan" id="type_pengajuan">
                        <option value="">Pilih </option>
                    </select>
                </div>                
                <div class="form-group col-md-6 form-nilai_pengajuan">
                    <label for="nilai_pengajuan">Nilai Pengajuan</label>
                    <input type="text" class="form-control" name="nilai_pengajuan" placeholder="Nilai Pengajuan" id="nilai_pengajuan">
                </div>
                <div class="form-group col-md-6 form-nama_depan">
                    <label for="nama_depan">Nama Depan</label>
                    <input type="text" class="form-control" name="nama_depan" placeholder="Nama Depan" id="nama_depan">
                </div>
                <div class="form-group col-md-6 form-nama_tengah">
                    <label for="nama_tengah">Nama Tengah</label>
                    <input type="text" class="form-control" name="nama_tengah" placeholder="Nama Tengah" id="nama_tengah">
                </div>
                <div class="form-group col-md-6 form-nama_belakang">
                    <label for="nama_belakang">Nama Belakang</label>
                    <input type="text" class="form-control" name="nama_belakang" placeholder="Nama Belakang" id="nama_belakang">
                </div>
                <div class="form-group col-md-6 form-nomor_ktp">
                    <label for="nomor_ktp">Nomor KTP</label>
                    <input type="number" class="form-control" name="nomor_ktp" placeholder="Nomor KTP" id="nomor_ktp">
                </div>
                <div class="form-group col-md-6 form-tempat_lahir">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" id="tempat_lahir">
                </div>
                <div class="form-group col-md-6 form-tanggal_lahir">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="text" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" id="tanggal_lahir">
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
                <div class="form-group col-md-6 form-nohp2">
                    <label for="nohp2">Nomor Handphone 2</label>
                    <input type="number" class="form-control" name="nohp2" placeholder="Nomor Handphone 2" id="nohp2">
                </div>
                <div class="form-group col-md-6 form-nohp3">
                    <label for="nohp3">Nomor Handphone 3</label>
                    <input type="number" class="form-control" name="nohp3" placeholder="Nomor Handphone 3" id="nohp3">
                </div>
                <div class="form-group col-md-6 form-email">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" id="email">
                </div>
                <div class="form-group col-md-6 form-nama_perusahaan">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" class="form-control" name="nama_perusahaan" placeholder="Nama Perusahaan" id="nama_perusahaan">
                </div>
                <div class="form-group col-md-6 form-jenis_pekerjaan">
                    <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
                    <select name="jenis_pekerjaan" class="form-control select-district" id="jenis_pekerjaan">
                        <option value="">Pilih </option>
                    </select>
                    <!-- <input type="text" class="form-control" name="jenis_pekerjaan" placeholder="Jenis Pekerjaan" id="jenis_pekerjaan"> -->
                </div>
                <div class="form-group col-md-6 form-penghasilan">
                    <label for="penghasilan">Penghasilan</label>
                    <input type="number" class="form-control" name="penghasilan" placeholder="Penghasilan" id="penghasilan">
                </div>
                <div class="form-group col-md-6 form-tempat_lahir">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" id="tempat_lahir">
                </div>
                <div class="form-group col-md-6 form-biaya_rumahtangga">
                    <label for="biaya_rumahtangga">Biaya Rumah Tangga</label>
                    <input type="text" class="form-control" name="biaya_rumahtangga" placeholder="Biaya Rumah Tangga" id="biaya_rumahtangga">
                </div>
                <div class="form-group col-md-6 form-pengeluaran">
                    <label for="pengeluaran">Pengeluaran</label>
                    <input type="number" class="form-control" name="pengeluaran" placeholder="Pengeluaran" id="pengeluaran">
                </div>
                <div class="form-group col-md-6 form-file_ktp">
                    <label for="file_ktp">File KTP</label>
                    <input type="file" class="form-control" name="file_ktp" placeholder="File KTP" id="file_ktp">
                </div>
                <div class="form-group col-md-6 form-file_slip_penghasilan">
                    <label for="file_slip_penghasilan">File Slip Penghasilan</label>
                    <input type="file" class="form-control" name="file_slip_penghasilan" placeholder="File Slip Penghasilan" id="file_slip_penghasilan">
                </div>
                <div class="form-group col-md-6 form-file_pasphoto">
                    <label for="file_pasphoto">Pas Photo</label>
                    <input type="file" class="form-control" name="file_pasphoto" placeholder="Pas Photo" id="file_pasphoto">
                </div>
                <div class="form-group col-md-6 form-file_rekening_koran">
                    <label for="file_rekening_koran">File Rekening Koran</label>
                    <input type="file" class="form-control" name="file_rekening_koran" placeholder="File Rekening Koran" id="file_rekening_koran">
                </div>
                <div class="form-group col-md-12 form-no_telp">
                    <button type="submit" class="btn btn-success mx-2 my-2 float-left savedata" id="btn-savedata">Save</button>   
                </div>
            </div>
        </form>
    </div>
</div>

 <script>
    getDataProperties();
    function getDataProperties(){
        $.ajax({
            url : "{{url('api/retrieveHousing') }}",
            method : "GET",
            dataType : 'json',
            success: function(json){
                var $el = $("#select_prop");
                $el.empty(); 
                $el.append($("<option></option>").attr("value", "").text("Pilih"));
                $.each(json.data , function (key, value) {
                    $el.append($("<option></option>").attr("value", value.ID).text(value.NAMA_PROPER));
                })
            }
        });
    }
    // getDataProperties();
    // getDataProvice();
    // getDataEmployment();

    // flatpickr('#tanggal_lahir', {dateFormat: "Y-m-d"});
    
    // $("#form_loanhousing").submit(function(e) {
    //     e.preventDefault();
    //     // var tanggal_lahir = $('#tanggal_lahir').val();
    //     const fd = new FormData(this);
    //     $("#btn-savedata").text('Adding...');
    //     $.ajax({
    //         url: "{{ url('api/housingLoanInsertApplicationNonstock') }}",
    //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //         type: 'PATCH',
    //         method: "POST",
    //         data: fd,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         dataType: 'json',
    //         success: function(response) {
    //             alert("Data has been successfully saved");
    //         }
    //     });
    // });


    // config_bth = {
    //     plugins: [
    //         new monthSelectPlugin({
    //             shorthand: true, 
    //             dateFormat: "m-Y", 
    //             altFormat: "m-Y", 
    //             theme: "light",
    //         })
    //     ]
    // };

    // flatpickr('[name=bulan_tahun]', config_bth)

    // function tambahDataHousingLoan(){
    //     $("#form-getdata-housing-loan").hide();
    //     $("#table-houseloan_list").hide();
    //     $("#tambah-data-housingloan").show();
    // }
  
    function getDataAction(){
        var property = $("#select_prop").val();
        var pengajuan = $("#pengajuan").val();
        $.ajax({
            url : "{{ url('api/initial-entry') }}",
            method : "POST",
            data : {
                id_properti:property,
                type_pengajuan:pengajuan,
            },
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                console.log(json.data);
                if (json.data.length === 0){
                    alert("Data tidak ditemukan");
                }else{
                    $("#table-houseloan_list").DataTable({
                        data: json.data,
                        "columns": [
                            {data: 'id', name: 'id'},
                            {data: 'nm_lnkp', name: 'nm_lnkp'},
                            {data: 'cbng', name: 'cbng'},
                            {data: 'tgl_msk', name: 'tgl_msk'},
                            {data: 'stts', name: 'stts'},
                            {data: 'nl_dstj', name: 'nl_dstj'},
                            {data: 'tgl_updt', name: 'tgl_updt'},
                        ]
                    })
                }
               
            }
        });
      
    }

    // function getDataEmployment(){
    //     $.ajax({
    //         url : "{{url('api/employmentType') }}",
    //         method : "GET",
    //         dataType : 'json',
    //         success: function(json){
    //             var $el = $("#jenis_pekerjaan");
    //             $el.empty(); 
    //             $el.append($("<option></option>").attr("value", "").text("Pilih"));
    //             $.each(json.data , function (key, value) {
    //                 $el.append($("<option></option>").attr("value", value.kd).text(value.nl));
    //             })
    //         }
    //     });
    // }

    // function getDataProperties(){
    //     $.ajax({
    //         url : "{{url('api/retrieveHousing') }}",
    //         method : "GET",
    //         dataType : 'json',
    //         success: function(json){
    //             var $el = $("#properties");
    //             $el.empty(); 
    //             $el.append($("<option></option>").attr("value", "").text("Pilih"));
    //             $.each(json.data , function (key, value) {
    //                 $el.append($("<option></option>").attr({"value": value.ID, "data-cabang": value.CABANG}).text(value.NAMA_PROPER));
    //             })
    //         }
    //     });
    // }

    // function selectProperties(){
    //     var i_prpt = $("#properties").val();
    //     var cabang = $("#properties").find(':selected').attr('data-cabang')
    //     var i_prpt = $("#cabang").val(cabang).prop( "disabled", true );  
    //     // getDataBranch(i_prpt);
    // }
    
    // function selectjenis_pengajuan(){
    //     var jns_pngjn = $("#jenis_pengajuan").val();
    //     if(jns_pngjn == '1'){
    //         // typ_pgjn didapatkan dari Loan Type (untuk konvensional)
    //         $.ajax({
    //             url : "{{url('api/loanType') }}",
    //             method : "GET",
    //             dataType : 'json',
    //             success: function(json){
    //                 var $el = $("#type_pengajuan");
    //                 $el.empty(); 
    //                 $el.append($("<option></option>").attr("value", "").text("Pilih"));
    //                 $.each(json.data , function (key, value) {
    //                     $el.append($("<option></option>").attr({"value": value.kd, "data-nl": value.nl}).text(value.nl));
    //                 })
    //             }
    //         });

    //     }else{
    //         // typ_pgjn didapatkan dari service Financing Type (untuk syariah)
    //         $.ajax({
    //             url : "{{url('api/financeType') }}",
    //             method : "GET",
    //             dataType : 'json',
    //             success: function(json){
    //                 var $el = $("#type_pengajuan");
    //                 $el.empty(); 
    //                 $.each(json.data , function (key, value) {
    //                     $el.append($("<option></option>").attr({"value": value.kd, "data-nl": value.nl}).text(value.nl));
    //                 })
    //             }
    //         });           

    //     }
    // }

    // function getDataProvice(){
    //     $.ajax({
    //         url : "{{url('api/searchProvince') }}",
    //         method : "GET",
    //         dataType : 'json',
    //         success: function(json){
    //             var $el = $("#select_prop");
    //             $el.empty(); 
    //             $el.append($("<option></option>").attr("value", "").text("Pilih"));
    //             $.each(json.data , function (key, value) {
    //                 $el.append($("<option></option>").attr("value", value.id).text(value.n));
    //             })
    //         }
    //     });
    // }

    // function selectPropinsi(){
    //     var i_prop = document.getElementById("select_prop").value;
    //     getDataKabupaten(i_prop);
    //     $(".form-select_city").show();
    // } 

    // function getDataKabupaten(i_prop){
    //     $.ajax({
    //        url : "{{url('api/searchCity') }}",
    //         method : "GET",
    //         data : {i_prop:i_prop},
    //         dataType : 'json',
    //         success: function(json){
    //             var $el = $("#select_city");
    //             $el.empty(); 
    //             $el.append($("<option></option>").attr("value", "").text("Pilih"));
    //             $.each(json.data , function (key, value) {
    //                 $el.append($("<option></option>").attr("value", value.id).text(value.n));
    //             })
    //         }
    //     });
    // }

    // function selectKabupaten(){
    //     var i_kot = document.getElementById("select_city").value;
    //     getDataKecamatan(i_kot);
    //     $(".form-select_district").show();

    // }

    // function getDataKecamatan(i_kot){
    //     $.ajax({
    //        url : "{{url('api/searchDistrict') }}",
    //         method : "GET",
    //         data : {i_kot:i_kot},
    //         dataType : 'json',
    //         success: function(json){
    //             var $el = $("#select_district");
    //             $el.empty(); 
    //             $el.append($("<option></option>").attr("value", "").text("Pilih"));
    //             $.each(json.data , function (key, value) {
    //                 $el.append($("<option></option>").attr("value", value.id).text(value.n));
    //             })
    //         }
    //     });
    // }

    // function selectKecamatan(){
    //     var i_kec = document.getElementById("select_district").value;
    //     getDataKelurahan(i_kec);
    //     $(".form-select_subdistrict").show();
    // }

    // function getDataKelurahan(i_kec){
    //     $.ajax({
    //        url : "{{url('api/searchSubDistrict') }}",
    //         method : "GET",
    //         data : {i_kec:i_kec},
    //         dataType : 'json',
    //         success: function(json){
    //             var $el = $("#select_subdistrict");
    //             $el.empty(); 
    //             $el.append($("<option></option>").attr("value", "").text("Pilih"));
    //             $.each(json.data , function (key, value) {
    //                 $el.append($("<option></option>").attr("value", value.id).text(value.n));
    //             })
    //         }
    //     });
    // }
       
</script>