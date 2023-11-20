@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex bd-highlight mb-4">
        <div class="p-2 w-100 bd-highlight">
            <h2>Laravel AJAX Example</h2>
        </div>
        <div class="p-2 flex-shrink-0 bd-highlight">
            <button class="btn btn-success" id="btn-add" method="post">
                Add Todo
            </button>
        </div>
    </div>
    <div>
        <table class="table table-inverse">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="todo-list" name="todo-list">
            @foreach ($todo as $data)
    <tr id="todo{{$data->id}}">
        <td>{{$data->id}}</td>
        <td>{{$data->title}}</td>
        <td>{{$data->description}}</td>
        <td>
            <button class="btn btn-primary btn-edit" data-id="{{$data->id}}"  id="edit">Edit</button>
            <button class="btn btn-danger btn-delete" data-id="{{$data->id}}">Delete</button>
        </td>
    </tr>
@endforeach

            </tbody>
        </table>
        <div class="modal fade" id="createModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="formModalLabel">Create Todo</h4>
                    </div>
                    <div class="modal-body">
                        <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter title" value="">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Enter Description" value="">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                        </button>
                        <input type="hidden" id="todo_id" name="todo_id" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addEditModalLabel">Add/Edit Todo</h4>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" name="editForm" class="form-horizontal" novalidate="">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" id="editTitle" name="title" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" id="editDescription" name="description" placeholder="Enter Description">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save-edit" value="add">Save changes</button>
                        <input type="hidden" id="edit_todo_id" name="todo_id" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection