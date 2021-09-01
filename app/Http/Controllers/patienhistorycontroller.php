<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\patienhoistory;
use App\diabeteshoistory;
use App\owmanhoistory;
use App\peep;
use App\patienfile;
use App\note;
use Session;
use Auth;
class patienhistorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        if ($request->hasFile('file')) {    
            $notes=new note;
            $notes->n_note=$request->n_note;
               $notes->save();
              $notid = $notes->id;
              $peep=new peep;
              $peep->p_note=$request->p_note;
                 $peep->save();
                $pid = $peep->id;
  
     $diabeteshoistory=new diabeteshoistory;
        $rangDiabetes;
        if ($request->DiabetesCon=='نعم') {
            $rangDiabetes=$request->Diabetesrang;
        }
        if ($request->DiabetesCon=='لا') {
            $rangDiabetes=0;
        }
        $diabeteshoistory->diabetes=$request->diabetes;
        $diabeteshoistory->DiabetesCon=$request->DiabetesCon;
        $diabeteshoistory->Diabetesrang=$rangDiabetes;
        $diabeteshoistory->save();
        $diaid=$diabeteshoistory->id;
        $owmanhoistory=new owmanhoistory;
        $rangMonth;
        if ($request->loadCon=='نعم') {
            $rangMonth=$request->pregnancymonth;
        }
        if ($request->loadCon=='لا') {
            $rangMonth=0;
        }
        $owmanhoistory->married=$request->married;
        $owmanhoistory->marriedCon=$request->marriedCon;
        $owmanhoistory->load=$request->load;
        $owmanhoistory->loadCon=$request->loadCon;
        $owmanhoistory->pregnancymonth=$rangMonth;
        $owmanhoistory->save();   
        $owid=$owmanhoistory->id; 
       $username=Auth::user()->name;
        $patienhoistories=new patienhoistory;
        $patienhoistories->b_id=$request->c_id;
        $patienhoistories->not_id=$notid;
        $patienhoistories->p_id=$pid;
        $patienhoistories->ow_id=$owid;
        $patienhoistories->dia_id=$diaid;
        $patienhoistories->overblood=$request->overblood;
        $patienhoistories->bloodCon=$request->bloodCon;
        $patienhoistories->diseaseheart=$request->diseaseheart;
        $patienhoistories->heartCon=$request->diseaseheartCon;
        $patienhoistories->fallen=$request->fallen;
        $patienhoistories->fallenCon=$request->fallenCon;
        $patienhoistories->heat=$request->heat;
        $patienhoistories->heatCon=$request->heatCon;
        $patienhoistories->kidney=$request->kidney;
        $patienhoistories->kidneyCon=$request->kidneyCon;
        $patienhoistories->fire=$request->fire;
        $patienhoistories->fireCon=$request->fireCon;
        $patienhoistories->anemia=$request->anemia;
        $patienhoistories->anemiaCon=$request->anemiaCon;
        $patienhoistories->bleeding=$request->bleeding;
        $patienhoistories->bleedingCon=$request->bleedingCon;
        $patienhoistories->adenitis=$request->adenitis;
        $patienhoistories->adenitisCon=$request->adenitisCon;
        $patienhoistories->asthma=$request->asthma;
        $patienhoistories->asthmaCon=$request->asthmaCon;
        $patienhoistories->allergy=$request->allergy;
        $patienhoistories->allergyCon=$request->allergyCon;
        $patienhoistories->drug=$request->drug;
        $patienhoistories->drugCon=$request->drugCon;
        $patienhoistories->other=$request->other;
        $patienhoistories->otherCon=$request->otherCon;
        $patienhoistories->save();
         foreach ($request->file as $file) {
        $filename=$file->getClientOriginalName();
         $destinationPath = 'public/image/'; 
         $file->move($destinationPath, $filename);
         $pfile= new patienfile;
         $pfile->b_id=$request->c_id;
         $pfile->imag=$filename;
           $pfile->save();    
             }   
         }
         Session::flash('success','تم حفظ بنجاح');
         return redirect()->back();
       
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
