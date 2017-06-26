<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class CuisineController extends Controller
{
    //
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['cook','admin']);
        $orders = Order::where('confirmed',0)->with('user')->with('dishe')->get();

        $data = [
            'data' => $orders,
        ];

        return view('cuisine.list', $data);
    }


    public function json()
    {
        $orders = Order::where('confirmed',0)->with('user')->with('dishe')->get();
        return response()->json($orders, 201);

    }


}
