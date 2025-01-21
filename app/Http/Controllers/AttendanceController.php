<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\StudentAttendanceModel;
use App\Models\AssignClassTeacherModel;
use App\Exports\ExportAttendance;
use Auth;
use Excel;

class AttendanceController extends Controller
{
    public function StudentAttendance(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();

        if (!empty($request->get('class_id')) && !empty($request->get('attendance_date'))) 
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }

        $data['header_title'] = "Student Attendance";
        return view('admin.attendance.student', $data);
    }

    public function StudentAttendanceSubmit(Request $request)
    {
        $check_attendance = StudentAttendanceModel::checkAllreadyAttendance($request->student_id, $request->class_id, $request->attendance_date);

        if(!empty($check_attendance))
        {
            $attendance = $check_attendance;
        }
        else
        {
            $attendance = new StudentAttendanceModel;
            $attendance->student_id = $request->student_id;
            $attendance->class_id = $request->class_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;
        }
        $attendance->attendance_type = $request->attendance_type;
        $attendance->save();

        $json['message'] = "Student Attendance successfully saved";
        echo json_encode($json);
    }

    public function AttendanceReport(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = StudentAttendanceModel::getRecord();

        $data['header_title'] = "Attendance Report";
        return view('admin.attendance.report', $data);
    }

    // Export Excel
    public function export_attendance_report_to_excel(Request $request)
    {
        return Excel::download(new ExportAttendance, 'export_attendance_report_'.date('Y-m-d').'.xlsx');
    }

    // Teacher side - Attendance
    public function StudentAttendanceTeacher(Request $request)
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);

        if (!empty($request->get('class_id')) && !empty($request->get('attendance_date'))) 
        {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }

        $data['header_title'] = "Student Attendance";
        return view('teacher.attendance.student', $data);
    }

    public function AttendanceReportTeacher(Request $request)
    {
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $classarray = array();
        $data['getClass'] = $getClass;
        foreach ($getClass as $value) 
        {
            $classarray[] = $value->class_id;
        }

        $data['getRecord'] = StudentAttendanceModel::getRecordTeacher($classarray);

        $data['header_title'] = "Attendance Report";
        return view('teacher.attendance.report', $data);
    }

    // Student side Attendance
    public function MyAttendanceStudent()
    {
        $data['getRecord'] = StudentAttendanceModel::getRecordStudent(Auth::user()->id);

        $data['header_title'] = "My Attendance";
        return view('student.my_attendance', $data);
    }

    // Parent side Attendance
    public function MyAttendanceParent($student_id)
    {
        $data['getStudent'] = User::getSingle($student_id);
        $data['getRecord'] = StudentAttendanceModel::getRecordParent($student_id);

        $data['header_title'] = "Student Attendance";
        return view('parent.my_attendance', $data);
    }
}
