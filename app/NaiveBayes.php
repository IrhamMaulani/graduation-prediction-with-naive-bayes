<?php
namespace App;

class NaiveBayes
{
    public static function calculate($highSchoolGradeMean, $grade, $salary, $gender, $dwellingPlace, $batch)
    {
        $totalPrecise = DataTraining::whereBatch($batch)->whereGradStatus('TEPAT_WAKTU')->get()->count();

        $totalLate = DataTraining::whereBatch($batch)->whereGradStatus('TERLAMBAT')->get()->count();

        $total =  DataTraining::whereBatch($batch)->get()->count();

        //Gender

        $totalGenderPrecise = DataTraining::whereBatch($batch)->whereGradStatus('TEPAT_WAKTU')->whereGender($gender)->get()->count();

        $totalGenderLate = DataTraining::whereBatch($batch)->whereGradStatus('TERLAMBAT')->whereGender($gender)->get()->count();
        //

        //Grade

        $totalGradePrecise = DataTraining::whereBatch($batch)->whereGradStatus('TEPAT_WAKTU')->whereGrade($grade)->get()->count();

        $totalGradeLate = DataTraining::whereBatch($batch)->whereGradStatus('TERLAMBAT')->whereGrade($grade)->get()->count();

        //

        //dwelling place

        $totalDwellingPlacePrecise = DataTraining::whereBatch($batch)->whereGradStatus('TEPAT_WAKTU')->whereDwellingPlace($dwellingPlace)->get()->count();

        $totalDwellingPlaceLate = DataTraining::whereBatch($batch)->whereGradStatus('TERLAMBAT')->whereDwellingPlace($dwellingPlace)->get()->count();

        //

        //High School Exam

        //need to classified to high, mid, and High Score in store dataTraining

        $totalHighSchoolScorePrecise = DataTraining::whereBatch($batch)->whereGradStatus('TEPAT_WAKTU')
        ->whereHighSchoolGradeMean($highSchoolGradeMean)->get()->count();

        $totalHighSchoolScoreLate = DataTraining::whereBatch($batch)->whereGradStatus('TERLAMBAT')
        ->whereHighSchoolGradeMean($highSchoolGradeMean)->get()->count();

        //
        //parents Income

        $totalParentsIncomePrecise = DataTraining::whereBatch($batch)->whereGradStatus('TEPAT_WAKTU')->whereParentsIncome($salary)->get()->count();

        $totalParentsIncomeLate = DataTraining::whereBatch($batch)->whereGradStatus('TERLAMBAT')->whereParentsIncome($salary)->get()->count();


        $onTimeGrad = 0;
        $lateGrad = 0;

        $genderPrecise =  (($totalGenderPrecise + 1) /($totalPrecise + 2));

        $genderLate = (($totalGenderLate + 1) / ($totalLate + 2));

        $gradePrecise = (($totalGradePrecise + 1)/($totalPrecise + 10));

        $gradeLate = (($totalGradeLate + 1) / ($totalLate + 10));

        $dwellingPlacePrecise = (($totalDwellingPlacePrecise + 1)/ ($totalPrecise + 6));

        $dwellingPlaceLate =  (($totalDwellingPlaceLate + 1) /($totalLate + 6));

        $highSchoolGradePrecise = (($totalHighSchoolScorePrecise + 1) / ($totalPrecise +3));

        $highSchoolGradeLate = (($totalHighSchoolScoreLate + 1) /($totalLate + 3));

        $parentsIncomePrecise =  (($totalParentsIncomePrecise+ 1)/ ($totalPrecise + 5));

        $parentsIncomeLate =  (($totalParentsIncomeLate + 1)/($totalLate + 5));

        
        $onTimeGrad = $genderPrecise * $gradePrecise* $dwellingPlacePrecise* $highSchoolGradePrecise * $parentsIncomePrecise;

        $onTimeGrad = number_format((float) $onTimeGrad * ($totalPrecise/$total), 5, '.', '');

        
       

        $lateGrad =$genderLate*$gradeLate*$dwellingPlaceLate*$highSchoolGradeLate*$parentsIncomeLate;

        $lateGrad = number_format((float)$lateGrad * ($totalLate/$total), 5, '.', '');

        // return response()->json($totalPrecise . $totalLate);

        // exit();

        


        if ($onTimeGrad >= $lateGrad) {
            return  ['value1'=> 'TEPAT_WAKTU', 'value2' =>$onTimeGrad, 'value3' => $lateGrad];
        } elseif ($onTimeGrad < $lateGrad) {
            return  ['value1'=> 'TERLAMBAT'  , 'value2' =>$onTimeGrad, 'value3' => $lateGrad];
        }
    }

    // public static function calculatePrecision($totalData, $trueOnTime, $falseOnTime, $trueLate, $falseLate)
    // {
    //     return $trueOnTime + $trueLate / $totalData;
    // }

    // public static function calculateConfusionMatrix($totalData, $trueOnTime, $falseOnTime, $trueLate, $falseLate)
    // {
    //     $precision = NaiveBayes::calculatePrecision($trueOnTime, $falseOnTime);

    //     $recall = NaiveBayes::calculateRecall($trueOnTime, $falseLate);

    //     $accuracy = NaiveBayes::calculateAccuracy($totalData, $trueOnTime, $trueLate);

    //     return ['precision' => $precision, 'recall' => $recall, 'accuracy' => $accuracy];
    // }


    public static function calculatePrecision($trueOnTime, $falseOnTime)
    {
        return number_format($trueOnTime / ($trueOnTime + $falseOnTime) * 100, 2) . '%';
    }
    

    public static function calculateRecall($trueOnTime, $falseLate)
    {
        return number_format($trueOnTime / ($trueOnTime + $falseLate)  * 100, 2) . '%';
    }

    public static function calculateAccuracy($totalData, $trueOnTime, $trueLate)
    {
        return number_format(($trueOnTime + $trueLate) / $totalData * 100, 2) . '%';
    }
}
