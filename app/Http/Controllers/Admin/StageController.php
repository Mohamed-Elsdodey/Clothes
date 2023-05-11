<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StageController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rows = Stage::query();
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



                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }

        return view('Admin.CRUDS.stages.index');
    }


    public function create()
    {
        return view('Admin.CRUDS.stages.parts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:stages,title' ,
        ]);



        $data['publisher']=auth('admin')->user()->id;

        Stage::create($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }


    public function edit(  $id)
    {



        $row=Stage::find($id);

        return view('Admin.CRUDS.stages.parts.edit', compact('row'));

    }

    public function update(Request $request, $id )
    {
        $data = $request->validate([
            'title' => 'required|unique:stages,title,'.$id ,
        ]);



        $row=Stage::find($id);
        $row->update($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!',
            ]);
    }


    public function destroy( $id)
    {

        $row=Stage::find($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }//end fun
}
