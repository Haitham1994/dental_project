<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Catogery;
use DataTables;
use DB;
use App\pill;

class ProductController extends Controller
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
            $product = Product::latest()->get();
            return Datatables::of($product)
                    ->addColumn('edit', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm editProduct">تعديل</a>';
                        return $btn;
                    })
                
                  ->addColumn('delete', function ($row) {
                      $btn =' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">حذف</a>';
                      return $btn;
                  })
                
                
                    ->addColumn('s_price', function ($data) {
                        return number_format($data->sale_price, 2);
                    })
                 ->rawColumns(['edit','delete','s_price'])
                 ->make(true);
        }
        return view('product.index_product', compact('product'))->with('cat', Catogery::all());
    }

  public function create()
     {
         //
    }

// //     /**
// //      * Store a newly created resource in storage.
// //      *
// //      * @param  \Illuminate\Http\Request  $request
// //      * @return \Illuminate\Http\Response
// //      */
    public function store(Request $request)
    {
 Product::updateOrCreate(
 ["id"=> $request->product_id],

 ["cat_id" => $request->catogery_id,
 "p_name" => $request->name,
 "sale_price" => $request->sale_price]);
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
        $product=Product::find($id);
        return response()->json($product);
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
        $product=Product::find($id);
        $product->destroy($id);
        return response()->json(['success'=>'Product deleted successfully.']);
    }

    public function barcode()
    {
        $product=Product::all();
        return view('barcode')->with(compact('product'));
    }




    public function product_report()
    {
        $products=product::all();

        return view('product.product_report')->with(compact('products'));
    }




    public function product_reportshow(Request  $request)
    {
        $report=DB::table('order_details')

        ->join('product','order_details.product_id','=','product.id')
        ->join('product_orders','order_details.order_id','=','product_orders.id')
        ->select(
            DB::raw('order_details.product_quntity'),
            DB::raw('order_details.created_at'),
            DB::raw('order_details.product_amount'),
            DB::raw('product.p_name'),
            DB::raw('product_orders.created_at')
            // DB::raw('product_orders.order_code'),
            // DB::raw('companies.company_name')
        )->whereBetween('product_orders.created_at', [$request->date1,$request->date2])->where('product.p_name','LIKE',$request->pname)->get();
        if ($request->ajax()) {
            return Datatables::of($report)
                     ->addColumn('date', function ($date) {
                         return $date->created_at;
                     })
            
                     ->rawColumns(['date','total'])
                     ->make(true);
        }
        return view('product.product_report', compact('report'));
    }

//     $report=DB::table('product')
//     ->select(
//         DB::raw('p_name'),
//         DB::raw('created_at')
//         // DB::raw('product_orders.created_at'),
//         // DB::raw('product_orders.order_total'),
//         // DB::raw('product_orders.order_code'),
//         // DB::raw('companies.company_name')
//     )->whereBetween('created_at', [$request->date1,$request->date2])->get();
//     if ($request->ajax()) {
//         return Datatables::of($report)
//                  ->addColumn('date', function ($date) {
//                      return $date->created_at;
//                  })
        
//                  ->rawColumns(['date','total'])
//                  ->make(true);
//     }
//     return view('product.product_report', compact('report'));
// }


}