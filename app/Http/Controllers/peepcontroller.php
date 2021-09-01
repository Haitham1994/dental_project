<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use App\peep;

class peepcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $peeps =peep::latest()->get();
            return Datatables::of($peeps)
->addColumn('review1', function ($row) {
    $btn ='<td></td><a  style="margin-left:25px;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="معاينه اعراض" class="edit btn btn-info btn-sm review1">معاينه</a></td>';
    return $btn;
})
->addColumn('review3', function ($row) {
    $btn ='<td></td><a  style="margin-left:25px;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->b_id.'" data-original-title="معاينه الصور" class="edit btn btn-info btn-sm review3">معاينه</a></td>';
    return $btn;
})
->addColumn('review4', function ($row) {
    $btn ='<td></td><a  style="margin-left:25px;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->b_id.'" data-original-title="معاينه ملاحظات" class="edit btn btn-info btn-sm review4">معاينه</a></td>';
    return $btn;
})
->addColumn('b_id', function ($row) {

    return $row->bookingpatienfile->p_name;
})
->addColumn('Delete', function ($row) {
    $btn ='<td> <a style="margin-left:34px;"href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete">حذف</a></td>';
    return $btn;
})
->rawColumns(['Edit','Delete','imag','review1','review2','review3','review4','imag'])->make(true);
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
