@extends('layouts.app')

@section('content')
    <div class="container ">
        {{ csrf_field() }}
        <div class="table-responsive text-center">
            <table class="table table-borderless" id="table">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name of dishes</th>


                    <th class="text-center">Confirmed</th>
                    <th class="text-center">Number of table</th>
                    <th class="text-center">Date Created</th>

                </tr>
                </thead>
                @foreach($data as $order)
                    <tr class="item{{$order->id}}">
                        <td>{{$order->id}}</td>
                        <td>{{$order->dishe->name}}</td>
                        <td>
                            @if ($order->Confirmed)
                                <span style="color:green">YES</span>
                            @else
                                <span style="color:blue">NO </span>
                            @endif
                        </td>
                        <td>{{$order->number_table}}</td>
                        <td>{{$order->created_at}}</td>


                    </tr>
                @endforeach
            </table>
        </div>
    </div>



@endsection

@section('scripts')
    @include('scripts.user')
@endsection