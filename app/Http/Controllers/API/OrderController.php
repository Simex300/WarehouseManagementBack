<?php

namespace App\Http\Controllers\API;

use App\Order;

use App\Http\Requests\StoreOrderPost;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->queryIndex($request)->paginate(15);
    }

    private function queryIndex(Request $request) {
        $query = Order::with('status')->with('client')->with('orderDetail')->with('orderDetails')->with('orderUsers');

        if(isset($request->clientID)) {
            $query->where('clientID', $request->clientID);
        }
        if(isset($request->statusID) && $request->statusID != -1){
            $query->where('statusID', $request->statusID);
        }
        if(isset($request->search)){
            $query->where('id', 'like', '%'.$request->search.'%');
        }

        return $query;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderPost $request)
    {
        $validated = $request->validated();

        $order = new Order();

        $order->clientID = $request->clientID;
        $order->subtotal = $request->subtotal;
        $order->tax = $request->tax;
        $order->shipping = $request->shipping;
        $order->total = $request->total;
        $order->statusID = 3;

        $order->save();

        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return Order::with('status')->with('client')->with('orderDetail')->with('orderDetails')->find($order->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->clientID = $request->clientID ? $request->clientID : $order->clientID;
        $order->subtotal = $request->subtotal ? $request->subtotal : $order->subtotal;
        $order->total = $request->total ? $request->total : $order->total;
        $order->statusID = $request->statusID ? $request->statusID : $order->statusID;

        $order->save();

        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return 1;
    }
}
