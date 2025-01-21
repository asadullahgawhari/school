<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarksGradeModel extends Model
{
    use HasFactory;

    protected $table = 'marks_grade';

    static public function getRecord()
    {
        return self::select('marks_grade.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'marks_grade.created_by')
            ->where('marks_grade.is_delete', '=', 0)
            ->orderBy('marks_grade.id', 'DESC')
            ->get();
    }

    // For edit, update & delete
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getGrade($percent)
    {
        $return = self::select('marks_grade.*')
            ->where('percent_from', '<=', $percent)
            ->where('percent_to', '>=', $percent)
            ->first();
        return !empty($return->name) ? $return->name : '';
    }
}
