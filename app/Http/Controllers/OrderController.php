<?php

namespace App\Http\Controllers;

use App\Jobs\SendConfirmedOrderEmail;
use App\Jobs\SendNewOrderEmail;
use Illuminate\Support\Facades\Auth;
use App\Dishe;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {

        $request->user()->authorizeRoles(['waiters', 'admin']);

        $orders = Order::with('user')->with('dishe')->get();

        $data = [
            'data' => $orders,
        ];

        return view('order.list', $data);
    }

    public function confirmed(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|min:1',
        ]);
        $order = Order::findOrFail($request->id);
        $order->confirmed = 1;
        $order->save();
        dispatch(new SendConfirmedOrderEmail($order));
        return 'Status order\'s changed';
    }

    public function json()
    {
        $orders = Order::with('user')->with('dishe')->get();
        return response()->json($orders, 201);

    }


    public function create(Request $request)
    {
//        $request->user()->authorizeRoles(['waiters','admin']);

        $items = Dishe::all();

        $data = [
            'items' => $items,
        ];
        return view('order/create', $data);


    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'dishes_id' => 'required|min:1',
            'quantity' => 'required|min:1|max:100'
        ]);
        $order = new Order();
        $order->dishes_id = $request->dishes_id;
        $order->users_id = Auth::id();
        $order->quantity = $request->quantity;
        $order->number_table = $request->number_table;
        $order->save();
        dispatch(new SendNewOrderEmail($order));
        $request->session()->flash('success', 'The order was successfully saved!');
        return back();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
