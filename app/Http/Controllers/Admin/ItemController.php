<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    //
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rows = Item::query()->with(['category']);
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

        return view('Admin.CRUDS.items.index');
    }


    public function create()
    {
        $categories=Category::get();

        return view('Admin.CRUDS.items.parts.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories,title' ,
            'category_id'=>'required|exists:categories,id',
            'details'=>'nullable',
        ]);



        $data['publisher']=auth('admin')->user()->id;

        Item::create($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }


    public function edit(  $id)
    {



        $row=Item::find($id);
        $categories=Category::get();

        return view('Admin.CRUDS.items.parts.edit', compact('row','categories'));

    }

    public function update(Request $request, $id )
    {
        $data = $request->validate([
            'title' => 'required|unique:items,title,'.$id ,
            'category_id'=>'required|exists:categories,id',
            'details'=>'nullable',
        ]);



        $row=Item::find($id);

        $row->update($data);



        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!',
            ]);
    }


    public function destroy( $id)
    {

        $row=Item::find($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }//end fun
}
