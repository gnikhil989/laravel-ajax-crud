<!DOCTYPE html>
<html>
<head>
    <title>Laravel Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('todo.create') }}"> Create New Todo</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<div >
    <h2 class="mb-4">Laravel Yajra Datatables Example</h2>
    <table id="myTable" class="table table-bordered">
        <thead>

            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th>Date</th>
                <th>Time</th>
                <!-- <th>Price</th>
                <th>Quantity</th>
                <th>Date </th>
                <th>Time</th>       -->
                <th width="280px">Action</th>
            </tr>


        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script type="text/javascript">
    $(function () {
          var table = $('#myTable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('todos.index') }}",
              columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                // { data: 'price', name: 'price' },
                // { data: 'quantity', name: 'quantity' },
                // { data: 'date', name: 'date' }, // New date column
                //  { data: 'time', name: 'time' }, // New time column
                { data: 'action', name: 'action', orderable: false, searchable: false },
              ]
          });
        });
        
</script>
</html>