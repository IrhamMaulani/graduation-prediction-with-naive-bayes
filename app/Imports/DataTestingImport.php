<?php

namespace App\Imports;

use App\Student;
use App\DataTesting;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataTestingImport implements ToModel, WithHeadingRow
{
    private $batch;

    public function __construct($batch)
    {
        $this->batch = $batch;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataTesting([
             'student_id' => $row['nim'],
            'gender'    => $row['jenis_kelamin'],
            'dwelling_place' => $row['status_tempat_tinggal'],
            'grade'         =>Student::convertGrade($row['ipk']),
            'high_school_grade_mean' => Student::convertHighSchoolGrade($row['nilai_un']),
            'parents_income' => Student::convertSalaryFormat($row['penghasilan_ortu']),
            'grad_status'   => $row['graduation'],
            'batch' => $this->batch,
        ]);
    }
}
