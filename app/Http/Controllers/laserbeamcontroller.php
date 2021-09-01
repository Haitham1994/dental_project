<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catogery;
use App\dental;
use DataTables;
use App\Product;
use App\plant;
use App\laser;
use App\childdantel;

class laserbeamcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{

    if ($request->ajax()) {
        $lasers = laser::latest()->get();
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
    return view('laserbeam.laserbeam_index');


    
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
        laser::updateOrCreate(
            ["id" => $request->laser_id],
            ["l_name" => $request->l_name,
            "l_price" => $request->l_price

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
        $laser=laser::find($id);
        return response()->json($laser);
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
        $lasers=laser::find($id);
        $lasers->destroy($id);
        return response()
        ->json(['code'=>200,'success' => 'تم  حذف بنحاح']);
    }
}
