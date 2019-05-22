<?php

namespace App\Http\Controllers;

use App\Student;
use App\NaiveBayes;
use App\DataTesting;
use App\TestingTrial;
use Illuminate\Http\Request;
use App\Imports\DataTestingImport;
use Maatwebsite\Excel\Facades\Excel;

class DataTestingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $studentHighScoolGrade = Student::convertSalaryFormat("> 5.000.000 - 6.000.000");

        $dataTestingBatchs = DataTesting::distinct()->get(['batch']);

        return view('datatesting.index', ['dataTestingBatchs' => $dataTestingBatchs]);
    }

    
    public function toJson($batch)
    {
        $dataTesting = new DataTesting;

        if ($batch != "ALL") {
            $dataTesting = $dataTesting->whereBatch($batch);
        }


        $dataTesting = $dataTesting->get();
        
        return response()->json(['data'=>$dataTesting]);
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
        $batch = $request->batch;

        $dataTestings = DataTesting::whereBatch($batch)->get();


        foreach ($dataTestings as $dataTesting) {
            // $highSchoolGradeMean = $dataTesting->high_school_grade_mean;

            // $grade = $dataTesting->grade;

            // $salary = $dataTesting->parents_income;
        
            $gradPrediction =
            NaiveBayes::calculate(
                $dataTesting->high_school_grade_mean,
                $dataTesting->grade,
                $dataTesting->parents_income,
                $dataTesting->gender,
                $dataTesting->dwelling_place,
                $batch
            );

            $dataTesting-> prediction_grad_status  = $gradPrediction['value1'];
            $dataTesting-> ontime_grade = $gradPrediction['value2'];
            $dataTesting-> late_grad = $gradPrediction['value3'];


            $dataTesting->save();
        }

        
        $trueOnTime = DataTesting::whereBatch($batch)->whereColumn('grad_status', 'prediction_grad_status')->whereGradStatus('TEPAT_WAKTU')->get()->count();

        $falseOnTime =DataTesting::whereBatch($batch)->whereColumn('grad_status', '!=', 'prediction_grad_status')->whereGradStatus('TEPAT_WAKTU')->get()->count();

        $trueLate = DataTesting::whereBatch($batch)->whereColumn('grad_status', 'prediction_grad_status')->whereGradStatus('TERLAMBAT')->get()->count();

        $falseLate = DataTesting::whereBatch($batch)->whereColumn('grad_status', '!=', 'prediction_grad_status')->whereGradStatus('TERLAMBAT')->get()->count();

        $totalData = DataTesting::whereBatch($batch)->get()->count();

        // $confusionMatrix = NaiveBayes::calculateConfusionMatrix($totalData, $trueOnTime, $falseOnTime, $trueLate, $falseLate);

     

        $testingTrial = new TestingTrial([
            'precision_data' => NaiveBayes::calculatePrecision($trueOnTime, $falseOnTime),
            'recall_data'    =>  NaiveBayes::calculateRecall($trueOnTime, $falseLate),
            'accuracy_data'  =>  NaiveBayes::calculateAccuracy($totalData, $trueOnTime, $trueLate),
            'batch'         => $batch
        ]);

       

        $testingTrial->save();



        if ($dataTesting) {
            return redirect('admin/data-testing')->with('message', 'Data telah di Update');
        } else {
            return redirect('admin/data-testing')->with('error', 'Data telah salah');
        }

        

        // $dataTesting = new DataTesting([
        //     'student_id' => $request->student_id,
        //     'gender'    => $request->gender,
        //     'dwelling_place' => $request->dwelling_place,
        //     'grade'         =>$grade,
        //     'high_school_grade_Mean' => $highSchoolGradeMean,
        //     'parents_income' => $request->salary,
        //     'grad_status'   => $request->grad_status,
        //     'grad_status_prediction' =>$gradPrediction
        // ]);


        // $precision  = NaiveBayes::calculateAccuracy();

        // $testingTrial = new TestingTrial;

        // if ($dataTesting->save()) {
        //     return "OK";
        // } else {
        //     return "NO";
        // }
    }

    public function import()
    {
        $dataTraining = DataTesting::orderby('created_at', 'desc')->first();

        $numberOfBatch = 0;

        if (is_null($dataTraining)) {
            $numberOfBatch = 1;
        } else {
            $numberOfBatch = $dataTraining->batch + 1;
        }

        Excel::import(new DataTestingImport($numberOfBatch), request()->file('file'));
           
        return back();
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
