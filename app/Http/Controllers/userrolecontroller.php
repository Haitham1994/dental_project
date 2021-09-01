<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\user;
use Session;
use DataTables;
use Illuminate\Support\Facades\Auth;

class userrolecontroller extends Controller
{
public function index(Request $request)
{

if ($request->ajax()) {
            $product =user::latest()->get();
            return Datatables::of($product)
                    ->addColumn('ok', function($row){
                           $btn1 = '<a  href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'"  data-original-title="منح الصلاحية" class="edit btn btn-info btn-sm ok">منح الصلاحية</a>';
                         return $btn1;
                    })
                ->addColumn('nook', function($row){
                           $btn5 = '<a  href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="نزع الصلاحية" class="edit btn btn-warning btn-sm nook">نزع الصلاحية</a>';
                         return $btn5;               
                    })->addColumn('cancel', function($row){
                          $btn3='<a  href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteuser">حذف</a>';
                         return $btn3;
                          
                    })
                 ->addColumn('update', function($row){
                           $btn4 ='<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm edituser">تعديل</a>';
                     return $btn4;
                    })
    
                  ->addColumn('created_at',function($data){
                     return ($data->created_at)->format('Y-m-d');
                  })
        
                ->addColumn('states',function($data){
                    if($data->states==0)
                    {
                         $btn10 = '<button class="edit btn btn-info btn-sm ok">مستخدم عادي</<button>';
                         return $btn10;
                        
                    }
                      
                    if($data->states==1)
                         $btn10 = '<button class="edit btn btn-info btn-sm ok">مدير النظام</<button>';
                         return $btn10;
                  })
                
                ->rawColumns(['ok','nook','cancel','update','states'])
                 ->make(true);
        }
        return view('users.index_user');
    
    

}

    
    
    
    public function store(Request $request){
user::updateOrCreate([
'id' => $request['user_id'],
'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
        'states' => $request['states'],
    ]);
             return response()->json(['success'=>'Product saved successfully.']);
        
    }
    
    
public function edit($id)
{
  $product=user::find($id);
        return response()->json($product);

}
    

    public function  destroy($id)
    {
      $user=user::find($id);
    $user->destroy($id);
        return response()->json(['success'=>'user deleted successfully.']);
        
    }
    
    
    
public function okfunction($id) 
{
$product=user::find($id);
$states=1;
user::updateOrCreate(["id"=>$product->id],["states" => $states ]);    
    }
    

public function nookfunction($id) 
{
$product=user::find($id);
$states=0;
user::updateOrCreate(["id"=>$product->id],["states" => $states ]);    
    }
    





    
public function delete(Request $request)
{
return "hello";

}
public function __construct()
    {
        $this->middleware('auth');
        $this->user =  \Auth::user();
    }
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->flush();
    return view('auth\login'); 

    


}
    
    
    public function update(Request $request)
        
    {
        $id=$request->user_idup;
        $update=user::find($id);
        $update->name = $request->username;
        $update->email = $request->useremail;
        $update->password =Hash::make($request['userpassword']);
        $update->save();
          return response()->json(['success'=>'Product saved successfully.']);
        
    }
    
    




}
