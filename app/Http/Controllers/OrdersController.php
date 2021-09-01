<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Clothes;
use App\Wash;
use App\Order;
use App\OrderDetails;
use App\labresult;


class OrdersController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        //$x = DB::table('orders')->max('order_id');
        return view('orders.create_order')->with('clothes',Clothes::all())
                                          ->with('wash',Wash::all())
                                          ->with('was',Wash::all());
                        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        for ($i=0;$i < count($request['p_name']) ;$i++) {
            labresult::create([
                        "b_id"=> $request->c_id,
            ]);
        // return $request->p_name;

        }
        // labresult::updateOrCreate(
        // [
        // "b_id"   => $request->c_id,
        // "d_id"  => $request->d_name,
        // "p_id"    => $request->p_name,


        // ]);

        // $notes=new labresult;
        // $notes->b_id=$request->c_id;
        // $notes->d_id=$request->c_id;
        // $notes->p_id=$request->c_id;
        //    $notes->save();
        // return $request->id;
        
        // if ($request->p_name) {
        //     for ($i=0;$i < count($request['p_name']) ;$i++) {
        //         labresult::create([
        //         "b_id"=> $request->c_id,
        //         "d_id"=> $request->c_id,
        //         "p_id"=> $request->c_id,
          
                // "p_id"=> $request['product_price'][$i],
                // "price"=> $request->pull,
                // "redate"=> $request->date2,
            //    ]);
        }
        



      
    
        // $max=Order::max('order_id');
        // $min=Order::min('order_id'); 
        // $this->validate($request,[
        //     "name"  => "required",
        //     "clothe_id[]" => "required",
        //         "wash_id[]" => "required",
        //         "qu[]" => "required",
        //         "price[]" => "required"
        //    ]);

         
        // if($min <=0)
        // { 
        //     Order::create([
        //         "order_name"=> $request->name,
        //         "order_id"=> $min+1,
                
        //        ]);
        // }
        // elseif ($max) {
        //      Order::create([
        //         "order_name"=> $request->name,
        //         "order_id"=> $max+1,
                
        //        ]);
        // }
         

        
        
        // for($i=0; $i< count($request['price']); $i++){
            
        //     if($min <=0)
        //     {
        //     $clothe_id=$request['clothe_id'][$i];
        //     $wash_id=$request['wash_id'][$i];
        //     $qu=$request['qu'][$i];
        //     $price=$request['price'][$i];
        //     $order_id=$min+1;

        //     OrderDetails::create([
        //         "clothe_id"=> $clothe_id,
        //         "wash_id"=> $wash_id,
        //         "clothe_que"=> $qu,
        //         "order_price"=> $price,
        //         "order_id"=> $order_id
                
        //        ]);

        //     }
        //     elseif ($max) 
        //     {
        //     $clothe_id=$request['clothe_id'][$i];
        //     $wash_id=$request['wash_id'][$i];
        //     $qu=$request['qu'][$i];
        //     $price=$request['price'][$i];
        //     $order_id=$max+1;

        //     OrderDetails::create([
        //         "clothe_id"=> $clothe_id,
        //         "wash_id"=> $wash_id,
        //         "clothe_que"=> $qu,
        //         "order_price"=> $price,
        //         "order_id"=> $order_id
                
        //        ]);
        //     }

            
        // }
        // return Redirect::to("/create/order")->withSuccess('Great! Form successfully submit with validation.');
          // return redirect()->back();
    

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
