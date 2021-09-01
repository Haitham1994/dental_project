<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use App\ booking1;
use App\ booking2; 
use auth;
use App\specialize;
use App\docter;
use App\pill;

class schedulingcontroller extends Controller
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
//$floors=floor::all();
//$flats=flat::all();
$specializes=specialize::all();
$docters=docter::all();
if ($request->ajax()) {
$books = booking1::latest()->get();
return Datatables::of($books)
->addColumn('edit', function($row){
$btn ='<tr><td><a   href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="edit btn btn-info btn-sm edit">تحديد</a></td><tr>';
return $btn;
})

->addColumn('delete', function($row){
    $btn ='<tr><td><a   href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" class=" btn btn-danger btn-sm delete">الغاء</a></td><tr>';
    return $btn;
    })->addColumn('wating',function($data){
    if($data->p_wating==0)
    {
    $btn10 = '<button class="edit btn btn-warning btn-sm ok disabled">انتــــــطار</<button>';
         return $btn10;
    }
    if($data->p_wating==1)
    {
    $btn10 = '<button class=" btn btn-success btn-sm ok disabled">تم المقابلة</<button>';
    return $btn10;
    }
  })->addColumn('leftover', function($row){
      if($row->leftover==0)
      {
          $btn = '<button class="edit btn btn-primary btn-sm ok disabled">مكــــمل</<button>';
          return $btn;
      }
      else
      {
        $btn = '<button class="edit btn btn-danger btn-sm ok disabled">غير مكمل</<button>';
        return $btn;

      }

  })
->addColumn('day',function($date){
$datetime1=date_create(date("Y-m-d"));
$datetime2=date_create($date->date);
$x=date_diff($datetime1,$datetime2);
                if($x->format('%a') == 0  || $datetime2 <= $datetime1)
                   {
                       
                    //$states=0;
                    //flat::where("fa_name",$date->flat)->update(array("fa_stats"=>$states));
                     $btn='<button  class="btn btn-danger btn-sm " disabled>انتهى زمن </button>';
                    return $btn;
                    
                  }
                elseif($x->format('%a') == 3 || $x->format('%a')  == 1 || $x->format('%a')  == 2)
                   {// btn-warning btn-danger btn-success
                       $btn='<button  class="btn btn-warning btn-sm " disabled>بـاقي '.$x->format('%a').' يوم</button>';
                    return $btn;
                  }
    elseif($x->format('%a') > 3 || $x->format('%a')  == 1 || $x->format('%a')  == 2)
                   {// btn-warning btn-danger btn-success
                       $btn='<button  class="btn btn-primary btn-sm " disabled>بـاقي '.$x->format('%a').' يوم</button>';
                    return $btn;
                  }
            })->rawColumns(['edit','new','delete','day','price','wating','leftover'])->make(true);




        }
        return view('scheduling.scheduling',compact('booking1','books','floors','flats','specializes','docters'));
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

        booking1::updateOrCreate(["id"=> $request->book_id],
        [
        "date" => $request->p_datein]);

        return response()->json(['success'=>'تم تعديل مواعيد بنجاح']);
}


    //  return $request->p_datein;
    

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
        //
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
        //
    }
}
