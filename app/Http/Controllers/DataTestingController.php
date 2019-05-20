<?php

namespace App\Http\Controllers;

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
        $totalPrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->get()->count();

        $totalLate = DataTraining::whereGraduation('TERLAMBAT')->get()->count();

        //Gender

        $totalGenderPrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereGender($request->gender)->get()->count();

        $totalGenderLate = DataTraining::whereGraduation('TERLAMBAT')->whereGender($request->gender)->get()->count();
        //

        //dwelling place

        $totalDwellingPlacePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereDwellingPlace($request->dwelling_place)->get()->count();

        $totalDwellingPlaceLate = DataTraining::whereGraduation('TERLAMBAT')->whereDwellingPlace($request->dwelling_place)->get()->count();

        //

        //High School Exam

        //need to classified to high, mid, and High Score in store dataTraining

        $totalHighSchoolScorePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereHighSchoolScore($request->high_school_score)->get()->count();

        $totalHighSchoolScoreLate = DataTraining::whereGraduation('TERLAMBAT')->whereHighSchoolScore($request->high_school_score)->get()->count();

        //
        //parents Income

        $totalParentsIncomePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereParentsIncome($request->parents_income)->get()->count();

        $totalParentsIncomeLate = DataTraining::whereGraduation('TERLAMBAT')->whereParentsIncome($request->parents_income)->get()->count();

        //number of parents dependents
        $totalParentsDependentsPrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereDependents($request->parents_dependents)->get()->count();

        $totalParentsDependentsLate = DataTraining::whereGraduation('TERLAMBAT')->whereDependents($request->parents_dependents)->get()->count();

        //

        $onTimeGrad = $totalGenderPrecise/$totalPrecise * $totalDwellingPlacePrecise/$totalPrecise * $totalHighSchoolScorePrecise/$totalPrecise
                    * $totalParentsIncomePrecise/$totalPrecise * $totalParentsDependentsPrecise/$totalPrecise;

        $lateGrad = $totalGenderLate/$totalLate * $totalDwellingPlaceLate/$totalLate * $totalHighSchoolScoreLate/$totalLate
                    * $totalParentsIncomeLate/$totalLate * $totalParentsDependentsLate/$totalLate;


        if ($onTimeGrad > $lateGrad || $onTimeGrad == $lateGrad) {
            return redirect('view')->with('message', 'Lulus Tepat Waktu');
        } elseif ($onTimeGrad < $lateGrad) {
            return redirect('view')->with('message', 'Lulus Terlambat');
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
