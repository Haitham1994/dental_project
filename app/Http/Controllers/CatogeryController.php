<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catogery;
use DataTables;


class CatogeryController extends Controller
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
            $cat = Catogery::latest()->get();
            return Datatables::of($cat)
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
        return view('catogery.index_catogery',compact('catogery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catogery.add_catogery');
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
            "name"  => "required"
           ]);

        Catogery::updateOrCreate(
            ["id" => $request->product_id],
            ["catogry_name" => $request->name]);

       
        return response()->json(['success'=>'Catogery saved successfully.']);

        // return redirect()->route('index.catogery')
        //     ->with('success','Add Successfuly');

        
       

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
        $cat=Catogery::find($id);
        return response()->json($cat);
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
        $this->validate($request,[
            "name"  => "required"
           ]);
           
        $cat=Catogery::find($id);
        $cat->catogry_name= $request->name;
        $cat->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat=Catogery::find($id);
        $cat->destroy($id);
        return response()->json(['success'=>'Catogery deleted successfully.']);

    }
}
