<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DataTables;
use App\plant;
use App\plantresult;


class plantcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cat = plant::latest()->get();
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
        return view('workshop.workshop_add',compact('catogery'));
        
        
    
    
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
        // $this->validate($request,[
        //     "name"  => "required"
        //    ]);

      plant::updateOrCreate(
            ["id" => $request->plant_id],
            ["pl_name" => $request->pl_name,
            "pl_price" => $request->pl_price

        ]);

       
        return response()->json(['success'=>'Catogery saved successfully.']);
    }


public function storeresult(Request $request)
{

    $leftover= $request->all_amount-$request->net; 
    if ($request->c_name) {
        for ($i=0;$i < count($request['product_name']) ;$i++) {
            plantresult::create([
            "pl_name"=> $request->c_name,
            "pl_doname"=> $request->pl_doname,
            "product_name"=> $request['product_name'][$i],     
            "product_price"=> $request['product_price'][$i], 
            "pl_relation"=> $request->dis, 
            "pl_reduction"=> $request->net,
            "pl_center"=>$leftover,
            "date"=>$request->date,
           ]);
        }
    }

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
        $plant=plant::find($id);
        return response()->json($plant);
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
        $plant=plant::find($id);
        $plant->destroy($id);
        return response()
        ->json(['code'=>200,'success' => 'تم  حذف بنحاح']);
    }
}
