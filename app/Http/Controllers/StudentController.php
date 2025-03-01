<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use App\Exports\ExportStudent;
use Hash;
use Auth;
use Str;
use Excel;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = "Student List";
        return view('admin.student.list', $data);
    }

    // Export to Excel
    public function export_student_excel(Request $request)
    {
        return Excel::download(new ExportStudent, 'export_student_'.date('Y-m-d').'.xlsx');
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Student";
        return view('admin.student.add', $data);
    }

    public function insert(Request $request)
    {

        // Data Validation
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:6'
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) 
        {            
            $student->date_of_birth = trim($request->date_of_birth);
        }
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        if (!empty($request->admission_date)) 
        {
            $student->admission_date = trim($request->admission_date);            
        }

        if (!empty($request->file('profile_pic'))) 
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/profile/', $filename);

            $student->profile_pic = $filename;   
        }

        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();

        return redirect('admin/student/list')->with('success', "Student successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) 
        {
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = "Edit Student";
            return view('admin.student.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        // Data Validation
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number' => 'max:15|min:6'
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) 
        {            
            $student->date_of_birth = trim($request->date_of_birth);
        }
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        if (!empty($request->admission_date)) 
        {
            $student->admission_date = trim($request->admission_date);            
        }

        if (!empty($request->file('profile_pic'))) 
        {
            if (!empty($student->getProfile())) 
            {
                unlink('public/dist/img/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/profile/', $filename);

            $student->profile_pic = $filename;   
        }

        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if (!empty($request->password)) 
        {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return redirect('admin/student/list')->with('success', "Student successfully updated");
    }

    public function delete($id)
    {
        $student = User::getSingle($id);
        $student->is_delete = 1;
        $student->save();

        return redirect()->back()->with('danger', "Student successfully deleted");
    }

    // Student side - My student
    public function MyStudent()
    {
        $data['getRecord'] = User::getTeacherStudent(Auth::user()->id);
        $data['header_title'] = "My Student List";
        return view('teacher.my_student', $data);
    }
}
