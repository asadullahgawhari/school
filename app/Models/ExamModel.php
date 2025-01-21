<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ExamModel extends Model
{
    use HasFactory;

    protected $table = 'exam';

    static public function getRecord()
    {
        $return = self::select('exam.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0);

            // Searching
            if (!empty(Request::get('name'))) {
                $return = $return->where('exam.name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('last_name', 'like', '%'.Request::get('last_name').'%');
            }
            if (!empty(Request::get('note'))) {
                $return = $return->where('exam.note', 'like', '%'.Request::get('note').'%');
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('exam.created_at', '=', Request::get('date'));
            }

            $return = $return->orderBy('exam.id', 'DESC')
            ->paginate(10);

            return $return;
    }

    // For edit, update & delete
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getExam()
    {
        $return = self::select('exam.*')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0)
            ->orderBy('exam.name', 'ASC')
            ->get();

        return $return;
    }

    // Total Exam
    static public function getTotalExam()
    {
        $return = self::select('exam.id')
            ->join('users', 'users.id', '=', 'exam.created_by')
            ->where('exam.is_delete', '=', 0)
            ->count();

        return $return;
    }
}
