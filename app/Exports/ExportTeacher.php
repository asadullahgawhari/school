<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;

class ExportTeacher implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [

            "Teacher ID",
            "Teacher Name",
            "Gender",
            "Date of Birth",
            "Mobile Number",
            "Joining Date",
            "Status",
            "Email",
            "Marital Status",
            "Current Address",
            "Permanent Address",
            "Qualification",
            "Work Experience",
            "Note",
            "Created Date",
            "Updated Date"

        ];
    }

    public function map($value): array
    {
        $student_name = $value->name.' '.$value->last_name;
        $parent_name = $value->parent_name.' '.$value->parent_last_name;

        $date_of_birth = '';
        if(!empty($value->date_of_birth))
        {
            $date_of_birth = date('d-m-Y', strtotime($value->date_of_birth));
        }
        $admission_date = '';
        if(!empty($value->admission_date))
        {
            $admission_date = date('d-m-Y', strtotime($value->admission_date));
        }

        $status = ($value->status == 0) ? 'Active' : 'Inactive';

        return [
            $value->id,
            $student_name,
            $value->gender,
            $date_of_birth,
            $value->mobile_number,
            $admission_date,
            $status,
            $value->email,
            $value->marital_status,
            $value->address,
            $value->permanent_address,
            $value->qualification,
            $value->work_experience,
            $value->note,
            date('d-m-Y', strtotime($value->created_at)),
            date('d-m-Y', strtotime($value->updated_at))

        ];
    }

    public function collection()
    {
        $remove_pagination = 1;
        return User::getTeacher($remove_pagination);
    }
}
