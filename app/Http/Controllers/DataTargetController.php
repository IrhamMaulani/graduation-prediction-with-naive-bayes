<?php

namespace App\Http\Controllers;

use App\Student;
use App\DataTarget;
use App\NaiveBayes;
use App\TestingTrial;
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

        $batchs = TestingTrial::get(['id', 'batch']);

    

        return view('datatarget.index', ['batchs' => $batchs]);
    }

    public function toJson()
    {
        $dataTargets = DataTarget::with('testingTrial')->get();

        return response()->json(['data'=>$dataTargets]);
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
        $ipk  = Student::convertGrade($request->grade);

        $nilaiUan = Student::convertHighSchoolGrade($request->high_school_grade_mean);

        $gajiOrtu = Student::convertSalaryFormat($request->parents_income);

        $batch = TestingTrial::orderBy('accuracy_data', 'desc')->first();

        // dd($batch);

        $prediksiKelulusan  = NaiveBayes::calculate($nilaiUan, $ipk, $gajiOrtu, $request->gender, $request->dwelling_place, $batch->batch);

        $dataTarget = new DataTarget;

        $dataTarget->student_id = $request->student_id;
        $dataTarget->gender = $request->gender;
        $dataTarget->dwelling_place = $request->dwelling_place;
        $dataTarget->grad_prediction = $prediksiKelulusan['value1'];
        $dataTarget->high_school_grade_mean = $nilaiUan;
        $dataTarget->grade = $ipk;
        $dataTarget->parents_income = $gajiOrtu;
        $dataTarget->testing_trial_id = $batch->id;
        

        // dd($prediksiKelulusan['value1']);

        if ($dataTarget->save()) {
            return redirect('admin/data-target')->with('message', 'Data Berhasil Ditambahkan');
        } else {
            return redirect('admin/data-target')->with('message', 'Terjadi Kesalahan');
        }
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
    public function destroy($id)
    {
        DataTarget::destroy($id);
        return response()->json(['message'=>'Data is successfully deleted']);
    }
}
