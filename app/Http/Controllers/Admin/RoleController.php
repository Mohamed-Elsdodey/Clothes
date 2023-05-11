<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{



//    function __construct()
//    {
//        $this->middleware('permission:عرض الادوار', ['only' => ['index']]);
//        $this->middleware('permission:اضافة الدور', ['only' => ['create','store']]);
//        $this->middleware('permission:تعديل دور', ['only' => ['edit','update']]);
//        $this->middleware('permission:حذف دور', ['only' => ['destroy']]);
//    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rows = Role::query();
            return DataTables::of($rows)
                ->addColumn('action', function ($row) {

                    $edit='';
                    $delete='';

//                    if(!auth()->user()->can('تعديل دور'))
//                        $edit='hidden';
//                    if(!auth()->user()->can('حذف دور'))
//                        $delete='hidden';

                    return '
                            <button  ' .$edit. '   class="editBtn btn rounded-pill btn-primary waves-effect waves-light"
                                    data-id="' . $row->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button  ' .$delete. '  class="btn rounded-pill btn-danger waves-effect waves-light delete"
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
        else {

        }
        return view('Admin.CRUDS.roles.index');
    }


    public function create()
    {
        $permission = Permission::get();

        return view('Admin.CRUDS.roles.parts.create',compact('permission'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'nullable',
        ]);
        $role = Role::create(['name' => $request->input('name'),'guard_name'=>'admin']);

        $role->syncPermissions($request->input('permission'));



        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }


    public function show($id)
    {
        //
    }

    public function edit( Role $role)
    {
        $permission = Permission::where('guard_name','admin')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->get();
        return view('Admin.CRUDS.roles.parts.edit', compact('permission','role','rolePermissions'));

    }


    public function update(Request $request,  $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'nullable',
        ]);
        $role = Role::find($id);
        $old=$role;
        $role->name = $request->input('name');

        $role->save();
        $role->syncPermissions($request->input('permission'));

        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }


    public function destroy(Role $role)
    {
        $old=$role;
        $role->delete();



        return response()->json(
            [
                'code' => 200,
                'message' => 'operation accomplished successfully!'
            ]);
    }

}
