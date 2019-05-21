<?php

namespace App\Http\Controllers;

use App\Student;
use App\DataTesting;
use Illuminate\Http\Request;

class DataTestingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentHighScoolGrade = Student::convertSalaryFormat("> 5.000.000 - 6.000.000");

        return view('datatesting.index', ['studentHighScoolGrade' => $studentHighScoolGrade]);
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
        $highSchoolGradeMean = Student::convertHighSchoolGrade($request->high_school_score);

        $grade = Student::convertGrade($request->grade);

        $salary = Student::convertSalary($request->salary);
        
        $gradPrediction = NaiveBayes::calculate($highSchoolGradeMean, $grade, $salary, $request->gender, $request->dwelling_place);

        $dataTesting = new DataTesting([
            'student_id' => $request->student_id,
            'gender'    => $request->gender,
            'dwelling_place' => $request->dwelling_place,
            'grade'         =>$grade,
            'high_school_grade_Mean' => $highSchoolGradeMean,
            'parents_income' => $request->salary,
            'grad_status'   => $request->grad_status,
            'grad_status_prediction' =>$gradPrediction
        ]);

        if ($dataTesting->save()) {
            return "OK";
        } else {
            return "NO";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataTesting  $dataTesting
     * @return \Illuminate\Http\Response
     */
    public function show(DataTesting $dataTesting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataTesting  $dataTesting
     * @return \Illuminate\Http\Response
     */
    public function edit(DataTesting $dataTesting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataTesting  $dataTesting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataTesting $dataTesting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataTesting  $dataTesting
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataTesting $dataTesting)
    {
        //
    }
}
