<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\labwork;
use App\plant;
use App\dental;
use App\childdantel;
use App\Catogery;
use App\Product;

class Xworkshopcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plants = plant::latest()->get();
        $labworks=labwork::all();
        $dental=dental::all();
        $childdantels=childdantel::all();
        $catogery=Catogery::with('products')->get();
        return view('workshop.workshop_add')->with('catogery',$catogery)->with('dental',$dental)->with('childdantels',$childdantels)->with('plants',$plants)->with('labworks',$labworks);
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
