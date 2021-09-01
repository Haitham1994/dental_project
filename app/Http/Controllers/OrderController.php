<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Catogery;
use App\ProductOrder;
use App\OrderDetail;
use App\ProductOrder2;
use App\OrderDetail2;
use DB;
use View;
use DataTables;
use Auth;
use App\User;
use Hashids\Hashids;
use App\company;
use App\Expens;
use App\checkresult;
use App\booking1;
use App\dental;
use App\childdantel;


class OrderController extends Controller
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
        $dental=dental::all();
        $childdantels=childdantel::all();
        $catogery=Catogery::with('products')->get();
        return view('orders.add')->with('catogery',$catogery)->with('dental',$dental)->with('childdantels',$childdantels)
             ->with('products',Product::all());
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
        if ($request->c_name) {
            $pull=checkresult::find($request->pull);
            for ($i=0;$i < count($request['product_name']) ;$i++) {
                checkresult::create([
                "c_name"=> $request->c_name,
                "p_name"=> $request['product_name'][$i],     
                "p_price"=> $request['product_price'][$i], 
                "pull"=> $request->pull, 
                "date"=> $request->date2, 
               ]);
            }
        }
    //     $table_print='<div style="height:40px;"><br>';
    //     $table_print=$table_print.'<tr><td>'.'<h2 style="text-align:center">'."اسم المريض:".$request->c_name.'</h2>'.'<td></tr>';
    //     $table_print=$table_print. '<table class="table table-bordered" style="text-align: center;">';
    //     $table_print=$table_print. '<thead>';
    //     $table_print=$table_print. '<tr>';
    //     $table_print=$table_print. '<th scope="col"><b><h1 style="color:black;font-size:40px;">المبلغ</h1></b></th>';
    //     $table_print=$table_print. '<th scope="col"><b><h1  style="color:black;font-size:40px;">اسم الفحص</h1></b></th>';
    //     $table_print=$table_print. '</tr>';
    //     $table_print=$table_print. '</thead>';
    //     $table_print=$table_print. '<tr>';
    // $bases= DB::table('checkresults')->select('p_name','c_name','pull','p_price')->where('pull','LIKE',$request->pull)->where('date','LIKE',$request->date2)->get();
    //  foreach($bases as $base)
    //  {
    //     $table_print=$table_print. '<tr>';
    //     $table_print=$table_print. '<td scope="row"><center><h2>'.$base->p_price.'</h2></center></td>';   
    //     $table_print=$table_print. '<td scope="row"><center><h2>'.$base->p_name.'</h2></center></td>'; 
    //     $table_print=$table_print. '<tr>';
    //  }
    //  $table_print=$table_print.'<td colspan="2">'.'<h2 style="text-align:center">'."تاريخ مقابلة: ".$request->interview.'</h2>'.'</tr>';
    //  $product=booking1::find($request->id);
    //  $wating=1;
    //  $amout=$product->p_price+$request->net;
    //  booking1::where("id",$request->id)->update(array("p_price"=>$amout,"dis"=>$request->dis,'all_amount'=>$request->all_amount,'net'=>$request->net,'p_wating'=>$wating));
    //     return response()->json($table_print);

      
    return "hello";

       
    }

    
   public function acceptForming(Request $requset)
   {
       
       
       
       
       
   }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$hashids = new Hashids();
        //$decode_id=$hashids->decode($id);
        $order=ProductOrder::find($id);
        
        $id=$order->id;
        //dd($decode_id);
        $data=DB::table('order_details')
       ->join('product','order_details.product_id', '=','product.id')
       ->join('product_orders','order_details.order_id','product_orders.id')
       ->select('product_quntity','product.id','product_orders.order_total','product_orders.order_code','product_amount','product.p_name','product_price')
       ->where('order_id','=', $id)->get();

        $catogery=Catogery::with('products')->get();
        return view('orders.edit')->with('catogery',$catogery)
                           ->with('product',Product::all())
                           ->with('data',$data)
                           ->with('ordero',$order)
                           ->with('company',company::all());
        //dd($order);
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
        //"name"          => "required"
        $this->validate($request,[
            "product_qun"   => "required",
            "product_price" => "required",
            "product_id"    => "required",
            
    ]);
       $user_name = Auth::user();//for get auth user name 

        $this->delete_order($id);//for delete order 
    
        $this->add_order($request, $id);//for update order
        // return redirect()->route('order.showsingle',['id' => $id]);

       //for print
       $order=ProductOrder::find($id);
       $id=$order->id;
       $data_collection=DB::table('order_details')
       ->join('product','order_details.product_id', '=','product.id')
       ->join('product_orders','order_details.order_id','product_orders.id')
       ->select('product_quntity','product_amount','product.p_name','product_price',
       'product_orders.order_total','product_orders.order_code','product_orders.created_at','product_orders.customer_name')
       ->where('order_id','=', $id)->get();
     $table_print='<div style="page-break-after: always;"><br>';
     $table_print=$table_print. '<table class="table table-bordered" style="text-align: center;direction: rtl;">';
     $table_print=$table_print. '<thead class="">';
     $table_print=$table_print. '<tr>';
     $table_print=$table_print. '<th scope="col" ><h4>الصنف</h4></th>';
     $table_print=$table_print. '<th scope="col"><h4>الكمية</h4></th>';
     $table_print=$table_print. '</tr>';
     $table_print=$table_print. '</thead>';     
     $table_print=$table_print. '<tbody>';
     $table_print=$table_print. '<h5 style="display:inline-block;margin-left:850px;">رقم الفاتورة: '.$order->order_code.'</h5>';
     $table_print=$table_print. '<h5 style="margin-left:850px;">'.$order->created_at->toFormattedDateString().'</h5>';
     $table_print=$table_print. '<h5 style="display:inline-block;margin-left:850px;">اسم العميل: '.$order->company->company_name.'</h5>';
     $table_print=$table_print.'<h5 style="display:inline-block;margin-left:850px;">المستخدم: '.$user_name->name.'</h5> ';
     $table_print=$table_print. '<br><br>';
     $table_print=$table_print. '<tr>';
     foreach($data_collection as $data)
     {
     $table_print=$table_print. '<td scope="row"><h6>'.$data->p_name.'</h6></td>';
     $table_print=$table_print. ' <td scope="row"><h6>'.$data->product_quntity.'</h6></td>';
     $table_print=$table_print. '</tr>';
     }
     $table_print=$table_print. '</tbody>';
     $table_print=$table_print. '</table>';
     $table_print=$table_print. '</div>';

     $table_print=$table_print.'<div>';
     $table_print=$table_print.'<table class="table table-bordered" style="text-align: center;direction: rtl;">';
     $table_print=$table_print.'<thead class="">';
     $table_print=$table_print.'<tr>';
     $table_print=$table_print. '<th scope="col" ><h4>الصنف</h4></th>';
     $table_print=$table_print. '<th scope="col"><h4>الكمية</h4></th>';
     $table_print=$table_print. '<th scope="col" ><h4>السعر</h4></th>';
     $table_print=$table_print. '<th scope="col" ><h4>المبلغ</h4></th>';
     $table_print=$table_print. '</tr>';
     $table_print=$table_print. '</thead>';     
     $table_print=$table_print. '<tbody>';
     $table_print=$table_print. '<h5 style="display:inline-block;margin-left:850px;">رقم الفاتورة: '.$order->order_code.'</h5>';
     $table_print=$table_print.'<h5 style="display:inline-block;margin-left:850px;">'.$order->created_at->toFormattedDateString().'</h5>';
     $table_print=$table_print.'<h5 style="display:inline-block;margin-left:850px;">اسم العميل: '.$order->company->company_name.'</h5>';
     $table_print=$table_print.'<h5 style="display:inline-block;margin-left:850px;">المستخدم: '.$user_name->name.'</h5> ';
     $table_print=$table_print. '<br><br>';
     foreach($data_collection as $data2)
     {
     $table_print=$table_print. '<tr>';
     $table_print=$table_print. '<td scope="row"><h6>'.$data2->p_name.'</h6></td>';
     $table_print=$table_print. ' <td scope="row"><h6>'.$data2->product_quntity.'</h6></td>';
     $table_print=$table_print. '<td scope="row"><h6>'.number_format($data2->product_price,2).' SDG </h6></td>';
     $table_print=$table_print. '<td scope="row"><h6>'.number_format($data2->product_amount,2).' SDG </h6></td>';
     $table_print=$table_print. '</tr>';
     }
     $table_print=$table_print. '</tbody>';
     $table_print=$table_print. '</table>';
     $table_print=$table_print.'<h5>'.number_format($order->order_total,2).' SDG  :المبلغ الاجمالي</h5><br>';
     $table_print=$table_print.'</div>';
   
    return response()->json($table_print);
    
     }

     private function add_order(Request $request, $id)
     {
       $productorder=ProductOrder::find($id);
        $total_price=0;
        $order_id=$productorder->id; //for get order id 
         foreach($request->product_id as $index=>$pro)
         // for($i=0; $i< count($request['product_qun']); $i++){
       {        
       
           
                //  $product_id= $request['product_id'][$i];
                $product_quntity= $request->product_qun;  //for get product quntity
                $product_price=$request->product_price;   //for get product price
               // $product_amount_total=$request->product_amount_total; //for get  amount of 1 product
                $amount=$product_quntity[$index] * $product_price[$index]; // for calclute the amount of 1 product 
             
                //collect data for insert to database
                $data[]=
                    [
                        'order_id'  =>$order_id,
                        'product_id' => $pro,
                        'product_quntity' =>$product_quntity[$index],
                        'product_amount' => $amount,
                        'product_price' =>$product_price[$index]
                    ];

                
                $product=Product::FindOrFail($pro); //for find product id to update stock
                
                $total_price +=$amount; //for calclute amount of all product

                //for update product stock with quntity 
                $product->update(["stock" => $product->stock - $product_quntity[$index]]);

                //for update the amount of all product       
                $productorder->update(["order_total" => $total_price]);
                $productorder->update(["company_id" => $request->company_id]);
        
   
       }
       //for insert order in database
       OrderDetail::insert($data);
     }
     private function delete_order($id)
     {
        $order=ProductOrder::find($id);
        $or_id=$order->id; //get order id from order table

        $data=DB::table('order_details')
        ->join('product','order_details.product_id', '=','product.id')
        ->select('product.stock','product.id','order_details.product_quntity')
        ->where('order_id','=', $or_id)->get();
        foreach($data as $da)
        {
             
               $product_id=$da->id;
             $product=Product::find($product_id);
         
             $product->update([
                 "stock" => $product->stock + $da->product_quntity
             ]);
        // return  response()->json(['success'=>$product_id]);
         }

        DB::table('order_details')->where('order_id', '=', $or_id)->delete();
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=ProductOrder::find($id);
        $order_id=$order->id;

        $data=DB::table('order_details')
       ->join('product','order_details.product_id', '=','product.id')
       ->select('product.stock','product.id','order_details.product_quntity','order_details.product_price')
       ->where('order_id','=', $order_id)->get();
       foreach($data as $da)
       {
            
              $product_id=$da->id;
            $product=Product::find($product_id);
        
            $product->update([
                "stock" => $product->stock + $da->product_quntity
            ]);
       // return  response()->json(['success'=>$product_id]);
        }
       
        $order->destroy($order_id);
        response()->json(['success'=>'Order deleted successfully.']);
    }


public function orders_charts(Request $request)
{
   
//   //for orders charts
//     $order_chart=ProductOrder::select(
//         DB::raw('YEAR(created_at) as year'),
//         DB::raw('MONTH(created_at) as month'),
//         DB::raw('SUM(order_total) as sum_price')
//     )->groupBy('month')->get();

//     //for product charts
//     $product_chart=DB::table('order_details')
//    ->join('product','order_details.product_id', '=','product.id')
//    ->select(
//        DB::raw('product.p_name as name'),
//        DB::raw('SUM(order_details.product_amount) as amount')
//        )->groupBy('order_details.product_id')->get();
//        if ($request->ajax()) {
//  $products = Product::latest()->get();
//     return Datatables::of($products)->make(true);
//    }

// return view('home')->with(compact('order_chart','product_chart','products'));
// $catogery=Catogery::with('products')->get();
// return view('orders.add')->with('catogery',$catogery)
//      ->with('product',Product::all())
//      ->with('invoice_id',OrderDetail::orderBy('invoice_id','desc')->take(1)->get()->first())
//      ->with('company',company::all());


return "hello";
    
} 

public function menue()
{
    
}

public function order_chart_view(Request $request)
{

    

         //dd($query);
        // return response()->json($query);
}

public function charts(Request $request)
{

        $query=$request->get('query');
       //$date=date($query);
        $order_chart2=ProductOrder::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(order_total) as sum_price')
        )->whereRaw('YEAR(created_at) = ?',[$query])->groupBy('month')->get();
         return view('orders.order_chart_date')->with(compact('order_chart2'));
         //dd($query);
        // return response()->json($query);
}


public function indexs()
{
    return view('index');
}
public function main()
{
    return view('main');
}


public function reportcost(){
    $comps=company::all();
 return view('orders.custom_report_all',compact('comps'));
} 
public function report(Request $request){

    $report=DB::table('product_orders')
       ->join('companies','product_orders.company_id','=','companies.id')
       ->select(
           DB::raw('product_orders.id'),
           DB::raw('product_orders.created_at'),
           DB::raw('product_orders.order_total'),
           DB::raw('product_orders.order_code'),
           DB::raw('companies.company_name')
       )->whereBetween('product_orders.created_at',[$request->date1,$request->date2])->where('companies.company_name','LIKE',$request->company_name)->get();
    if ($request->ajax()) {
        return Datatables::of($report)
                    ->addColumn('date',function($date){
                        return $date->created_at;
                       })
                    ->addColumn('total',function($row){
                        return number_format($row->order_total,2).' ج';
                       })      
                    ->rawColumns(['date','total'])
                    ->make(true);
   }
  return view('orders.custom_report_all',compact('report'));

}

public function showreport(){
    return view('orders.custom_report');
   } 

   public function showallreport(){
    return view('orders.custom_report');
   } 
   
   

public function custom_all(Request $request){
    $report=DB::table('product_orders')
       ->join('companies','product_orders.company_id','=','companies.id')
       ->select(
           DB::raw('product_orders.id'),
           DB::raw('product_orders.created_at'),
           DB::raw('product_orders.order_total'),
           DB::raw('product_orders.order_code'),
           DB::raw('companies.company_name')
       )->whereBetween('product_orders.created_at',[$request->date1,$request->date2])->get();
    if ($request->ajax()) {
    
        return Datatables::of($report)
                    ->addColumn('date',function($date){
                        return $date->created_at;
                       })
                    ->addColumn('total',function($row){
                        return number_format($row->order_total,2).' SDG';
                       })      
                    ->rawColumns(['date','total'])
                    ->make(true);
   }
  return view('orders.custom_report',compact('report'));



}




public function expenreportshow()
{

    $expens=Expens::all();
     return view('expens.expen_report',compact('report','expens'));



}


public function expenreport(Request $request)
{
    $report=DB::table('Expens')->select(
        DB::raw('e_name'),
        DB::raw('e_price'),
        DB::raw('e_dec'),
        DB::raw('e_date'),
        DB::raw('created_at')
    )->whereBetween('created_at',[$request->date1,$request->date2])->get();
 if ($request->ajax()) {
 
     return Datatables::of($report)
                 ->addColumn('date',function($date){
                     return $date->created_at;
                    })
                 ->addColumn('e_price',function($row){
                     return number_format($row->e_price,2).'ج';
                    })      
                 ->rawColumns(['date','e_price'])
                 ->make(true);
}
return view('expens.expen_report',compact('report'));



}

// return $request->all();

}