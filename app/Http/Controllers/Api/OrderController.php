<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use \Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();

        return response()->json([
            "message" => "orders record index",
            $order
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Reaquest $request)
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->phone_active = 0;
        $order->total = $request->total;
        $order->status = $request->status;
        $order->payment_type = $request->payment_type;
        $order->city_id = $request->city_id;
        $order->save();

        return response()->json([
            "message" => "orders record created",
            "data" => $order
        ], 200);
    }
    public function show($id)
    {
        $order = Order::find($id);
        return response()->json([
            "message" => "orders record showed",
            $order
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return response()->json([
            "message" => "orders record updated",
            $order
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::where('id', $id)->delete();

        $status="success";
        return response()->json(compact('status'));
    }
}
