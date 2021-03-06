<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Imports\InvoicesExport;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $item = null;
        $items = Order::orderBy("created_at", "DESC")
            ->orderBy("id","DESC")
            ->whereHas("Items",function ($q){
                $q->where("restaurant_id",user()->UserResaurant->id);
            })
            ->paginate(5);

        if (count($items) > 0) {
            $latestDate = substr($items[0]->created_at, 0, 10);
        } else {
            $latestDate = date('Y-m-d');
        }

        if($request->ajax()){
            $item = Order::where("order_id",$id)
                ->first();
            if($item == null){
                return response()->json(['error'=>'Error']);
            }
            return view('data.order',compact('items','item'));
        }

        return view('home',compact('items','item', 'latestDate'));
    }

    public function logout()
    {
        Auth::logout();
       return redirect()->route('index');
    }


    public function export_order(Request $request){
        $body = Order::
            whereHas("Items",function ($q){
                $q->where("restaurant_id",user()->UserResaurant->id);
            })->
        select("id","name","phone","total","status","created_at","updated_at");

        if($request->from && $request->to){

            $from_d = parent::date_get($request->from,2).'-'.parent::date_get($request->from,0).'-'.parent::date_get($request->from,1);
            $to_d = parent::date_get($request->to,2).'-'.parent::date_get($request->to,0).'-'.parent::date_get($request->to,1);

            $from = date($from_d);
            $to = date($to_d);

            $body = $body->whereBetween('created_at', [$from, $to]);
        }

        $body = $body->get();
        $headers_collc = [
            'order_id',
            'Name',
            'Phone',
            'Total',
            'Status',
            'Created Date',
            'Updated Date',
        ];
        $export = new InvoicesExport([
            $headers_collc,
            $body
        ]);
        return Excel::download($export, 'export' . time() . '.xlsx');
    }


    public function accept_order(Request $request)
    {
        $item = Order::where("order_id",$request->order_id)
            ->first();
        if($item == null){
            return redirect()->route('index');
        }
        $item->status = 5;
        $item->save();
        return redirect()->route('home');
    }

    public function delete_order(Request $request)
    {
        $item = Order::where("order_id",$request->order_id)
            ->first();
        if($item == null){
            return redirect()->route('index');
        }
        $item->delete();
        return redirect()->route('home');
    }

}