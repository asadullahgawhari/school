<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use App\Exports\ExportTeacher;
use Hash;
use Auth;
use Str;
use Excel;

class TeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Teacher List";
        return view('admin.teacher.list', $data);
    }

    // Export Excel
    public function export_teacher_excel(Request $request)
    {
        return Excel::download(new ExportTeacher, 'export_teacher_'.date('Y-m-d').'.xlsx');
    }

    public function add()
    {
        $data['header_title'] = "Add New Teacher";
        return view('admin.teacher.add', $data);
    }

    public function insert(Request $request)
    {

        // Data Validation
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:6'
        ]);

        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) 
        {            
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        $teacher->mobile_number = trim($request->mobile_number);
        if (!empty($request->admission_date)) 
        {
            $teacher->admission_date = trim($request->admission_date);            
        }

        if (!empty($request->file('profile_pic'))) 
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/profile/', $filename);

            $teacher->profile_pic = $filename;   
        }

        $teacher->status = trim($request->status);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->note = trim($request->note);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) 
        {
            $data['header_title'] = "Edit Teacher";
            return view('admin.teacher.edit', $data);
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

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) 
        {            
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        $teacher->mobile_number = trim($request->mobile_number);
        if (!empty($request->admission_date)) 
        {
            $teacher->admission_date = trim($request->admission_date);            
        }

        if (!empty($request->file('profile_pic'))) 
        {
            if (!empty($teacher->getProfile())) 
            {
                unlink('public/dist/img/profile/'.$teacher->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/profile/', $filename);

            $teacher->profile_pic = $filename;   
        }

        $teacher->status = trim($request->status);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->note = trim($request->note);
        $teacher->email = trim($request->email);
        if (!empty($request->password)) 
        {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher successfully updated");
    }

    public function delete($id)
    {
        $teacher = User::getSingle($id);
        $teacher->is_delete = 1;
        $teacher->save();

        return redirect()->back()->with('danger', "Teacher successfully deleted");
    }
}
