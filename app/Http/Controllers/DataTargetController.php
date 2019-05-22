<?php

namespace App\Http\Controllers;

use App\DataTarget;
use Illuminate\Http\Request;

class DataTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dataTestingBatchs = DataTesting::distinct()->get(['batch']);

        return view('datatarget.index');
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
     * @param  \App\DataTarget  $dataTarget
     * @return \Illuminate\Http\Response
     */
    public function show(DataTarget $dataTarget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataTarget  $dataTarget
     * @return \Illuminate\Http\Response
     */
    public function edit(DataTarget $dataTarget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataTarget  $dataTarget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataTarget $dataTarget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataTarget  $dataTarget
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataTarget $dataTarget)
    {
        //
    }
}
