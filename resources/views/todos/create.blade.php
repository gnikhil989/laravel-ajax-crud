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

<form action="{{ route('todos.store') }}" method="POST" id="productform">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" id='name' class="form-control" placeholder="Title">
                <div id="name-length-warning" style="color: red;"></div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" id='detail' style="height:150px" name="description" placeholder="Description"></textarea>
                <div id="detail-length-warning" style="color: red;"></div>
            </div>
        </div>

        <!-- <div class="d-flex flex-wrap col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Price:</strong>
                <input type="number" name="price"  step="0.01" id='price' class="form-control" placeholder="Price">
                <div id="pricewarning" style="color: red;"></div>
            </div>
 
            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Quantity:</strong>
                <input type="number" name="quantity" id='quantity' class="form-control" placeholder="Quantity" step="1" >
                <div id="quantitywarning" style="color: red;"></div>
            </div>
        </div>
        <div class="d-flex flex-wrap col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Date:</strong>
                <input type="date" name="date" id='date' class="form-control" min="{{ date('Y-m-d') }}" >
                <div id="datewarning" style="color: red;"></div>
            </div>

            <div class="form-group col-xs-6 col-sm-6 col-md-6">
                <strong>Time:</strong>
                <input type="time" name="time" id='time' class="form-control">
                <div id="timewarning" style="color: red;"></div>

            </div>
        </div> -->
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection

@section('js')
<script>
// 
// =========================================== validations with rules===============================
// var minLength=1;
// var nameLength = 10;
// var nameWarning=$('#name-length-warning');
// var detailLength = 50;
// var priceMax=99999;
// var quantityMax=99999;

// $(document).ready(function(){
//     $('#name').on('keydown keyup change', function(){
//         var char = $(this).val();
//         var charLength = $(this).val().length;
//         if(charLength < minLength){
//             $('#name-length-warning').text('Length is short, minimum '+minLength+' required.');
//         }else if(charLength > nameLength){
//             $('#name-length-warning').text('Length is not valid, maximum '+nameLength+' allowed.');
//             $(this).val(char.substring(0, nameLength));
//         }else{
//             $('#name-length-warning').text('');
//         }
//     });
//     $('#detail').on('keydown keyup change', function(){
//         var char = $(this).val();
//         var charLength = $(this).val().length;
//         if(charLength < minLength){
//             $('#detail-length-warning').text('Length is short, minimum '+minLength+' required.');
//         }else if(charLength > detailLength){
//             $('#detail-length-warning').text('Length is not valid, maximum '+detailLength+' allowed.');
//             $(this).val(char.substring(0, detailLength));
//         }else{
//             $('#detail-length-warning').text('');
//         }
//     });
//     $('#price').on('keydown keyup change', function () {
//         var price = $(this).val();
//         if (isNaN(price) || price < 0 || price > priceMax) {
//             $('#pricewarning').text('Price should be a positive number less than or equal to ' + priceMax + '.');
//         } else {
//             $('#pricewarning').text('');
//         }
//     });

//     $('#quantity').on('keydown keyup change', function () {
//         var quantity = $(this).val();
//         if (isNaN(quantity) || quantity < 0 || quantity > quantityMax || quantity % 1 !== 0) {
//             $('#quantitywarning').text('Quantity should be a positive integer less than or equal to ' + quantityMax + '.');
//         } else {
//             $('#quantitywarning').text('');
//         }
    });

    // $('#date').on('keydown keyup change', function () {
    //     var selectedDate = new Date($(this).val());
    //     var currentDate = new Date();
    //     currentDate.setHours(0, 0, 0, 0);

    //     if (isNaN(selectedDate) || selectedDate < currentDate) {
    //         $('#datewarning').text('Please select a valid date that is today or in the future.');
    //     } else {
    //         $('#datewarning').text('');
    //     }
    // });
    // $('#time').on('keydown keyup change', function () {
    //     var time = $(this).val();

    //     if (!time) {
    //         $('#timewarning').text('Please select a valid time.');
    //     } else {
    //         $('#timewarning').text('');
    //     }
    // });

    // $('#productform').on('submit', function() {
    //     // Check 'time' field before submitting the form
    //     var time = $('#time').val();

    //     if (!time) {
    //         $('#timewarning').text('Time is required.');
    //         return false; // Prevent the form submission
    //     }
    // });
});


</script>
@endsection
