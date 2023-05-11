<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Item;
use App\Models\Order;
use App\Models\Stage;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rows = Order::query()->with(['client']);
            return DataTables::of( $rows)
                ->addColumn('action', function ($row) {

                    $edit='';
                    $delete='';


                    return '

                            <button '.$delete.'  class="btn rounded-pill btn-danger waves-effect waves-light delete"
                                    data-id="' . $row->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';



                })
                ->addColumn('details', function ($row) {
                    $url=route('order.orderDetails',$row->id);
                    return "<a href='$url' class='btn btn-outline-dark' >Order Details</a>";
                })

                ->editColumn('date_order', function ($row) {
                    return date('Y/m/d', strtotime($row->date_order));
                })

                ->editColumn('created_at', function ($row) {
                    return date('Y/m/d', strtotime($row->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }

        return view('Admin.CRUDS.orders.newOrders.index');
    }


    public function create()
    {
        $clients=Client::get();
        $types=Type::get();
        $stages=Stage::get();
        $items=Item::get();
        return view('Admin.CRUDS.orders.newOrders.parts.create',compact('clients','items','types','stages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id' ,
            'notes' => 'nullable' ,
            'date_order' => 'required|date' ,
            'code' => 'required|unique:orders,code' ,

        ]);

        $array = $request->validate([
            'amount'=>'required|array',
            'amount.*'=>'required',
            'item_id'=>'required|array',
            'item_id.*'=>'required',
            'type_id'=>'required|array',
            'type_id.*'=>'required',
            'stage_id'=>'required|array',
            'stage_id.*'=>'required',

        ]);

        if (count($request->amount)!= count($request->item_id))
            return response()->json(
                [
                    'code' => 421,
                    'message' => 'item is required'
                ]);

        if (count($request->amount)!= count($request->type_id))
            return response()->json(
                [
                    'code' => 421,
                    'message' => 'type is required'
                ]);

        if (count($request->amount)!= count($request->stage_id))
            return response()->json(
                [
                    'code' => 421,
                    'message' => 'stage is required'
                ]);


        $data['publisher']=auth('admin')->user()->id;

     $order=   Order::create($data);


        $sql=[];

        if ($request->amount ) {
            for ($i = 0; $i < count($request->amount); $i++) {

                $details = [];

                $details = [

                    'order_id' => $order->id,
                    'type_id' => $request->type_id[$i],
                    'stage_id' => $request->stage_id[$i],
                    'item_id' => $request->item_id[$i],
                    'amount'=>$request->amount[$i],
                    'publisher' => auth('admin')->user()->id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),

                ];

                array_push($sql,$details);
            }
            DB::table('order_details')->insert($sql);

        }


        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }



    public function destroy( $id)
    {

        $row=Order::find($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }//end fun
    public function makeRowDetailsForOrder(){
        $id=rand(2,999999999999999);
        $types=Type::get();
        $stages=Stage::get();
        $items=Item::get();
        $html=  view('Admin.CRUDS.orders.newOrders.parts.details', compact('id','items','types','stages'))->render();


        return response()->json(['status'=>true,'html'=>$html]);
    }
}
