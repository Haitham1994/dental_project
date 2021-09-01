<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\patienfile;
use App\owmanhoistory;
use App\note;
use App\diabeteshoistory;
use App\peep;
use App\User;
use  App\patienhoistory;

class previouscontroller extends Controller
{

    public function index(Request  $request)
  
    {
    
         if ($request->ajax()) {
                $patienhoistory =patienhoistory::all();
                return Datatables::of($patienhoistory)
                ->addColumn('p_name', function ($row) {
                    return $row->bookingpatienfile->p_name;
                })->addColumn('review1', function ($row) {
                    $btn ='<td></td><a  style="margin-left:25px;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="تاريخ المرضي" class="btn btn-info btn-sm review1 ">عرض تاريخ المرضي</a></td>';
                    return $btn;
                })
                ->addColumn('dia', function ($row) {
                    return $row->pdia->Diabetesrang."./.";
            
    })
    ->addColumn('ow', function ($row) {
        return $row->pow->pregnancymonth;

})
->addColumn('not', function ($row) {
    return $row->pnotes->n_note;

})
->addColumn('review4', function ($row) {
    $btn ='<td></td><a style="margin-left:25px;" href="'.route('previous.edit', $row->b_id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="  عرض الصور" class="btn btn-info btn-sm review4" >عرض الصور </a></td>';
     return $btn;
})
    
    ->addColumn('review5', function ($row) {
        $btn ='<td></td><a style="margin-left:25px;" href="'.route('previous.edit', $row->b_id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="  عرض الصور" class="btn btn-info btn-sm review5" >عرض الصور </a></td>';
         return $btn;
    })
    ->addColumn('p_note', function ($row) {
        return $row->peep->p_note;
    
    })

    
    ->rawColumns(['review1','review2','review3','review4','review5','review6'])->make(true);
            }
        
        return view('patienfile.previouspatien',compact('patienhoistory'));
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
    public function edit($b_id)
    {
  $patienhoistorys=DB::table('patienfiles')->select(
DB::raw('b_id'),     
DB::raw('imag'),
DB::raw('created_at'),
DB::raw('b_id'))->where('b_id','LIKE',$b_id)->get();
 return view('patienfile.patienimage')->with('patienhoistorys',$patienhoistorys);
              
        

                
    }
    public function review1($id)
    { 
        //return $b_id;

        // $peeps=peep::find($id);
        // return response()->json($peeps);

        // $users = User::select(['id', 'name']);

        // return Datatables::of($users)->make(true);

        $patienhoistorys=patienhoistory::find($id);
        return response()->json($patienhoistorys);
        // return  $b_id;
        // $review1=DB::table('patienhoistories')->select(
        //     DB::raw('b_id'),     
        //     DB::raw('overblood'),
        //     DB::raw('created_at'),
        //     DB::raw('b_id'))->where('b_id','LIKE',$b_id)->get();
        // return response()->json($review1);

        // return $patienhoistorys;
         
    }

    public function review2($id)
    {

        $peeps=peep::find($id);
         return response()->json($peeps);
       
    }

    public function review3($id,Request $request)
    {

    // return $request->id;

// $patienfiles =patienfile::find($id);
// return Datatables::of($patienfiles)->make(true);
// ->addColumn('review1', function ($row) {
// $btn ='<td></td><a  style="margin-left:25px;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="معاينه اعراض" class="edit btn btn-info btn-sm review1">معاينه</a></td>';
// return $btn;
// })->rawColumns(['review10'])->make(true);

// return $patienfiles->id;

$patienfiles=patienfile::with('imag')->where('b_id',$id);
return Datatables::of($patienfiles)->make(true);

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
