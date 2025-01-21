<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkModel;
use App\Models\AssignClassTeacherModel;
use App\Models\HomeworkSubmitModel;
use App\Models\User;
use Auth;
use Str;

class HomeworkController extends Controller
{
    // Admin side
    public function homework()
    {
        $data['getRecord'] = HomeworkModel::getRecord();

        $data['header_title'] = "Homework";
        return view('admin.homework.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "add Homework";
        return view('admin.homework.add', $data);
    }

    public function insert(Request $request)
    {
        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if (!empty($request->file('document_file'))) 
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr =date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/homework/', $filename);

            $homework->document_file = $filename;   
        }

        $homework->save();

        return redirect('admin/homework/homework')->with('success', "Homework successfully created");
    }

    // Get Subject for Homework
    public function ajax_get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $getSubject = ClassSubjectModel::MySubject($class_id);
        $html = '';
        $html .= '<option value="">Select Subject</option>';
        foreach($getSubject as $value)
        {
            $html .= '<option value="'.$value->subject_id.'">'.$value->subject_name.'</option>';
        }

        $json['success'] = $html;
        echo json_encode($json);
    }

    public function edit($id)
    { 
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Edit Homework";
        return view('admin.homework.edit', $data);
    }

    public function update($id, Request $request)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if (!empty($request->file('document_file'))) 
        {
            if (!empty($homework->getDocument())) 
            {
                unlink('public/dist/img/homework/'.$homework->document_file);
            }
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr =date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/homework/', $filename);

            $homework->document_file = $filename;   
        }

        $homework->save();

        return redirect('admin/homework/homework')->with('success', "Homework successfully updated");
    }

    public function delete($id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->is_delete = 1;
        $homework->save();

        return redirect()->back()->with('danger', "Homework successfully deleted");
    }

    // Submitted Homework Admin
    public function submitted($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);
        if (!empty($homework)) 
        {
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = "Submitted Homework";
            return view('admin.homework.submitted', $data);        
        }
        else
        {
            abort(404);
        }
    }

    // Teacher side
    public function HomeworkTeacher()
    {
        $class_ids = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach($getClass as $class)
        {
            $class_ids[] = $class->class_id;
        }
        $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids);

        $data['header_title'] = "Homework";
        return view('teacher.homework.list', $data);
    }

    public function AddTeacher()
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);

        $data['header_title'] = "add Homework";
        return view('teacher.homework.add', $data);
    }

    public function InsertTeacher(Request $request)
    {
        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if (!empty($request->file('document_file'))) 
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr =date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/homework/', $filename);

            $homework->document_file = $filename;   
        }

        $homework->save();

        return redirect('teacher/homework/homework')->with('success', "Homework successfully created");
    }

    public function EditTeacher($id)
    { 
        $getRecord = HomeworkModel::getSingle($id);

        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = "Edit Homework";
        return view('teacher.homework.edit', $data);
    }

    public function UpdateTeacher($id, Request $request)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if (!empty($request->file('document_file'))) 
        {
            if (!empty($homework->getDocument())) 
            {
                unlink('public/dist/img/homework/'.$homework->document_file);
            }
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr =date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/homework/', $filename);

            $homework->document_file = $filename;   
        }

        $homework->save();

        return redirect('teacher/homework/homework')->with('success', "Homework successfully updated");
    }

    // Submitted Homework - Teacher
    public function submittedTeacher($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);
        if (!empty($homework)) 
        {
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = "Submitted Homework";
            return view('teacher.homework.submitted', $data);        
        }
        else
        {
            abort(404);
        }
    }

    // Student side
    public function MyHomeworkStudent()
    {
        $data['getRecord'] = HomeworkModel::getRecordStudent(Auth::user()->class_id, Auth::user()->id);

        $data['header_title'] = "My Homework";
        return view('student.homework.list', $data);
    }

    public function SubmitHomework($homework_id)
    {
        $data['getRecord'] = HomeworkModel::getSingle($homework_id);

        $data['header_title'] = "Submit My Homework";
        return view('student.homework.submit', $data); 
    }

    public function SubmitHomeworkInsert($homework_id, Request $request)
    {
        $homework = new HomeworkSubmitModel;
        $homework->homework_id = $homework_id;
        $homework->student_id = Auth::user()->id;
        $homework->description = trim($request->description);

        if (!empty($request->file('document_file'))) 
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr =date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/homework/', $filename);

            $homework->document_file = $filename;   
        }

        $homework->save();

        return redirect('student/my_homework')->with('success', "Homework successfully Submitted");

    }

    // Submitted Homework Student
    public function MySubmittedHomework(Request $request)
    {
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent(Auth::user()->id);

        $data['header_title'] = "My Submitted Homework";
        return view('student.homework.submitted_list', $data);
    }

    // Parent side
    public function MyHomeworkParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkModel::getRecordStudent($getStudent->class_id, $getStudent->id);

        $data['header_title'] = "Student Homework";
        $data['getStudent'] = $getStudent;
        return view('parent.homework.list', $data);
    }

    public function MySubmittedHomeworkParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent($getStudent->id);

        $data['header_title'] = "Student Submitted Homework";
        $data['getStudent'] = $getStudent;
        return view('parent.homework.submitted_list', $data);
    }

    // Homework Report
    public function HomeworkReport()
    {
        $data['getRecord'] = HomeworkSubmitModel::getHomeworkReport();

        $data['header_title'] = "Homework Report";
        return view('admin.homework.report', $data);
    }
}
