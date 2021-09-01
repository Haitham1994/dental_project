<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use DataTables;
use DB;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $department = Department::latest()->get();
            return Datatables::of($department)
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm editDepartment">تعديل</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDepartment">حذف</a>';
    
                            return $btn;
                    })
                    ->addColumn('depart_price',function($data){
                        return number_format($data->price,2).' SDG';
                    })
                 ->rawColumns(['action','depart_price'])
                 ->make(true);
        }
        return view('depart.index_department',compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $this->validate($request,[
            "name"            => "required",
            "cat_name"     => "required",
            "stock"           => "required",
            "price"      => "required",
    ]);

    Department::updateOrCreate(["id"=> $request->depart_id],
             ["depart_name" => $request->name,
             "cat_name" => $request->cat_name,
             "quntity" => $request->stock,
             "price" => $request->price]);

             return response()->json(['success'=>'Department saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department=Department::find($id);
        return response()->json($department);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department=Department::find($id);
        $department->destroy($id);
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
