<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DataTables;
use App\ray;
class raycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
        {if ($request->ajax()) {
        $lasers = ray::latest()->get();
        return Datatables::of($lasers)
                ->addColumn('edit', function($row){
                    $btn ='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm editCatogery">تعديل</a>';
                        return $btn;
                })
                ->addColumn('delete', function($row){
                    $btn =' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCatogery">حذف</a>';

                     return $btn;
             })
                ->rawColumns(['edit','delete'])
                ->make(true);
    }
    return view('ray.ray_index');
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
        ray::updateOrCreate(
            ["id" => $request->ray_id],
            ["r_name" => $request->r_name,
            "r_price" => $request->r_price

        ]);
        return response()->json(['success'=>'تم ادخال بيانات بنجاج']);
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
        $ray=ray::find($id);
        return response()->json($ray);
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
        $ray=ray::find($id);
        $ray->destroy($id);
        return response()
        ->json(['code'=>200,'success' => 'تم  حذف بنحاح']);
    }
}
