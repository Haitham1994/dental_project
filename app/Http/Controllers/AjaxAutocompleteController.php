<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ booking1;
use App\mustafa;
use DB;
use Redirect;


class AjaxAutocompleteController extends Controller
{
    public function index(){
     $kitchens=kitchen::all();
     $halls=hall::all();
     $floors=floo::all();
     $flats=flat::all();
     $flatcontents=flatcontent::all();
//        return view('autocomplete',compact('kitchens','halls','floors','flats','flatcontents'));
		
//		  $brossas=DB::table('alldetails')
//		->join('floos','alldetails.fl_id','=','floos.id')
//    ->join('flats','alldetails.fla_id','=','flats.id')
//     ->join('flatcontents','alldetails.fc_id','=','flatcontents.id')
//
//    ->select('floos.name','flats.name')->get();
//        return $brossas;
	return view('autocomplete',compact('kitchens','halls','floors','flats','flatcontents','brossas'));
		
		
// $datas=alldetail::find(1);
	
// 		echo $datas->floo->name;

// $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');
    

// echo $zeroDate;
    }


    public function search(request $request){
    $term=$request->term;
    $items=warr::where('wname','LIKe','%'.$term.'%')->get();
    //return $item;
    if(count($items)==0)
    {

  $search[]="لايوجد ";
    }
      else{
foreach($items as $key=>$value){
 $search[]=$value->wname;
}

}	

return $search;
}

public function  flasreach(Request $request){

    $term=$request->term;
    $items=booking1::where('p_address','LIKe','%'.$term.'%')->get();
    //return $item;
    if(count($items)==0)
    {

  $search[]="لايوجد عنوان مسبقا";
    }
      else{
foreach($items as $key=>$value){
 $search[]=$value->p_address;
}

}	

return $search;

    
}

    
    
    
public function jobsreach(Request $request){

    $term=$request->term;
    $items=booking1::where('p_job','LIKe','%'.$term.'%')->get();
    //return $item;
    if(count($items)==0)
    {

  $search[]="لايوجد عنوان المهنة مسبقا ";
    }
      else{
foreach($items as $key=>$value){
 $search[]=$value->p_job;
}

}	

return $search;

    
}











    public function searchResponse(Request $request){
        $query = $request->get('term','');
        $countries=\DB::table('countries');
        if($request->type=='countryname'){
            $countries->where('name','LIKE','%'.$query.'%');
        }
        if($request->type=='country_code'){
            $countries->where('sortname','LIKE','%'.$query.'%');
        }
        if($request->type=='cons'){
            $countries->where('y','LIKE','%'.$query.'%');
        }


       
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('name'=>$country->name,'sortname'=>$country->sortname,'y'=>$country->y);
        }
        if(count($data))
             return $data;
        else
            return ['name'=>'','sortname'=>'','y'=>''];
    }
	
	
	public function arrayinsert(Request $request){
		
		for ($i = 0; $i < count($request->countryname); $i++) {
      $answers[] = [
        'fl_id'=>$request->floname,
        'fla_id'=>$request->flatname,
        'fc_id'=>$request->flatcontent,
          'countryname' => $request->countryname[$i],
        
         
      ];
  }
  alldetail::insert($answers);

  return Redirect::to('/man');
    
	}
}
