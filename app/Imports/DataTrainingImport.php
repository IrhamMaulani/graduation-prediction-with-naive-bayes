<?php

namespace App\Imports;

use App\Student;
use App\DataTraining;
use App\TestingTrial;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataTrainingImport implements ToModel, WithHeadingRow
{
    private $trialId;

    public function __construct($trialId)
    {
        $this->trialId = $trialId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $trial = TestingTrial::orderby('created_at', 'desc')->first();
        

        return new DataTraining([
             'student_id' => $row['nim'],
            'gender'    => $row['jenis_kelamin'],
            'dwelling_place' => $row['status_tempat_tinggal'],
            'grade'         =>Student::convertGrade($row['ipk']),
            'high_school_grade_mean' => Student::convertHighSchoolGrade($row['nilai_un']),
            'parents_income' => Student::convertSalaryFormat($row['penghasilan_ortu']),
            'grad_status'   => $row['graduation'],
            'testing_trial_id' => $this->trialId,
        ]);
    }
}
