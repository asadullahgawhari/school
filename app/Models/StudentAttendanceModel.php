<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class StudentAttendanceModel extends Model
{
    use HasFactory;

    protected $table = 'student_attendance';

    static public function checkAllreadyAttendance($student_id, $class_id, $attendance_date)
    {
        return self::where('student_id', '=', $student_id)->where('class_id', '=', $class_id)->where('attendance_date', '=', $attendance_date)->first();
    }

    static public function getRecord($remove_pagination = 0)
    {
        $return = self::select('student_attendance.*', 'class.name as class_name', 'student.name as student_name', 'student.last_name as student_last_name', 'created_by.name as created_by_name')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->join('users as student', 'student.id', '=', 'student_attendance.student_id')
            ->join('users as created_by', 'created_by.id', '=', 'student_attendance.created_by');

            if (!empty(Request::get('student_id'))) 
            {
                $return = $return->where('student_attendance.student_id', '=', Request::get('student_id'));        
            }
            if (!empty(Request::get('student_name'))) {
                $return = $return->where('student.name', 'like', '%'.Request::get('student_name').'%');
            }
            if (!empty(Request::get('class_id'))) 
            {
                $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));        
            }
            if (!empty(Request::get('attendance_date'))) 
            {
                $return = $return->where('student_attendance.attendance_date', '=', Request::get('attendance_date'));
            }
            if (!empty(Request::get('attendance_type'))) 
            {
                $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
            }

        $return = $return->orderBy('student_attendance.id', 'DESC');

            if (!empty($remove_pagination)) 
            {
                $return = $return->get();        
            }
            else
            {
                $return = $return->paginate(20);
            }
        
        return $return;
    }

    static public function getRecordTeacher($class_ids)
    {
        if (!empty($class_ids)) 
        {
            $return = self::select('student_attendance.*', 'class.name as class_name', 'student.name as student_name', 'student.last_name as student_last_name', 'created_by.name as created_by_name')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->join('users as student', 'student.id', '=', 'student_attendance.student_id')
            ->join('users as created_by', 'created_by.id', '=', 'student_attendance.created_by')
            ->whereIn('student_attendance.class_id', $class_ids);

            if (!empty(Request::get('student_id'))) 
            {
                $return = $return->where('student_attendance.student_id', '=', Request::get('student_id'));        
            }
            if (!empty(Request::get('student_name'))) {
                $return = $return->where('student.name', 'like', '%'.Request::get('student_name').'%');
            }
            if (!empty(Request::get('class_id'))) 
            {
                $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));        
            }
            if (!empty(Request::get('attendance_date'))) 
            {
                $return = $return->where('student_attendance.attendance_date', '=', Request::get('attendance_date'));
            }
            if (!empty(Request::get('attendance_type'))) 
            {
                $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
            }

        $return = $return->orderBy('student_attendance.id', 'DESC')
            ->paginate(20);
        return $return;
        }
        else
        {
            return "";
        }
    }

    // Student side Attendance
    static public function getRecordStudent($student_id)
    {
        $return = self::select('student_attendance.*', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->where('student_attendance.student_id', '=', $student_id);

            if (!empty(Request::get('class_id'))) 
            {
                $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));        
            }
            if (!empty(Request::get('attendance_date'))) 
            {
                $return = $return->where('student_attendance.attendance_date', '=', Request::get('attendance_date'));
            }
            if (!empty(Request::get('attendance_type'))) 
            {
                $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
            }
            
        $return = $return->orderBy('student_attendance.id', 'DESC')
            ->paginate(20);
        return $return;
    }

    // Count Attendance for parent
    static public function getStudentParentCount($student_ids)
    {
        return self::select('student_attendance.id')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->whereIn('student_attendance.student_id', $student_ids)
            ->count();
    }

    // Parent side Attendance
    static public function getRecordParent($student_id)
    {
        $return = self::select('student_attendance.*', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'student_attendance.class_id')
            ->where('student_attendance.student_id', '=', $student_id);

            if (!empty(Request::get('class_id'))) 
            {
                $return = $return->where('student_attendance.class_id', '=', Request::get('class_id'));        
            }
            if (!empty(Request::get('attendance_date'))) 
            {
                $return = $return->where('student_attendance.attendance_date', '=', Request::get('attendance_date'));
            }
            if (!empty(Request::get('attendance_type'))) 
            {
                $return = $return->where('student_attendance.attendance_type', '=', Request::get('attendance_type'));
            }
            
        $return = $return->orderBy('student_attendance.id', 'DESC')
            ->paginate(20);
        return $return;
    }
}
