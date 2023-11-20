<!DOCTYPE html>
<html>
<head>
    <title>Laravel Datatables Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Include CSS libraries -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <h2>Laravel 8 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-success" href="{{ route('login.create') }}">Create New User</a>
                <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
        
        
        <h6> Import and Export Excel data to database Using Laravel 5.8 </h6>
        <div class="card bg-light mt-3">
            <div class="card-header">
                Import and Export Excel data to database Using Laravel 5.8
            {{-- </div>
            <?php echo "hello"; ?> --}}
            <div class="card-body">
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button class="btn btn-success">Import User Data</button>
                    <a class="btn btn-warning" href="{{ route('export-users') }}">Export User Data</a>
                </form>
            </div>
        </div>
        <div class="alert alert-success" id="success-message" style="display: none;"></div>
        <div>
            <h2 class="mb-4">User Data</h2>
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        {{-- <th>Password</th> --}}
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</body>
<!-- Include JavaScript libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- Include DataTables Buttons extension JavaScript -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip', // Include the Buttons extension

            ajax: {
                url: "{{ route('importView') }}",
                type: 'GET',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' }
                // { data: 'password', name: 'password' }
            ],
            buttons: [
                {
                    extend: 'pdf',
                    text: 'Download as PDF',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                }
            ]
        });
    });
</script>
</html>
