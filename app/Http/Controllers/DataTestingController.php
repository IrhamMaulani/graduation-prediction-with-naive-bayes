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
        return view('datatesting.index');
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

        $studentHighScoolGrade = Student::convertHighSchoolGrade($request->high_school_score);

        $grade = Student::convertGrade($request->grade);

        $salary = Student::convertSalary($request->salary);
        
        $totalPrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->get()->count();

        $totalLate = DataTraining::whereGraduation('TERLAMBAT')->get()->count();

        $total = $totalPrecise + $totalLate;

        //Gender

        $totalGenderPrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereGender($request->gender)->get()->count();

        $totalGenderLate = DataTraining::whereGraduation('TERLAMBAT')->whereGender($request->gender)->get()->count();
        //

        //Grade

        $totalGradePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereGender($grade)->get()->count();

        $totalGradeLate = DataTraining::whereGraduation('TERLAMBAT')->whereGender($grade)->get()->count();

        //

        //dwelling place

        $totalDwellingPlacePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereDwellingPlace($request->dwelling_place)->get()->count();

        $totalDwellingPlaceLate = DataTraining::whereGraduation('TERLAMBAT')->whereDwellingPlace($request->dwelling_place)->get()->count();

        //

        //High School Exam

        //need to classified to high, mid, and High Score in store dataTraining

        $totalHighSchoolScorePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')
        ->whereHighSchoolScore($studentHighScoolGrade)->get()->count();

        $totalHighSchoolScoreLate = DataTraining::whereGraduation('TERLAMBAT')
        ->whereHighSchoolScore($studentHighScoolGrade)->get()->count();

        //
        //parents Income

        $totalParentsIncomePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereParentsIncome($salary)->get()->count();

        $totalParentsIncomeLate = DataTraining::whereGraduation('TERLAMBAT')->whereParentsIncome($salary)->get()->count();


        $onTimeGrad = $totalPrecise/$total * $totalGenderPrecise/$totalPrecise * $totalGradePrecise/$totalPrecise * $totalDwellingPlacePrecise/$totalPrecise 
                    * $totalHighSchoolScorePrecise/$totalPrecise * $totalParentsIncomePrecise/$totalPrecise ;

        $lateGrad = $totalLate/$total * $totalGenderLate/$totalLate * $totalGradeLate/ $totalLate * $totalDwellingPlaceLate/$totalLate * $totalHighSchoolScoreLate/$totalLate
                    * $totalParentsIncomeLate/$totalLate;

    
        

        if ($onTimeGrad >= $lateGrad ) {
            return redirect('view')->with('message', 'Lulus Tepat Waktu');
        } elseif ($onTimeGrad < $lateGrad) {
            return redirect('view')->with('message', 'Lulus Terlambat');
        }

        DataTesting::create($request->all());
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