<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use App\patienfile;

class patienfilecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {


        return  "hello";
       
//         if ($request->ajax()) {
//             $patienhoistory =patienfile::all();
//             return Datatables::of($patienhoistory)
// ->addColumn('imag', function ($row) {
//     $btn ='<td></td><a  style="margin-left:25px;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="معاينه اعراض" class="edit btn btn-info btn-sm review1">معاينه</a></td>';
//     return $btn;
// })

// ->rawColumns(['imag',])->make(true);
//         }
//         return view('patienfile.previouspatien',compact('patienhoistory'));
        



// return "hello"
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
