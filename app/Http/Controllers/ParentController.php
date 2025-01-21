<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\ExportParent;
use Hash;
use Auth;
use Str;
use Excel;

class ParentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getParent();
        $data['header_title'] = "Parent List";
        return view('admin.parent.list', $data);
    }

    // Export Excel
    public function export_parent_excel(Request $request)
    {
        return Excel::download(new ExportParent, 'export_parent_'.date('Y-m-d').'.xlsx');
    }

    public function add()
    {
        $data['header_title'] = "Add New Parent";
        return view('admin.parent.add', $data);
    }

    public function insert(Request $request)
    {

        // Data Validation
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:6'
        ]);

        $parent = new User;
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->occupation = trim($request->occupation);
        if (!empty($request->file('profile_pic'))) 
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/profile/', $filename);

            $parent->profile_pic = $filename;   
        }
        $parent->status = trim($request->status);
        $parent->address = trim($request->address);
        $parent->email = trim($request->email);
        $parent->password = Hash::make($request->password);
        $parent->user_type = 4;
        $parent->save();

        return redirect('admin/parent/list')->with('success', "Parent successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) 
        {
            $data['header_title'] = "Edit Parent";
            return view('admin.parent.edit', $data);
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
        $student->gender = trim($request->gender);
        $student->mobile_number = trim($request->mobile_number);
        $student->occupation = trim($request->occupation);

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

        $student->status = trim($request->status);
        $student->address = trim($request->address);
        $student->email = trim($request->email);
        if (!empty($request->password)) 
        {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return redirect('admin/parent/list')->with('success', "Parent successfully updated");
    }

    public function delete($id)
    {
        $student = User::getSingle($id);
        $student->is_delete = 1;
        $student->save();

        return redirect()->back()->with('danger', "Parent successfully deleted");
    }

    // Parent assign to student
    public function myStudent($id)
    {
        $data['getParent'] = User::getSingle($id);
        $data['parent_id'] = $id;
        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = User::getMyStudent($id);
        $data['header_title'] = "Parent Student List";
        return view('admin.parent.my_student', $data);
    }

    // Parent assign to student
    public function AssignStudentParent($student_id, $parent_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = $parent_id;
        $student->save();

        return redirect()->back()->with('success', "Parent assign to student successfully updated");
    }

    // Parent assign to student Delete
    public function AssignStudentParentDelete($student_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id = null;
        $student->save();

        return redirect()->back()->with('success', "Parent assign to student successfully deleted");
    }

    // Parent Side
    // Parent Student

    public function MyStudentParent()
    {
        $id = Auth::user()->id;
        $data['getRecord'] = User::getMyStudent($id);
        
        $data['header_title'] = "My Student";
        return view('parent.my_student', $data);
    }
}
