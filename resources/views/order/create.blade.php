@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                @include('message')
            </div>
            <div class="create_form">
                <div class="col-lg-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="text-center">Create Order</h2>
                            <div class="pull-right">
                            </div>
                        </div>
                    </div>
                    <form method="post" action="/orders">
                        {{	csrf_field()	}}
                        <label for="dishes_id">Dishes:</label>
                        <select name="dishes_id">
                            <option value="" selected="selected">Select dishes</option>
                            @foreach ($items as $dishes)
                                <option value="{{ $loop->iteration }}">{{$dishes->name}}
                                    /{{$dishes->cooking_time}}  </option>
                            @endforeach
                        </select>
                        <label for="quantity">Quantity:</label>
                        <input type="text" name="quantity">
                        <label for="number_table">Number of table:</label>
                        <input type="text" name="number_table">

                        <input type="submit">
                    </form>

                </div>
            </div>
        </div>
        <br>
    </div>
@endsection
