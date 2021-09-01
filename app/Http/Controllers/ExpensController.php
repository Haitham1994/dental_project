<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expens;
use DataTables;
use Auth;
use DB;
use App\Catogery;

class ExpensController extends Controller
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
            $expens = Expens::latest()->get();
            return Datatables::of($expens)
                    ->addColumn('delete', function($row){
                           $btn =' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteExpens">حذف</a>';
                        return $btn;
                    })
                  ->addColumn('edit', function($row){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editExpens">تعديل</a>';
                        return $btn;
                    })
                  ->addColumn('created_at',function($data){
                     return ($data->created_at)->format('Y-m-d');
                      
                  })->addColumn('e_price',function($data){
                      return number_format($data->e_price,2).'ج';
                  })
                 ->rawColumns(['action','e_price','delete','edit'])
                 ->make(true);
        }
        return view('expens.index_expens',compact('expens'));
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
 $username=Auth::user()->name;//check get user name 
    Expens::updateOrCreate(["id"=> $request->expens_id],
             [
             "e_name"   => $request->e_name,
             "e_price"  => $request->e_price,
             "e_dec"    => $request->e_dec,
            "username" =>$username,
            "e_date" =>$request->e_date,

             ]);
             return response()->json(['success'=>'تم ادخال بيانات بنجاج']);
            
            }


    
    public function expensreport()
    {

        
        $expens=Expens::all();
        
        return view('expens.report_expens',compact('expens'));
        
        
    }
    
    public function expensshowreport(Request $request)
    {
    $report=DB::table('expens')
       ->select(
           DB::raw('e_name'),
           DB::raw('e_price'),
           DB::raw('e_dec'),
           DB::raw('note'),
           DB::raw('username'),
          DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')"))->whereBetween('created_at',[$request->date1,$request->date2])->where('e_dec','LIKE',$request->e_dec)->get();
    if ($request->ajax()){
        return Datatables::of($report)
                    ->addColumn('e_price',function($row){
                        return number_format($row->e_price,2).'ج';
                       })      
                    ->rawColumns(['e_price'])
                    ->make(true);
   }
  return view('expens.report_expens',compact('report'));
        
        
    }
    
    public function greport()
    {
        
    return view('custom.report_g');
        
    }
    
    public function greport_show(Request $request)
    {    
    $report=DB::table('order_details')->join('product','order_details.product_id', '=','product.id')
->join('product_orders','order_details.order_id', '=','product_orders.id')
->join('users','product_orders.user_id', '=','users.id')
->select(DB::raw('product.p_name'),
DB::raw('order_details.product_quntity'),
DB::raw('order_details.product_price'),
DB::raw('order_details.created_at'),
DB::raw('product_orders.order_total'),
DB::raw('product_orders.order_code'),
DB::raw("DATE_FORMAT(order_details.created_at,'%Y-%m-%d')"),
DB::raw('users.name'))->whereBetween('order_details.created_at',[$request->date1,$request->date2])->get();
          if ($request->ajax()){
        return Datatables::of($report)->make('true');
          }
                                                 
        return view('custom.report_g',compact('report')); 
        
    }
    
    
    
    public function creport()
    {
        
     $catogerys=Catogery::all();
    return view('custom.report_c',compact('catogerys'));
        
    }
    
    public function creport_show(Request $request)
    {
        
 $report=DB::table('order_details')->join('product','order_details.product_id', '=','product.id')
->join('product_orders','order_details.order_id', '=','product_orders.id')
->join('users','product_orders.user_id', '=','users.id')
->select(DB::raw('product.p_name'),
DB::raw('order_details.product_quntity'),
DB::raw('order_details.product_price'),
DB::raw('order_details.created_at'),
DB::raw('product_orders.order_total'),
DB::raw('product_orders.order_code'),
DB::raw("DATE_FORMAT(order_details.created_at,'%Y-%m-%d')"),
DB::raw('users.name'))->whereBetween('order_details.created_at',[$request->date1,$request->date2])->where('order_details.product_id','LIKE',$request->gname)->get();
          if ($request->ajax()){
        return Datatables::of($report)->make('true');
          }
                                                 
        return view('custom.report_c',compact('report')); 
        
        
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
        $expens=Expens::find($id);
        return response()->json($expens);
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
    $expens=Expens::find($id);
    $expens->destroy($id);
 return response()
         ->json(['code'=>200,'success' => 'تم   حذف بنحاح']);
    }
}
