<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rows = Client::query()->with(['city','governorate']);
            return DataTables::of( $rows)
                ->addColumn('action', function ($row) {

                    $edit='';
                    $delete='';


                    return '
                            <button '.$edit.'   class="editBtn btn rounded-pill btn-primary waves-effect waves-light"
                                    data-id="' . $row->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                            </button>
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

                ->editColumn('email', function ($row) {
                    return "<a href='mailto:$row->email'>$row->email</a>";
                })

                ->editColumn('phone', function ($row) {
                    return "<a href='tel:$row->phone'>$row->phone</a>";
                })


                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }

        return view('Admin.CRUDS.clients.index');
    }


    public function create()
    {
        $governorates=Area::where('from_id',null)->get();
        return view('Admin.CRUDS.clients.parts.create',compact('governorates'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required' ,
            'code'=>'required|unique:clients,code',
            'phone'=>'required|unique:clients,phone',
            'email'=>'required|unique:clients,email',
            'website'=>'required|unique:clients,website',
            'governorate_id'=>'required|exists:areas,id',
            'city_id'=>'required|exists:areas,id',
            'address'=>'nullable',
            'previous_indebtedness'=>'required|integer',
        ]);



        $data['publisher']=auth('admin')->user()->id;

        Client::create($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }


    public function edit(  $id)
    {



        $row=Client::find($id);
        $governorates=Area::where('from_id',null)->get();
        $cities=Area::where('from_id',$row->governorate_id)->get();

        return view('Admin.CRUDS.clients.parts.edit', compact('row','governorates','cities'));

    }

    public function update(Request $request, $id )
    {
        $data = $request->validate([
            'name' => 'required' ,
            'code'=>'required|unique:clients,code,'.$id,
            'phone'=>'required|unique:clients,phone,'.$id,
            'email'=>'required|unique:clients,email,'.$id,
            'website'=>'required|unique:clients,website,'.$id,
            'governorate_id'=>'required|exists:areas,id',
            'city_id'=>'required|exists:areas,id',
            'address'=>'nullable',
            'previous_indebtedness'=>'required|integer',
        ]);


        $row=Client::find($id);
        $row->update($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!',
            ]);
    }


    public function destroy( $id)
    {

        $row=Client::find($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }//end fun

    public function getCitiesForGovernorate($id){
        $cities=Area::where('from_id',$id)->get();
        return view('Admin.CRUDS.clients.parts.cities', compact('cities'));

    }
}
