@extends('layouts.app')

@section('content')
    <div class="container ">
        {{ csrf_field() }}
        <div class="table-responsive text-center">
            <table class="table table-borderless" id="table">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Date Created</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                @foreach($data as $item)
                    <tr class="item{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->created_at}}</td>

                        <td>
                            <button class="edit-modal btn btn-info"
                                    data-info="{{$item->id}},{{$item->name}},{{$item->email}},{{$item->created_at}}">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </button>
                            <button class="delete-modal btn btn-danger"
                                    data-info="{{$item->id}},{{$item->name}},{{$item->email}},{{$item->created_at}}">
                                <span class="glyphicon glyphicon-trash"></span> Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>

                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="name">
                            </div>
                        </div>
                        <p class="name_error error text-center alert alert-danger hidden"></p>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email">
                            </div>
                        </div>
                        <p class="email_error error text-center alert alert-danger hidden"></p>
                    </form>

                    <div class="deleteContent">
                        Are you Sure you want to delete <span class="dname"></span> ? <span
                                class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn actionBtn" data-dismiss="modal">
                            <span id="footer_action_button" class='glyphicon'> </span>
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    @include('scripts.user')
@endsection