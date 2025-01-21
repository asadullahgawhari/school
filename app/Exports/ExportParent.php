<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;

class ExportParent implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [

            "Parent ID",
            "Parent Name",
            "Gender",
            "Mobile Number",
            "Occupation",
            "Status",
            "Email",
            "Address",
            "Created Date",
            "Updated Date"

        ];
    }

    public function map($value): array
    {
        $parent_name = $value->name.' '.$value->last_name;
        $status = ($value->status == 0) ? 'Active' : 'Inactive';

        return [
            $value->id,
            $parent_name,
            $value->gender,
            $value->mobile_number,
            $value->occupation,
            $status,
            $value->email,
            $value->address,
            date('d-m-Y', strtotime($value->created_at)),
            date('d-m-Y', strtotime($value->updated_at))

        ];
    }

    public function collection()
    {
        $remove_pagination = 1;
        return User::getParent($remove_pagination);
    }
}
