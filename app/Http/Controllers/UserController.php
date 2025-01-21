<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SettingModel;
use Auth;
use Hash;
use Str;

class UserController extends Controller
{
    // Setting
    public function Setting()
    {
        $data['getRecord'] = SettingModel::getSingle(); 
        $data['header_title'] = "Setting";
        return view('admin.setting', $data);
    }

    public function UpdateSetting(Request $request)
    {
        $setting = SettingModel::getSingle(); 
        $setting->paypal_email = trim($request->paypal_email);
        $setting->stripe_key = trim($request->stripe_key);
        $setting->stripe_secret = trim($request->stripe_secret);
        $setting->school_name = trim($request->school_name);
        $setting->exam_description = trim($request->exam_description);

        if (!empty($request->file('logo'))) 
        {
            $ext = $request->file('logo')->getClientOriginalExtension();
            $file = $request->file('logo');
            $randomStr =date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/setting/', $filename);

            $setting->logo = $filename;   
        }

        if (!empty($request->file('fevicon'))) 
        {
            $ext = $request->file('fevicon')->getClientOriginalExtension();
            $file = $request->file('fevicon');
            $randomStr =date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/setting/', $filename);

            $setting->fevicon = $filename;   
        }

        $setting->save();

        return redirect()->back()->with('success', "Setting successfully updated");
    }

    // Edit My Account
    public function MyAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";
        if (Auth::user()->user_type == 1) 
        {
            return view('admin.my_account', $data);
        }
        elseif (Auth::user()->user_type == 2) 
        {
            return view('teacher.my_account', $data);
        }
        elseif (Auth::user()->user_type == 3) 
        {
            return view('student.my_account', $data);
        }
        elseif (Auth::user()->user_type == 4) 
        {
            return view('parent.my_account', $data);
        }
    }

    // Edit Account Admin
    public function UpdateMyAccountAdmin(Request $request)
    {
        $id = Auth::user()->id;
        // Data Validation
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->last_name = trim($request->last_name);

        if (!empty($request->file('profile_pic'))) 
        {
            if (!empty($admin->getProfile())) 
            {
                unlink('public/dist/img/profile/'.$admin->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/profile/', $filename);

            $admin->profile_pic = $filename;   
        }

        $admin->email = trim($request->email);
        $admin->save();

        return redirect()->back()->with('success', "Account successfully updated");
    }

    // Edit Account Teacher
    public function UpdateMyAccount(Request $request)
    {
        $id = Auth::user()->id;
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

        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->email = trim($request->email);
        $teacher->save();

        return redirect()->back()->with('success', "Account successfully updated");
    }

    // Edit Account Student
    public function UpdateMyAccountStudent(Request $request)
    {
        $id = Auth::user()->id;
        // Data Validation
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number' => 'max:15|min:6'
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->gender = trim($request->gender);
        $student->caste = trim($request->caste);
        if (!empty($request->date_of_birth)) 
        {            
            $student->date_of_birth = trim($request->date_of_birth);
        }
        $student->mobile_number = trim($request->mobile_number);

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
        $student->religion = trim($request->religion);
        $student->email = trim($request->email);
        $student->save();

        return redirect()->back()->with('success', "Account successfully updated");
    }

    // Edit Account Parent
    public function UpdateMyAccountParent(Request $request)
    {
        $id = Auth::user()->id;
        // Data Validation
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number' => 'max:15|min:6'
        ]);

        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->mobile_number = trim($request->mobile_number);

        if (!empty($request->file('profile_pic'))) 
        {
            if (!empty($parent->getProfile())) 
            {
                unlink('public/dist/img/profile/'.$parent->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr =date('Ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('public/dist/img/profile/', $filename);

            $parent->profile_pic = $filename;   
        }

        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);
        $parent->email = trim($request->email);
        $parent->save();

        return redirect()->back()->with('success', "Account successfully updated");
    }

    // Change Password
    public function change_password()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }

    // Change Password
    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) 
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            
            return redirect()->back()->with('success', "Password successfully updated");
        }
        else
        {
            return redirect()->back()->with('error', "Old password is not currect");
        }
    }
}
