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

class bookingcontroller extends Controller
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
$btn ='<tr><td><a   href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  class="edit btn btn-info btn-sm edit">تعديل</a></td><tr>';
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
$datetime2=date_create($date->p_dateexit);
$x=date_diff($datetime1,$datetime2);
                if($x->format('%a') == 0  || $datetime2 <= $datetime1)
                   {
                       
                    //$states=0;
                    //flat::where("fa_name",$date->flat)->update(array("fa_stats"=>$states));
                     $btn='<button  class="btn btn-secondary btn-sm " disabled>لم يتم تحدد</button>';
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
        return view('check.index_check',compact('booking1','books','floors','flats','specializes','docters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    
    public function bookingreport()
    {        
return view('check.report_booking');   
    }

    public function bookingshowreport(Request $request)
    {
$booking=DB::table('booking2s')
->select('cname','floor','flat','phone','datein','dateexit','day','price','total','username','created_at','total','id')->whereBetween('created_at',[$request->date1,$request->date2])->get();
if ($request->ajax()) {
return Datatables::of($booking)
->addColumn('total',function($row){
return number_format($row->total,2).' ج';
})      
->rawColumns(['date','total'])
->make(true);
}
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
//        return $request->all();
    {
    $username=Auth::user()->name;//check get user name 
    //$usename="hayathm";
    $pull=RAND(1,1000);
    $booking1s=booking1::updateOrCreate(["id"=> $request->book_id],
    [
    "p_name"=> $request->p_name,
    "p_gender" =>$request->p_gender,
    "p_nation"  => $request->p_nation,
    "p_address"    => $request->p_address,
    "p_age" =>$request->p_age,
     "p_job" =>$request->p_job,
    "p_phone"   => $request->p_phone,
    "p_datein"   => $request->p_datein,
    "p_dateexit"   => $request->p_dateexit,
    "p_day"   => $request->p_price,
    "p_wating"   => $request->p_wating,
    "username" =>$username,
    "pull"   =>$pull,
    "dis" =>$request->dis,
    "net"=>$request->net,
    "all_amount"=>$request->allamount,
    "docter"=>$request->docter,
    "center"=>$request->center,
    "leftover"=>$request->leftover,
    "relation_doc"=>$request->relation_docter,
    "date"=>$request->date, 
    "do_name"=>$request->p_doc,

    ]);
  //  $id=pill::find($request->book_id)->id;
    $pills=pill::updateOrCreate(
    [
    "b_id"=>$booking1s['id'],
    "cash" =>$request->p_price,
    "pull"   =>$pull,
    ]);



 return response()->json(['success'=>'تم ادخال بيانات بنجاج']);
    }   
    
  public function accepting(Request $request)
   {
    $bookings=booking1::find($request->accept_id);
      $center=$request->pay-$request->pup_docter;
      booking1::where("id",$request->accept_id)->update
      (array('p_day'=>$request->pay,'relation_doc'=>$request->relation_doc,
      'docter'=>$request->pup_docter,'center'=>$center,'p_datein'=>$request->pup_datein,
      
      'p_dateexit'=>$request->pup_dateexit,'leftover'=>$request->leftover
    ));





      return response()->json(['success'=>'تم تاكيد بنجاج']);       
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
    $booking1=booking1::find($id);
    return response()->json($booking1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function update(Request $request)
        
    {
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $booking1s=booking1::find($id);
        $booking1s->destroy($id);
//         $booking2s=booking2::find($id);
//        $booking2s->destroy($id);
        return response()
         ->json(['code'=>200,'success' => 'تم  الغاء السجل بنحاح']);
    }

public function findflat(Request $request)
{
    
$report=DB::table('floors') ->join('flats','floors.id', '=','flats.fl_id')->select('flats.id','flats.fa_name','flats.fl_id','flats.fa_stats')->where('flats.fl_id','LIKE',$request->id)->get();
    return $report;
}

    
public function search(Request $request){
      $term=$request->term;
    $items=booking1::where('p_name','LIKe','%'.$term.'%')->get();
    //return $item;
    if(count($items)==0)
    {

  $search[]="لايوجد ";
    }
      else{
foreach($items as $key=>$value){
 $search[]=$value->p_name;
}

}	

return $search;

    
        
    
    }
    
    
    
    
    
    public function searchResponse(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('booking1s');
        if($request->type=='c_name'){
            $countries->where('pull','LIKE','%'.$query.'%');
        }
       
   $countries=$countries->get();        
        $data=array();
        foreach ($countries as $countrie) {
                $data[]=array('p_name'=>$countrie->p_name,'do_name'=>$countrie->do_name,
                'p_gender'=>$countrie->p_gender,'p_nation'=>$countrie->p_nation,'p_address'=>$countrie->p_address,'p_job'=>$countrie->p_job,'p_age'=>$countrie->p_age,'p_phone'=>$countrie->p_phone,'p_datein'=>$countrie->p_datein,'p_dateexit'=>$countrie->p_dateexit,'pull'=>$countrie->pull,'id'=>$countrie->id);
        }
        if(count($data))
             return $data;
        else
            return ['p_name'=>'','pull'=>'','id'=>'','do_name'=>'','p_gender'=>''];
    
        }


        public function find(Request $request){
            if ($request->ajax())
            {
                $report=DB::table('docters')->select('d_name')->where('d_sp','LIKE',$request->id)->get();
            return $report;
       
            }
        }
    
    

}
