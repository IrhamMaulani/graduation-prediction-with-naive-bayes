<?php

namespace App\Http\Controllers;

use App\TestingTrial;
use Illuminate\Http\Request;

class TestingTrialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('testingtrial.index');
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

    public function toJson()
    {
        $testingTrial = TestingTrial::get();
        
        return response()->json(['data'=>$testingTrial]);
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
     * @param  \App\TestingTrial  $testingTrial
     * @return \Illuminate\Http\Response
     */
    public function show(TestingTrial $testingTrial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TestingTrial  $testingTrial
     * @return \Illuminate\Http\Response
     */
    public function edit(TestingTrial $testingTrial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TestingTrial  $testingTrial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TestingTrial $testingTrial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TestingTrial  $testingTrial
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestingTrial $testingTrial)
    {
        //
    }
}
