@extends('login.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="loginForm" action="{{ route('loginSubmit') }}"  method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="loginButton" >
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('login.create') }}"> Create New User</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this script for the AJAX request -->
<!-- Add this line to include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
    // Handle the click event for the login button
    $("#loginButton").click(function() {
        // Get the form data
        console.log('Button clicked!');
        var formData = $("#loginForm").serialize();

        // Send an AJAX request to the login.submit route
        $.ajax({
            type: "POST",
            // Use the route function to generate the correct URL
            url: "{{ route('loginSubmit') }}", 
            data: formData,
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            success: function(response) {
                // Handle the success response
                
                    // Redirect or display a success message based on the action
                    console.log('Action successful');
                    window.location.href = "{{ route('importView') }}";
                
                    // Display an error message (if applicable)
                    console.log('Action failed:', response.error);
                
            },
            error: function(error) {
                console.log('An error occurred:', error);
            }
        });
    });
});
</script>
@endsection
