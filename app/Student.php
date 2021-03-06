<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public static function convertGrade($grade)
    {
        if ($grade >3.75  && $grade <= 4.00) {
            return "A";
        } elseif ($grade >= 3.75 && $grade < 4.00) {
            return "A-";
        } elseif ($grade >= 3.5 && $grade < 3.75) {
            return "B+";
        } elseif ($grade >= 3.00 && $grade < 3.5) {
            return "B";
        } elseif ($grade >= 2.75 && $grade < 3.0) {
            return "B-";
        } elseif ($grade >= 2.50 && $grade < 2.75) {
            return "C+";
        } elseif ($grade >= 2.00 && $grade < 2.50) {
            return "C";
        } elseif ($grade >= 1.50 && $grade < 2.00) {
            return "D+";
        } elseif ($grade >= 1.00 && $grade < 1.50) {
            return "D";
        } elseif ($grade <= 1.0) {
            return "E";
        }
    }

    //Rata-rata Ujian Nasional
    public static function convertHighSchoolGrade($highSchoolGrade)
    {
        if ($highSchoolGrade >= 80) {
            return "Tinggi";
        } elseif ($highSchoolGrade >= 60 && $highSchoolGrade <80) {
            return "Sedang";
        } elseif ($highSchoolGrade < 60) {
            return "Rendah";
        }
    }

    public static function convertSalary($salary)
    {
        if ($salary >= 4500000) {
            return 5;
        } elseif ($salary >= 3750000 && $salary < 4500000) {
            return 4;
        } elseif ($salary >= 3000000 && $salary < 3750000) {
            return 3;
        } elseif ($salary >= 980000 && $salary < 3000000) {
            return 2;
        } elseif ($salary <= 500000 && $salary < 980000) {
            return 1;
        }
    }

    public static function convertSalaryFormat($salary)
    {
        if ($salary == "> 5.000.000 - 6.000.000" || $salary == "> 15.000.000" || $salary == "> 6.000.000 - 7.000.000" || $salary == "> 10.000.000 - 15.000.000"
         || $salary == "> 10.000.000 - 15.000.000" || $salary == "> 9.000.000 - 10.000.000") {
            return 5;
        } elseif ($salary == "> 3.000.000 - 4.000.000" || $salary == "> 4.000.000 - 5.000.000") {
            return 4;
        } elseif ($salary == "> 2.000.000 - 3.000.000") {
            return 3;
        } elseif ($salary == "> 1.000.000 - 2.000.000") {
            return 2;
        } elseif ($salary == "< 1.000.000") {
            return 1;
        }
    }
}
