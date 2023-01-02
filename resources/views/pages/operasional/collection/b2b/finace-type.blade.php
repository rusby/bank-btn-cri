    <div class=" box box-shadow">
    <h5 class="mt-3 mb-3">Finance Type List</h5>
    <table class="table table-hover table-bordered dataTable no-footer" style="width: 100%;" id="financetype-table" role="grid" aria-describedby="table-Datatable_info">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nl</th>
                <th>Urt</th>
            </tr>
        </thead>
    </table>
    <br>
</div>
    <script>
        loadDatatableFinanceType();
        function loadDatatableFinanceType(){
            var table = $('#financetype-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ url('api/financeType') }}",
                "type": "GET",
                "dataSrc":"data",
                "columns": [
                    {data: 'kd', name: 'kd'},
                    {data: 'nl', name: 'nl'},
                    {data: 'urt', name: 'urt'},
                ]
            });
        }    
    


    </script>
   