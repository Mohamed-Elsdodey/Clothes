<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderDetailsController extends Controller
{
    //
    public function index($id,Request $request)
    {

        if ($request->ajax()) {
            $rows = OrderDetails::query()->with(['stage','type','item'])->where('order_id',$id);
            return DataTables::of( $rows)





                ->escapeColumns([])
                ->make(true);


        }
        else{
            $order=Order::findOrFail($id);
        }

        return view('Admin.CRUDS.orders.orderDetails.index',compact('order'));
    }

}
