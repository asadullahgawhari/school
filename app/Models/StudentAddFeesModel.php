<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class StudentAddFeesModel extends Model
{
    use HasFactory;

    protected $table = 'student_add_fees';

    // For edit, update & delete
    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord($remove_pagination = 0)
    {
        $return = self::select('student_add_fees.*', 'class.name as class_name', 'users.name as created_by_name', 'student.name as student_first_name', 'student.last_name as student_last_name')
            ->join('class', 'class.id', '=', 'student_add_fees.class_id')
            ->join('users as student', 'student.id', '=', 'student_add_fees.student_id')
            ->join('users', 'users.id', '=', 'student_add_fees.created_by')
            ->where('student_add_fees.is_payment', '=', 1);

            if (!empty(Request::get('student_id'))) 
            {
                $return = $return->where('student_add_fees.student_id', '=', Request::get('student_id'));        
            }
            if (!empty(Request::get('student_name'))) {
                $return = $return->where('student.name', 'like', '%'.Request::get('student_name').'%');
            }
            if (!empty(Request::get('student_last_name'))) {
                $return = $return->where('student.last_name', 'like', '%'.Request::get('student_last_name').'%');
            }
            if (!empty(Request::get('class_id'))) 
            {
                $return = $return->where('student_add_fees.class_id', '=', Request::get('class_id'));        
            }
            if (!empty(Request::get('start_created_at'))) 
            {
                $return = $return->whereDate('student_add_fees.created_at', '>=', Request::get('start_created_at'));
            }
            if (!empty(Request::get('end_created_at'))) 
            {
                $return = $return->whereDate('student_add_fees.created_at', '<=', Request::get('end_created_at'));
            }
            if (!empty(Request::get('payment_type'))) 
            {
                $return = $return->where('student_add_fees.payment_type', '=', Request::get('payment_type'));
            }

            $return = $return->orderBy('student_add_fees.id', 'DESC');

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

    static public function getFees($student_id)
    {
        return self::select('student_add_fees.*', 'class.name as class_name', 'users.name as created_by_name')
            ->join('class', 'class.id', '=', 'student_add_fees.class_id')
            ->join('users', 'users.id', '=', 'student_add_fees.created_by')
            ->where('student_add_fees.is_payment', '=', 1)
            ->where('student_add_fees.student_id', '=', $student_id)
            ->get();
    }

    static public function getPaidAmount($student_id, $class_id)
    {
        return self::where('student_add_fees.class_id', '=', $class_id)
            ->where('student_add_fees.student_id', '=', $student_id)
            ->where('student_add_fees.is_payment', '=', 1)
            ->sum('student_add_fees.paid_amount');
    }

    // Total Fees
    static public function getTotalTodayFees()
    {
        return self::where('student_add_fees.is_payment', '=', 1)
            ->whereDate('student_add_fees.created_at', '=', date('Y-m-d'))
            ->sum('student_add_fees.paid_amount');
    }

    // Total Fees
    static public function getTotalFees()
    {
        return self::where('student_add_fees.is_payment', '=', 1)
            ->sum('student_add_fees.paid_amount');
    }

    // Count Fees for Student
    static public function TotalPaidAmountStudent($student_id)
    {
        return self::where('student_add_fees.is_payment', '=', 1)
            ->where('student_add_fees.student_id', '=', $student_id)
            ->sum('student_add_fees.paid_amount');
    }

    // Count fees for parent
    static public function TotalPaidAmountStudentParent($student_ids)
    {
        return self::where('student_add_fees.is_payment', '=', 1)
            ->whereIn('student_add_fees.student_id', $student_ids)
            ->sum('student_add_fees.paid_amount');
    }
}
