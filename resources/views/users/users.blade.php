@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>User's list</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add New User</button>
        <div>

            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="users-list" name="users-list">
                @foreach ($users as $user)
                    <tr id="user{{$user->id}}">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$user->id}}">Edit
                            </button>
                            <button class="btn btn-danger btn-xs btn-delete delete-user" value="{{$user->id}}">Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">user Editor</h4>
                        </div>
                        <div class="modal-body">
                            <form id="frmUsers" name="frmUsers" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="inputUser" class="col-sm-3 control-label">user</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name"
                                               placeholder="user" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="description" name="email"
                                               placeholder="Email" value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                            </button>
                            <input type="hidden" id="user_id" name="user_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            var url = "/users";

            //display modal form for user editing
            $('.open-modal').click(function () {
                var user_id = $(this).val();

                $.get(url + '/' + user_id, function (data) {
                    //success data
                    console.log(data);
                    $('#user_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#btn-save').val("update");

                    $('#myModal').modal('show');
                })
            });

            //display modal form for creating new user
            $('#btn-add').click(function () {
                $('#btn-save').val("add");
                $('#frmUsers').trigger("reset");
                $('#myModal').modal('show');
            });

            //delete user and remove it from list
            $('.delete-user').click(function () {
                var user_id = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({

                    type: "DELETE",
                    url: url + '/' + user_id,
                    success: function (data) {
                        console.log(data);

                        $("#user" + user_id).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

            //create new user / update existing user
            $("#btn-save").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                e.preventDefault();

                var formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                }

                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn-save').val();

                var type = "POST"; //for creating new resource
                var user_id = $('#user_id').val();
                var my_url = url;

                if (state == "update") {
                    type = "PUT"; //for updating existing resource
                    my_url += '/' + user_id;
                }

                console.log(formData);

                $.ajax({

                    type: type,
                    url: my_url,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);

                        var user = '<tr id="user' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td><td>' + data.created_at + '</td>';
                        user += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>';
                        user += '<button class="btn btn-danger btn-xs btn-delete delete-user" value="' + data.id + '">Delete</button></td></tr>';

                        if (state == "add") { //if user added a new record
                            $('#users-list').append(user);
                        } else { //if user updated an existing record

                            $("#user" + user_id).replaceWith(user);
                        }

                        $('#frmUsers').trigger("reset");

                        $('#myModal').modal('hide')
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>
@endsection