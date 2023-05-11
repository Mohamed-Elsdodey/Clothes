<?php

namespace App\Http\Controllers\Admin\Area;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Models\Area;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProvinceController extends Controller
{



    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rows = Area::query()->latest()->where('from_id','!=',null);
            return DataTables::of($rows)
                ->addColumn('action', function ($row) {

                    $edit='';
                    $delete='';



                    return '
                            <button '.$edit.'  class="editBtn btn rounded-pill btn-primary waves-effect waves-light"
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



                ->editColumn('from_id', function ($row) {
                    return $row->country->title??'';
                })



                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        else{

        }
        return view('Admin.CRUDS.areas.provinces.index');
    }


    public function create()
    {
        $countries=Area::where('from_id',null)->get();

        return view('Admin.CRUDS.areas.provinces.parts.create',compact('countries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'from_id'=>'required|exists:areas,id',

        ]);


        $row=   Area::create($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }



    public function edit( $id)
    {

        $row=Area::findOrFail($id);

        $countries=Area::where('from_id',null)->get();



        return view('Admin.CRUDS.areas.provinces.parts.edit', compact('row','countries'));

    }

    public function update(Request $request, $id )
    {
        $data = $request->validate([
            'title' => 'required',
            'from_id'=>'required|exists:areas,id',

        ]);

        $row=Area::findOrFail($id);


        $row->update($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy($id)
    {

        $row=Area::findOrFail($id);


        $row->delete();


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun

}
