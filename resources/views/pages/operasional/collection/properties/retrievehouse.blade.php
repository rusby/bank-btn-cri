<div class="statbox widget box box-shadow">
    <div class="form-row" style="padding:10px !important;">
        <div  style="padding:10px !important;" id="table_retrieve_house">
            <h5 class="mt-3 mb-3">Retreive House List</h5>
            <table class="table table-responsive table-hover table-bordered dataTable no-footer" style="width: 100%;" id="retrieve-house-table" role="grid" aria-describedby="table-Datatable_info">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>NAMA PROPERTY</th>
                        <th>JENIS</th>
                        <th>CABANG</th>
                        <th>HARGA MULAI</th>
                        <th>HARGA SAMPAI</th>
                        <th>FASILITAS</th>
                        <th>LOGO</th>
                        <th>GBR1</th>
                        <th>GBR2</th>
                        <th>GBR3</th>
                        <th>GBR4</th>
                        <th>GBR5</th>
                        <th>EMBED 360</th>
                        <th>DESKRIPSI</th>
                        <th>NO TELEPHONE</th>
                        <th>ALAMAT</th>
                        <th>PROPINSI</th>
                        <th>KABUPATEN</th>
                        <th>KECAMATAN</th>
                        <th>KELURAHAN</th>
                        <th>KODE POS</th>
                        <th>LATITUDE</th>
                        <th>LONGITUDE</th>
                        <th>PMT KONVENSIONAL</th>
                        <th>PMT SYARIAH</th>
                        <th>SUKU BUNGA</th>
                        <th>SUKU BUNGA SYARIAH</th>
                    </tr>
                </thead>
            </table>
            <br>
        </div>
    </div>
</div>
    
   <script>
        loadDatatableRetrieveHousing();
        
        function loadDatatableRetrieveHousing(){
            var table = $('#retrieve-house-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('operasional.retrieveHousing') }}",
                "type": "GET",
                "dataSrc":"data",
                "columns": [
                    {data: 'ID', name: 'ID'},
                    {data: 'NAMA_PROPER', name: 'NAMA_PROPER'},
                    {data: 'JENIS', name: 'JENIS'},
                    {data: 'CABANG', name: 'CABANG'},
                    {data: 'HARGA_MULAI', name: 'HARGA_MULAI'},
                    {data: 'HARGA_SAMPAI', name: 'HARGA_SAMPAI'},
                    {data: 'FASILITAS', name: 'FASILITAS'},
                    {data: 'LOGO', name: 'LOGO'},
                    {data: 'GBR1', name: 'GBR1'},
                    {data: 'GBR2', name: 'GBR2'},
                    {data: 'GBR3', name: 'GBR3'},
                    {data: 'GBR4', name: 'GBR4'},
                    {data: 'GBR5', name: 'GBR5'},
                    {data: 'embed360', name: 'embed360'},
                    {data: 'DESKRIPSI', name: 'DESKRIPSI'},
                    {data: 'NO_TELP', name: 'NO_TELP'},
                    {data: 'ALAMAT', name: 'ALAMAT'},
                    {data: 'PROV', name: 'PROV'},
                    {data: 'KOTA', name: 'KOTA'},
                    {data: 'KEC', name: 'KEC'},
                    {data: 'KEL', name: 'KEL'},
                    {data: 'KODE_POS', name: 'KODE_POS'},
                    {data: 'LATITUDE', name: 'LATITUDE'},
                    {data: 'LONGITUDE', name: 'LONGITUDE'},
                    {data: 'pmt_konvensional', name: 'pmt_konvensional'},
                    {data: 'pmt_syariah', name: 'pmt_syariah'},
                    {data: 'sk_bga', name: 'sk_bga'},
                    {data: 'sk_bga_syariah', name: 'sk_bga_syariah'},
                ]
            });
        }
        
    </script>