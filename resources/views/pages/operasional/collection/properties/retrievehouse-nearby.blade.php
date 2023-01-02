<h5 class="mt-3 mb-3" style="padding:10px !important;">Retrieve House Nearby</h5>
<div class="statbox widget box box-shadow">
    <form action="#" method="post" enctype="multipart/form-data" id="form_loanhouse_nearby"> 
        <div class="form-row" style="padding:10px !important;">
            <div class="form-group col-md-6 form-latitude">
                <label for="latitude">latitude</label>
                <input type="text" class="form-control" name="latitude" placeholder="latitude" id="latitude">
            </div>
            <div class="form-group col-md-6 form-longitude">
                <label for="longitude">longitude</label>
                <input type="text" class="form-control" name="longitude" placeholder="longitude" id="longitude">
            </div>
            <div class="form-group col-md-6 form-dist">
                <label for="dist">Dist</label>
                <input type="text" class="form-control" name="dist" placeholder="dist" id="dist">
            </div>
            <div class="form-group col-md-6 form-halKe">
                <label for="halKe">Hal ke</label>
                <input type="text" class="form-control" name="halKe" placeholder="halKe" id="halKe">
            </div>
            <div class="form-group col-md-6 form-no_telp">
                <button type="submit" class="btn btn-success mx-2 my-2 float-left savedata_nearby" id="btn-savedata_nearby">Save</button>   
            </div>
        </div>
    </form>

    <div  style="padding:10px !important; display:none;" id="table-retrieve-house-nearby" class="table table-responsive"  >
        <table class="table table-responsive table-hover table-bordered dataTable no-footer" id="table-result-retrieve-housenearby" role="grid" aria-describedby="table-Datatable_info" >
            <thead>         
                <tr>
                    <th>#ID</th>
                    <th>NAMA </th>
                    <th>LOGO</th>
                    <th>EMAIL</th>
                    <th>NOMOR TELEPON</th>
                    <th>NOMOR FAX</th>
                    <th>WEBSITE</th>
                    <th>ALAMAT</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $("#form_loanhouse_nearby").submit(function(e) {
        e.preventDefault();
        $("#table-retrieve-house-nearby").show();
        var lat = $('#latitude').val();
        var long = $('#longitude').val();
        var dist = $('#dist').val();
        var halKe = $('#halKe').val();
        $.ajax({
            url : "{{url('api/retrieveNearbyHousing') }}",
            method : "GET",
            data : {
                lat:lat,
                long:long,
                dist:dist,
                halKe:halKe,
            },
            beforeSend: function() {
            },
            dataType : 'json',
            success: function(json){
                console.log(json);
                $("#table-result-retrieve-housenearby").DataTable({
                    data: json.data,
                    "columns": [
                        {data: 'ID', name: 'ID'},
                        {data: 'NAMA', name: 'NAMA'},
                        {data: 'LOGO', name: 'LOGO'},
                        {data: 'EMAIL', name: 'EMAIL'},
                        {data: 'NO_TELP', name: 'NO_TELP'},
                        {data: 'NO_FAX', name: 'NO_FAX'},
                        {data: 'WEBSITE', name: 'WEBSITE'},
                        {data: 'ALAMAT', name: 'ALAMAT'},
                    ]
                })
            }
        });
    });

</script>