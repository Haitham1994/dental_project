<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\booking1;

class addresSreachcontroller extends Controller
{
    public function addresssearch()
    {

        $data = booking1::select("p_address")
        ->where("p_address","LIKE","%{$request->input('query')}%")

        ->get();
return response()->json($data);


    }
}
