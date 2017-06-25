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
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Confirmed</th>
                    <th class="text-center">Number of table</th>
                    <th class="text-center">Timer</th>

                </tr>
                </thead>
                @foreach($data as $order)
                    <tr class="item{{$order->id}}">
                        <td>{{$order->id}}</td>
                        <td>{{$order->dishe->name}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>
                            @if ($order->Confirmed)
                                <span style="color:green">YES</span>
                            @else
                                <span style="color:blue">NO </span>
                            @endif
                        </td>
                        <td>{{$order->number_table}}</td>
                        <td> <div data-countdown="{{$order->time}}">{{$order->created_at}}</div>
                            </td>


                    </tr>
                @endforeach
            </table>
        </div>
    </div>



@endsection

@section('scripts')
    @include('scripts.order')
@endsection