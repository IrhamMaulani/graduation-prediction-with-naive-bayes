<?php

namespace App\Http\Controllers;

use App\DataTraining;
use App\TestingTrial;
use App\Imports\DataTrainingImport;
use Maatwebsite\Excel\Facades\Excel;

class DataTrainingController extends Controller
{
    public function index()
    {
        return view('datatraining.index');
    }

    public function toJson()
    {
        $dataTraining = DataTraining::with('testingTrial')->get();
        
        return response()->json(['data'=>$dataTraining]);
    }

    public function store(Request $request)
    {
        $dataTraining = new DataTraining([
            'student_id' => $request->student_id,
            'gender'    => $request->gender,
            'dwelling_place' => $request->dwelling_place,
            'grade'         =>$grade,
            'high_school_grade_Mean' => $highSchoolGradeMean,
            'parents_income' => $request->salary,
            'grad_status'   => $request->grad_status,
        ]);

        if ($dataTraining->save()) {
            return "OK";
        } else {
            return "NO";
        }
    }

    public function import()
    {
        $trial = TestingTrial::orderby('created_at', 'desc')->first();

        $numberOfTrial = 0;

        if (is_null($trial)) {
            $numberOfTrial = 1;
        } else {
            $numberOfTrial = $trial->trials + 1;
        }

        $trialData = new TestingTrial([
            'trials'    => $numberOfTrial
        ]);

        $trialData->save();

        Excel::import(new DataTrainingImport($trialData->id), request()->file('file'));
           
        return back();
    }

    public function destroy($id)
    {
        DataTraining::destroy($id);
        return response()->json(['success'=>'Data is successfully deleted']);
    }
}
