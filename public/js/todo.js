$(document).ready(function($) {
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   // Open create modal
   $('#btn-add').click(function () {
    $('#btn-save').val("add");
    $('#myForm').trigger("reset");
    $('#createModal').modal('show');
});

// Open edit modal
$("#todo-list").on("click", ".btn-edit", function() {
    var todoId = $(this).data("id");
    var todoRow = $("#todo" + todoId);
    var title = todoRow.find("td:nth-child(2)").text();
    var description = todoRow.find("td:nth-child(3)").text();

    // Set the form values for editing
    $("#editTitle").val(title);
    $("#editDescription").val(description);
    $("#btn-save-edit").val("update");
    $("#edit_todo_id").val(todoId);

    // Show the edit modal
    $('#editModal').modal('show');
});

    // CREATE for create modal
    $("#btn-save").click(function (e) {
        e.preventDefault();
        var formData = {
            title: $('#title').val(),
            description: $('#description').val(),
        };
        var type = 'POST'; // Use POST for creating todos

        $.ajax({
            type: type,
            url: 'todo', // Adjust the URL for creating
            data: formData,
            dataType: 'json',
            success: function(data) {
                // Add the new todo to the table
                var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td><td><button class="btn btn-primary btn-edit" data-id="' + data.id + '">Edit</button><button class="btn btn-danger btn-delete" data-id="' + data.id + '">Delete</button></td></tr>';
                $('#todo-list').append(todo);

                // Reset the form
                $('#myForm').trigger("reset");

                // Hide the modal
                $('#createModal').modal('hide');
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

 // UPDATE for edit modal
 $("#btn-save-edit").click(function (e) {
    e.preventDefault();
    var formData = {
        title: $('#editTitle').val(),
        description: $('#editDescription').val(),
    };
    var type = 'PUT'; // Use PUT for updating todos
    var todoId = $('#edit_todo_id').val();

    $.ajax({
        type: type,
        url: 'todo/' + todoId, // Adjust the URL for updating
        data: formData,
        dataType: 'json',
        success: function(data) {
            // Update the existing todo in the table
            var updatedTodo = '<td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td><td><button class="btn btn-primary btn-edit" data-id="' + data.id + '">Edit</button><button class="btn btn-danger btn-delete" data-id="' + data.id + '">Delete</button></td>';
            $("#todo" + todoId).html(updatedTodo);

            // Reset the form
            $('#editForm').trigger("reset");

            // Hide the modal
            $('#editModal').modal('hide');
        },
        error: function(data) {
            console.log(data);
        }
    });
});


// Delete button click event
$("#todo-list").on("click", ".btn-delete", function() {
    var todoId = $(this).data("id");
    var ajaxurl = 'todo/' + todoId;

    // Send an AJAX request to delete the todo
    $.ajax({
        type: "DELETE",
        url: ajaxurl,
        success: function () {
            // Remove the todo row from the table
            $("#todo" + todoId).remove();
        },
        error: function (data) {
            console.log(data);
        }
    });
});
    // // Attach a click event handler to the edit buttons
    // $("#todo-list").on("click", ".btn-edit", function() {
    //     var todoId = $(this).data("id");
    //     var todoRow = $("#todo" + todoId);
    //     var title = todoRow.find("td:nth-child(2)").text();
    //     var description = todoRow.find("td:nth-child(3)").text();

    //     // Set the form values for editing
    //     $("#title").val(title);
    //     $("#description").val(description);
    //     $("#btn-save").val("update");
    //     $("#todo_id").val(todoId); // Corrected from "data('id')"

    //     // Show the modal for editing
    //     $("#formModal").modal('show');
    // });

    
});
