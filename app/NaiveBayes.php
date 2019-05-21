<?php
namespace App;

class NaiveBayes
{
    public static function calculate($HighSchoolGradeMean, $grade, $salary, $gender, $dwellingPlace)
    {
        $totalPrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->get()->count();

        $totalLate = DataTraining::whereGraduation('TERLAMBAT')->get()->count();

        $total = $totalPrecise + $totalLate;

        //Gender

        $totalGenderPrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereGender($gender)->get()->count();

        $totalGenderLate = DataTraining::whereGraduation('TERLAMBAT')->whereGender($gender)->get()->count();
        //

        //Grade

        $totalGradePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereGender($grade)->get()->count();

        $totalGradeLate = DataTraining::whereGraduation('TERLAMBAT')->whereGender($grade)->get()->count();

        //

        //dwelling place

        $totalDwellingPlacePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereDwellingPlace($dwellingPlace)->get()->count();

        $totalDwellingPlaceLate = DataTraining::whereGraduation('TERLAMBAT')->whereDwellingPlace($dwellingPlace)->get()->count();

        //

        //High School Exam

        //need to classified to high, mid, and High Score in store dataTraining

        $totalHighSchoolScorePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')
        ->whereHighSchoolScore($HighSchoolGradeMean)->get()->count();

        $totalHighSchoolScoreLate = DataTraining::whereGraduation('TERLAMBAT')
        ->whereHighSchoolScore($HighSchoolGradeMean)->get()->count();

        //
        //parents Income

        $totalParentsIncomePrecise = DataTraining::whereGraduation('TEPAT_WAKTU')->whereParentsIncome($salary)->get()->count();

        $totalParentsIncomeLate = DataTraining::whereGraduation('TERLAMBAT')->whereParentsIncome($salary)->get()->count();


        $onTimeGrad = $totalPrecise/$total *
                      $totalGenderPrecise + 1 /$totalPrecise + 2 *
                      $totalGradePrecise + 1/$totalPrecise + 10 *
                      $totalDwellingPlacePrecise + 1 / $totalPrecise + 6 *
                      $totalHighSchoolScorePrecise + 1 /$totalPrecise +3 *
                      $totalParentsIncomePrecise+ 1/ $totalPrecise + 5 ;

        $lateGrad = $totalLate/$total *
                    $totalGenderLate + 1 /$totalLate + 2 *
                    $totalGradeLate + 1 / $totalLate + 10 *
                    $totalDwellingPlaceLate + 1 /$totalLate + 6 *
                    $totalHighSchoolScoreLate + 1 /$totalLate + 3 *
                    $totalParentsIncomeLate + 1/$totalLate + 5;

        if ($onTimeGrad >= $lateGrad) {
            return "TEPAT_WAKTU";
        } elseif ($onTimeGrad < $lateGrad) {
            return "TERLAMBAT";
        }
    }

    // public static function calculatePrecision($totalData, $trueOnTime, $falseOnTime, $trueLate, $falseLate)
    // {
    //     return $trueOnTime + $trueLate / $totalData;
    // }

    public static function calculateAccuracy($totalData, $trueOnTime, $falseOnTime, $trueLate, $falseLate)
    {
        return number_format($trueOnTime + $trueLate / $totalData * 100, 2) . '%';
    }
}
