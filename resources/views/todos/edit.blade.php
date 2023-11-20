@extends('todos.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Todo</h2>
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

<form action="{{ route('todos.update', ['todo' => $todo->id]) }}" method="POST" id="todo-edit-form">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" id="title" class="form-control" maxlength="10" value="{{ $todo->title }}" placeholder="Title" required>
                <div id="title-error" style="color: red;"></div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" id="description" name="description" placeholder="Description" maxlength="20" required>{{ $todo->description }}</textarea>
                <div id="description-error" style="color: red;"></div>
            </div>
        </div>
        <div class="d-flex flex-wrap col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Date:</strong>
                <input type="date" id="date" name="date" value="{{ $todo->date }}" min="{{ date('Y-m-d') }}" class="form-control" required>
                <div id="date-warning" style="color: red;"></div>
            </div>

            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Time:</strong>
                <input type="time" name="time" id="time" value="{{ $todo->time }}" min="{{ date('H:i') }}" class="form-control" required>
                <div id="time-warning" style="color: red;"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button id="submit-button" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#title, #description, #date, #time').on('input', function() {
        validateForm();
    });

    $('#todo-edit-form').submit(function(e) {
        e.preventDefault();

        if (validateForm()) {
            var formData = $('#todo-edit-form').serialize();
            var token = $('meta[name="csrf-token"]').attr('content');
            var inputData = {
                "title": $('#title').val(),
                "description": $('#description').val(),
                "date": $('#date').val(),
                "time": $('#time').val(),
                "_token": token
            };

            $.ajax({
                type: "POST",
                url: "{{ route('todos.update', ['todo' => $todo->id]) }}",
                data: inputData,
                success: function (response) {
                    // Remove any existing success messages
                    // $('.alert-success').remove();

                    // Display the success message above the form
                    displaySuccessMessage(response.success);
                    // Redirect to the todos.index page after a delay (1 second)
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

    function displaySuccessMessage(message) {
            // Display the success message above the form
            var successMessage = $('<div class="alert alert-success">' + message + '</div>');
            $('#todo-edit-form').before(successMessage);

            // Hide the success message after a delay (5 seconds in this example)
            // successMessage.slideUp(5000);
        }

    function validateForm() {
        var isValid = true;
        if (!validateTitle()) {
            isValid = false;
        }
        if (!validateDescription()) {
            isValid = false;
        }
        if (!validateDate()) {
            isValid = false;
        }
        if (!validateTime()) {
            isValid = false;
        }
        return isValid;
    }

    function validateTitle() {
        var title = $('#title').val();
        $('#title-error').text('');

        if (title.length >=10) {
            $('#title-error').text('Title should not exceed 10 characters.');
            return false;
        }
        return true;
    }

    function validateDescription() {
        var description = $('#description').val();
        $('#description-error').text('');

        if (description.length >=20) {
            $('#description-error').text('Description should not exceed 20 characters.');
            return false;
        }
        return true;
    }

    function validateDate() {
        var date = $('#date').val();
        $('#date-warning').text('');

        // You can add additional date validation logic here if needed

        return true;
    }

    function validateTime() {
        var time = $('#time').val();
        $('#time-warning').text('');

        // You can add additional time validation logic here if needed

        return true;
    }
});
</script>
@endsection
