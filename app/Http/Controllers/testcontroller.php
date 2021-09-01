<?php

namespace App\Http\Controllers;
use App\a;
use App\k;
use App\product;

use Illuminate\Http\Request;

class testcontroller extends Controller
{
public function adam()
    
{



//     $users=k::all();
//     // return $users->ye->m_id;()

//     foreach($users as $user)
//     {
// echo $user->id.'<br>'.$user->getdata->o_name;

//     }

$users=product::all();
foreach ($users as $user) {
    echo $user->catogerys->catogry_name.'<br>';

    // echo  count($user);
    
}

    
    // echo $users->a_name;
    // echo '<br>';
    // echo $users->agetfunction->title;
}
}
