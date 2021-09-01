<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\docter;
use DataTables;
class doctercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cat = docter::latest()->get();
            return Datatables::of($cat)
->addColumn('edit', function ($row) {
    $btn='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="btn btn-warning btn-sm  edit">تعديل</a>';
    return $btn;
})
->addColumn('delete', function ($row) {
    $btn =' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="btn btn-danger btn-sm delete">حذف</a>';
    return $btn;
})
->rawColumns(['edit','delete'])
->make(true);
        }
        return view('docter.docter_index', compact('catogery'));
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
        docter::updateOrCreate(
            ["id"=> $request->doc_id],
            [
            "doc_name" => $request->doc_name,
            "doc_gender" => $request->doc_gender,
            "doc_nation"=>$request->doc_nation,
            "doc_address"=>$request->doc_address,
            "doc_age"=>$request->doc_age,
            "doc_spec"=>$request->doc_spec,
            "doc_degree"=>$request->doc_degree,
            "doc_phone"=>$request->doc_phone,
            ]
        );
        return response()->json(['success'=>'تم ادخال بيانات بنجاح']);
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
        $docters=docter::find($id);
        return response()->json($docters);
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
            $docters=docter::find($id);
        $docters->destroy($id);
        return response()->json(['success'=>'تم حذف بيانات بنجاح']);
    }
    
}