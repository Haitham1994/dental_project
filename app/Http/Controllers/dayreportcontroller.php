<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\catogery;
use DB;
use DataTables;
use App\docter;

class dayreportcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $docters=docter::all();
    return view('day.day_report',compact('docters'));
    }

    public function plant()
    {

    $docters=docter::all();
    return view('day.plant_report',compact('docters'));
    }



    public function expens()

    {
        return view('day.expen_report');


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

public function dayreportshow(Request $request)
{

    $report=DB::table('booking1s')
    ->select(
        DB::raw('do_name'),
        DB::raw('p_name'),
        DB::raw('p_price'),   
        DB::raw('dis'),
        DB::raw('relation_doc'),
        DB::raw('leftover'),
        DB::raw('docter'),
        DB::raw('center'),         
       DB::raw('date'))->where('date',$request->date)->where('do_name','LIKE',$request->do_name)->get();
 if ($request->ajax()){
     return Datatables::of($report)
                 ->addColumn('dis',function($row){
                   
                    })->addColumn('dis',function($row){
                     return number_format($row->dis).'%';
                    }) 
                ->addColumn('docter',function($row){
                    return number_format($row->docter).'ج';           
                   }) 
                   ->addColumn('center',function($row){
                    return number_format($row->center).'ج';           
                   })  
                //    ->addColumn('move2',function($row){
                //     if($row->move=="الوارد")
                //     {
                //         return number_format($row->amount,2).'ج';
                     
                //     }
                //     }) 
                //     ->addColumn('commission1',function($row){
                //         if($row->move=="الوارد")
                //         {
                //             return number_format($row->commission,2).'ج';
                         
                //         }
                //         })
                //         ->addColumn('commission2',function($row){
                //             if($row->move=="الصادر")
                //             {
                //                 return number_format($row->commission,2).'ج';
                             
                //             }
                //             })          
                 ->rawColumns(['dis','docter','center','commission2','move','move2'])
                 ->make(true);
}
     
       return view('day.day_report',compact('expens'));

}



public function expenreportshow(Request $request)
{

    $report=DB::table('expens')
    ->select(
        DB::raw('e_name'),
        DB::raw('e_price'), 
        DB::raw('e_date'),  
        DB::raw('e_dec'),         
       DB::raw('e_date'))->where('e_date',$request->date)->where('e_dec','LIKE',$request->e_dec)->get();
 if ($request->ajax()){
     return Datatables::of($report)

                ->addColumn('e_price',function($row){
                    return number_format($row->e_price).'ج';           
                   }) 
                         
                 ->rawColumns(['dis','docter','center','commission2','move','move2'])
                 ->make(true);
}
     
       return view('day.day_report',compact('expens'));

}

public function plantreportshow(Request $request)
{


    

}





}
