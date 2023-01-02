<h5 class="mt-3 mb-3">Loan Type List</h5>
    <table class="table table-hover table-bordered dataTable no-footer" style="width: 100%;" id="loantype-table" role="grid" aria-describedby="table-Datatable_info">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nl</th>
                <th>Urt</th>
            </tr>
        </thead>
    </table>
    <br>
    <script>
        loadDatatableLoanType();
        function loadDatatableLoanType(){
            var table = $('#loantype-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ url('api/loanType') }}",
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