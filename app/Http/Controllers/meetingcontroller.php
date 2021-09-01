<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use DB;
use App\ booking1;
use App\ booking2; 
use App\docter;

class meetingcontroller extends Controller
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
    $books = booking1::latest()->get();
    return Datatables::of($books)
->addColumn('day',function($date){
$datetime1=date_create(date("Y-m-d"));
$datetime2=date_create($date->p_dateexit);
$x=date_diff($datetime1,$datetime2);
if($x->format('%a') == 0 || $x->format('%a')  == 0 || $x->format('%a')  == 0)
{// btn-warning btn-danger btn-success
$btn='<button  class="btn btn-danger btn-sm " disabled>لم يتم تحديد '.$x->format('%a').' </button>';
return $btn;
}
if($x->format('%a') == 3 || $x->format('%a')  == 1 || $x->format('%a')  == 2)
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
            return view('check.meeting',compact('booking1','books','floors','flats'));
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
        //
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
