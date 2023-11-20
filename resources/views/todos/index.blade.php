<!DOCTYPE html>
<html>
<head>
    <title>Laravel Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Include CSS libraries -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('todos.create') }}"> Create New Todo</a>
            </div>
        </div>
    </div>
    @if(session('createSuccess'))
        <div class="alert alert-success">
            {{ session('createSuccess') }}
        </div>
    @endif
    <div class="alert alert-success" id="success-message" style="display: none;"></div>
    <div>
        <h2 class="mb-4">Laravel Yajra Datatables Example</h2>
        <table id="myTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th width="280px">Action</th>
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
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            ajax: {
                url: "{{ route('todos.index') }}",
                type: 'GET',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'date', name: 'date' },
                { data: 'time', name: 'time' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            buttons: [
                {
                    extend: 'pdf',
                    text: 'Download as pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] // Exclude action column
                    }
                }
            ]
        });

        // Use event delegation to handle delete button clicks
        $('#myTable').on('click', '.btn-primary', function () {
            var deleteLink = $(this).attr('href');

            $.ajax({
                url: deleteLink,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // Display the success message
                        var successMessage = $('#success-message');
                        successMessage.text(response.message);
                        successMessage.show();

                        // Reload the DataTable after deletion
                        table.ajax.reload();

                        // Hide the success message after a delay (5 seconds)
                        setTimeout(function() {
                            successMessage.hide();
                        }, 5000);
                    } else {
                        // Handle the case where the deletion was not successful
                        alert('Error deleting the todo.');
                    }
                },
                error: function () {
                    alert('Error deleting the todo.');
                }
            });

            return false;
        });
        
    });
</script>

</html>
