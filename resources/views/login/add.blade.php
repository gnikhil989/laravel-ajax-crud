@extends('login.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Record</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('importView') }}"> Back</a>
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

<form id="add-form">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" maxlength="10" required>
                <div id="name-error" style="color: red;"></div>
                
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email" maxlength="20" required>
                <div id="emaail-error" style="color: red;"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" maxlength="20" required>
                <div id="password-error" style="color: red;"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="button" id="submit-button" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

@endsection
@section('js')
<script>
    
$(document).ready(function () {
    $('#name').on('keyup keydown', function () {
        validateName();
    });

    $('#email').on('keyup keydown', function () {
        validateEmail();
    });
    
    $('#password').on('keyup keydown', function () {
        validatePassword();
    });

    $('#submit-button').click(function (e) {
        e.preventDefault();

        if (validateForm()) {
            var formData = $('#add-form').serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('login.store') }}",
                data: formData,
                success: function (response) {
                // Display the success message above the table
                displaySuccessMessage(response.success);
                setTimeout(function() {
        window.location.href = "{{ route('importView') }}";
    }, 1000)
            },
            error: function (xhr, status, error) {
        console.log("XHR status: " + status);
        console.log("Error: " + error);
        console.log(xhr.responseText);
    }
            });
        }
    });

    function validateName() {
                var name = $('#name').val();
        $('#name-error').text('');

        if (name.length >=10) {
            $('#name-error').text('Name should not exceed 10 characters.');
            return false;
        }

        return true;
    }
    function validateEmail() {
    var email = $('#email').val();
    $('#email-error').text('');

    if (email.length >=20) { // Change to '>' to check if it exceeds 20 characters
        $('#email-error').text('Email should not exceed 20 characters.');
        return false;
    }

    return true;
}

function validatePassword() {
    var password = $('#password').val(); // Change "passowrd" to "password"
    $('#password-error').text('');

    if (password.length >=10) { // Change to '>' to check if it exceeds 10 characters
        $('#password-error').text('Password should not exceed 10 characters.');
        return false;
    }

    return true;
}

    function validateForm() {
        var isValid = true;
        if (!validateName()) {
            isValid = false;
        }
        if (!validateEmail()) {
            isValid = false;
        }
        if (!validatePassword()) {
            isValid = false;
        }
        // Add additional validation logic for date and time if needed

        return isValid;
    }
    function displaySuccessMessage(message) {
            // Display the success message above the form
            var successMessage = $('<div class="alert alert-success">' + message + '</div>');
            $('#add-form').before(successMessage);

            // Hide the success message after a delay (5 seconds in this example)
            // successMessage.slideUp(5000);
        }
});
</script>
@endsection
