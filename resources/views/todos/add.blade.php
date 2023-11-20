@extends('todos.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Todo</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('todos.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="success-message" style="display: none;" class="alert alert-success"></div>

<form id="todo-form">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" id="title" name="title" class="form-control" placeholder="Title" maxlength="10" required>
                <div id="title-error" style="color: red;"></div>
                
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea id="description" class="form-control" name="description" placeholder="Description" maxlength="20" ></textarea>
                <div id="description-error" style="color: red;"></div>
            </div>
        </div>
        <div class="d-flex flex-wrap col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Date:</strong>
                <input type="date" id="date" name="date" class="form-control" min="{{ date('Y-m-d') }}" required>
                <div id="date-warning" style="color: red;"></div>
            </div>

            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Time:</strong>
                <input type="time" id="time" name="time" class="form-control" min="{{ date('H:i') }}" required>
                <div id="time-warning" style="color: red;"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="button" id="submit-button" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

@endsection

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
<script>
    


    $(document).ready(function () {
        $('#title').on('keyup keydown', function () {
            validateTitle();
        });
        // document.addEventListener('DOMContentLoaded', function () {
    // if (typeof ClassicEditor === 'undefined') {
        ClassicEditor
            .create(document.querySelector("#description"))
            .catch(error => {
                console.error(error);
            });
    // }
// });
        $('#description').on('input', function () {
            console.log('Description:', $(this).val());
        });

        $('#submit-button').click(function (e) {
            e.preventDefault();

            if (validateForm()) {
                var formData = $('#todo-form').serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('todos.store') }}",
                    data: formData,
                    success: function (response) {
                        // Display the success message above the table
                        displaySuccessMessage(response.success);
                        setTimeout(function () {
                            window.location.href = "{{ route('todos.index') }}";
                        }, 1000);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                }); 
            }
        });

        function validateTitle() {
            var title = $('#title').val();
            $('#title-error').text('');

            if (title.length >= 10) {
                $('#title-error').text('Title should not exceed 10 characters.');
            }
        }

        function validateForm() {
            validateTitle();

            // Add additional validation logic for date and time if needed

            return ($('#title-error').text() === '');
        }

        function displaySuccessMessage(message) {
            // Display the success message above the form
            var successMessage = $('<div class="alert alert-success">' + message + '</div>');
            $('#success-message').html(successMessage).fadeIn().delay(5000).fadeOut();
        }
    });
</script>
@endsection
