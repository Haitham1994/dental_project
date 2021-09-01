<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Check;
use App\Catogery;
use App\company;
use DataTables;


class CheckController extends Controller
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
            $check = Check::latest()->get();
            return Datatables::of($check)
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm editCheck">تعديل</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-success btn-sm deleteCheck">سداد</a>';
    
                            return $btn;
                    })
                    ->addColumn('company_name',function($date){
                        $id=$date->company_id;
                        $company=Catogery::where('id','=',  $id)
                    ->get();
                    foreach($company as $com)
                    {
                        return $com->catogry_name;
                    }

                   })
                ->addColumn('price_row',function($date){
                    return number_format($date->price,2).' SDG';
                })
                ->addColumn('stauts',function($date){
                $datetime1=date_create(date("Y-m-d"));
                $datetime2=date_create($date->check_date);
                $x=date_diff($datetime1,$datetime2);
                if($x->format('%a') == 0  || $datetime2 <= $datetime1)
                   {// btn-warning btn-danger btn-success
                       $btn='<button  class="btn btn-secondary btn-sm ">انتهى الزمن</button>';
                    return $btn;
                  }
                elseif($x->format('%a') == 3 || $x->format('%a')  == 1 || $x->format('%a')  == 2)
                   {// btn-warning btn-danger btn-success
                       $btn='<button  class="btn btn-danger btn-sm ">بـاقي '.$x->format('%a').' يوم</button>';
                    return $btn;
                  }
                  
            })
                 ->rawColumns(['action','company_name','price_row','stauts'])
                 ->make(true);
        }
        return view('check.index_check',compact('check'))->with('cat',Catogery::all());
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
            "catogery_id"  => "required",
            "price"       => "required",
            "date"  => "required",
    ]);
      //$date= date('Y-m-d',$request->date);
    Check::updateOrCreate(["id"=> $request->check_id],
             ["company_id" => $request->catogery_id,
             "price" => $request->price,
             "check_date" => $request->date]);

             return response()->json(['success'=>'Check saved successfully.']);
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
        $check=Check::find($id);
        return response()->json($check);
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
        $check=Check::find($id);
        $check->delete($id);
        return response()->json(['success'=>'Check deleted successfully.']);
    }

    public function trashed(Request $request)
    {
        //return view('posts.trash')->with('posts_trash',$check);                   
        if ($request->ajax()) {
            $check= Check::onlyTrashed()->get();
            return Datatables::of($check)
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm backupCheck">استرجاع</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCheck">حذف</a>';
    
                            return $btn;
                    })
                    ->addColumn('company_name',function($date){
                        $id=$date->company_id;
                        $company=Catogery::where('id','=',  $id)
                    ->get();
                    foreach($company as $com)
                    {
                        return $com->catogry_name;
                    }

                   })
                ->addColumn('price_row',function($date){
                    return number_format($date->price,2).' SDG';
                })
                ->addColumn('stauts',function($date){
                $datetime2=date_create(date("Y-m-d"));
                $datetime1=date_create($date->check_date);
                $x=date_diff($datetime1,$datetime2);
                
                   // btn-warning btn-danger btn-success
                       $btn='<button  class="btn btn-success btn-sm ">تم السداد</button>';
                    return $btn;
                
            })
                 ->rawColumns(['action','company_name','price_row','stauts'])
                 ->make(true);
        }
        return view('check.trashed_check',compact('check'))->with('cat',Catogery::all());

    }


    public function restore($id)
    {
        $check= Check::withTrashed()->where('id',$id)->first();
        $check->restore();
        return response()->json(['success'=>'Check restore successfully.']);
    }

    public function hdelete($id)
    {
        $check= Check::withTrashed()->where('id',$id)->first();
        $check->forceDelete();
        return response()->json(['success'=>'Check hard Delete successfully.']);

    }
}
