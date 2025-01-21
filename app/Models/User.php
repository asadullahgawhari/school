<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;
use Cache;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function OnlineUser()
    {
        return Cache::has('OnlineUser'.$this->id);
    }

    // Send Email
    static public function SearchUser($search)
    {
        $return = self::select('users.*')
            ->where(function($query) use ($search){
            $query->where('users.name', 'like', '%'.$search.'%')
            ->orWhere('users.last_name', 'like', '%'.$search.'%');
            })
        ->limit(10)
        ->get();

        return $return;
    }

    static public function getUser($user_type)
    {
        return self::select('users.*')
            ->where('user_type', '=', $user_type)
            ->where('is_delete', '=', 0)
            ->get();
    }

    // total Student
    static public function getTotalUser($user_type)
    {
        return self::select('users.id')
            ->where('user_type', '=', $user_type)
            ->where('is_delete', '=', 0)
            ->count();
    }

    // Admin
    static public function getAdmin()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 1)
            ->where('is_delete', '=', 0);

            // Searching
            if (!empty(Request::get('name'))) {
                $return = $return->where('name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('last_name', 'like', '%'.Request::get('last_name').'%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return->where('email', 'like', '%'.Request::get('email').'%');
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('created_at', '=', Request::get('date'));
            }

        $return = $return->orderBy('id', 'DESC')

            //Pagination
            ->paginate(10);

            return $return;
    }

    // Teacher
    static public function getTeacher($remove_pagination = 0)
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);

            // Searching
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
            }
            if (!empty(Request::get('gender'))) {
                $return = $return->where('users.gender', 'like', '%'.Request::get('gender').'%');
            }
            if (!empty(Request::get('mobile_number'))) {
                $return = $return->where('users.mobile_number', 'like', '%'.Request::get('mobile_number').'%');
            }
            if (!empty(Request::get('status'))) {
                $return = $return->where('users.status', 'like', '%'.Request::get('status').'%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
            }
            if (!empty(Request::get('date_of_birth'))) {
                $return = $return->whereDate('users.date_of_birth', '=', Request::get('date_of_birth'));
            }
            if (!empty(Request::get('admission_date'))) {
                $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }

        $return = $return->orderBy('users.id', 'DESC');
            if (!empty($remove_pagination)) 
            {
                $return = $return->get();
            }
            else
            {
                $return = $return->paginate(10);
            }
            

            return $return;
    }

    // Assign Class Teacher
    static public function getTeacherClass()
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);
        $return = $return->orderBy('users.id', 'DESC')
            ->get();

            return $return;
    }

    // Student
    static public function getStudent($remove_pagination = 0)
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);

            // Searching
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
            }
            if (!empty(Request::get('admission_number'))) {
                $return = $return->where('users.admission_number', 'like', '%'.Request::get('admission_number').'%');
            }
            if (!empty(Request::get('roll_number'))) {
                $return = $return->where('users.roll_number', 'like', '%'.Request::get('roll_number').'%');
            }
            if (!empty(Request::get('class'))) {
                $return = $return->where('class.name', 'like', '%'.Request::get('class').'%');
            }
            if (!empty(Request::get('gender'))) {
                $return = $return->where('users.gender', 'like', '%'.Request::get('gender').'%');
            }
            if (!empty(Request::get('caste'))) {
                $return = $return->where('users.caste', 'like', '%'.Request::get('caste').'%');
            }
            if (!empty(Request::get('religion'))) {
                $return = $return->where('users.religion', 'like', '%'.Request::get('religion').'%');
            }
            if (!empty(Request::get('mobile_number'))) {
                $return = $return->where('users.mobile_number', 'like', '%'.Request::get('mobile_number').'%');
            }
            if (!empty(Request::get('blood_group'))) {
                $return = $return->where('users.blood_group', 'like', '%'.Request::get('blood_group').'%');
            }
            if (!empty(Request::get('height'))) {
                $return = $return->where('users.height', 'like', '%'.Request::get('height').'%');
            }
            if (!empty(Request::get('weight'))) {
                $return = $return->where('users.weight', 'like', '%'.Request::get('weight').'%');
            }
            if (!empty(Request::get('status'))) {
                $return = $return->where('users.status', 'like', '%'.Request::get('status').'%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
            }
            if (!empty(Request::get('date_of_birth'))) {
                $return = $return->whereDate('users.date_of_birth', '=', Request::get('date_of_birth'));
            }
            if (!empty(Request::get('admission_date'))) {
                $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }

        $return = $return->orderBy('users.id', 'DESC');
        if (!empty($remove_pagination)) 
        {
            $return = $return->get();
        }
        else
        {
            $return = $return->paginate(10);
        }
            return $return;
    }

    // Student Fees
    static public function getCollectFeesStudent()
    {

        $return = self::select('users.*', 'class.name as class_name', 'class.amount')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);

            if (!empty(Request::get('student_id'))) 
            {
                $return = $return->where('users.id', 'like', '%'.Request::get('student_id').'%');
            }
            if (!empty(Request::get('first_name'))) {
                $return = $return->where('users.name', 'like', '%'.Request::get('first_name').'%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
            }
            if (!empty(Request::get('class_id'))) 
            {
                $return = $return->where('users.class_id', 'like', '%'.Request::get('class_id').'%');
            }
            
        $return = $return->orderBy('users.name', 'DESC')

            //Pagination
            ->paginate(10);

            return $return;
    }

    // Parent
    static public function getParent($remove_pagination = 0)
    {
        $return = self::select('users.*', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 4)
            ->where('users.is_delete', '=', 0);

            // Searching
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
            }
            if (!empty(Request::get('gender'))) {
                $return = $return->where('users.gender', 'like', '%'.Request::get('gender').'%');
            }
            if (!empty(Request::get('mobile_number'))) {
                $return = $return->where('users.mobile_number', 'like', '%'.Request::get('mobile_number').'%');
            }
            if (!empty(Request::get('occupation'))) {
                $return = $return->where('users.occupation', 'like', '%'.Request::get('occupation').'%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }

        $return = $return->orderBy('users.id', 'DESC');

            if (!empty($remove_pagination)) 
            {
                $return = $return->get();                
            }
            else
            {
                $return = $return->paginate(10);
            }

            return $return;
    }

    // Parent assign to student
    static public function getSearchStudent()
    {
        if (!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('last_name')) || !empty(Request::get('email'))) 
        {
            $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);

            // Searching
            if (!empty(Request::get('id'))) {
                $return = $return->where('users.id', '=', Request::get('id'));
            }
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }

        $return = $return->orderBy('users.id', 'DESC')

            ->limit(50)
            ->get();

            return $return;
        }    
    }

    // Parent assign to student
    static public function getMyStudent($parent_id)
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $parent_id)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'DESC')
            ->get();

            return $return;
    }

    // Count Student for Parent
    static public function getMyStudentCount($parent_id)
    {
        return self::select('users.id')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $parent_id)
            ->where('users.is_delete', '=', 0)
            ->count();
    }

    // Count Fees for Parent
    static public function getMyStudentIds($parent_id)
    {
        $return = self::select('users.id')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $parent_id)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'DESC')
            ->get();
        $student_ids = array();
        foreach ($return as $value) 
        {
            $student_ids[] = $value->id; 
        }
        return $student_ids;
    }

    // For edit, update & delete
    static public function getSingle($id)
    {
        return self::find($id);
    }

    // Collection Fees for Student
    static public function getSingleClass($id)
    {
        return self::select('users.*', 'class.amount', 'class.name as class_name')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->where('users.id', '=', $id)
            ->first();
    }

    static public function getPaidAmount($student_id, $class_id)
    {
        return StudentAddFeesModel::getPaidAmount($student_id, $class_id);
    }

    // Email
    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }

    // Token
    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }

    // Profile Picture
    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('public/dist/img/profile/'.$this->profile_pic)) 
        {
            return url('public/dist/img/profile/'.$this->profile_pic);
        }
        else
        {
            return '';
        }    
    }

    // Profile Direct Picture - for empty image 
    public function getProfileDirect()
    {
        if (!empty($this->profile_pic) && file_exists('public/dist/img/profile/'.$this->profile_pic)) 
        {
            return url('public/dist/img/profile/'.$this->profile_pic);
        }
        else
        {
            return url('public/dist/img/user2-160x160.jpg');
        }    
    }

    // Marks Register
    static public function getStudentClass($class_id)
    {
        return  self::select('users.id', 'users.name', 'users.last_name')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->where('users.class_id', '=', $class_id)
            ->orderBy('users.id', 'DESC')
            ->get();
    }

    // Teacher side - My Student
    static public function getTeacherStudent($teacher_id)
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
            ->where('assign_class_teacher.status', '=', 0)
            ->where('assign_class_teacher.is_delete', '=', 0)
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);

            // Searching
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
            }
            if (!empty(Request::get('admission_number'))) {
                $return = $return->where('users.admission_number', 'like', '%'.Request::get('admission_number').'%');
            }
            if (!empty(Request::get('roll_number'))) {
                $return = $return->where('users.roll_number', 'like', '%'.Request::get('roll_number').'%');
            }
            if (!empty(Request::get('class'))) {
                $return = $return->where('class.name', 'like', '%'.Request::get('class').'%');
            }
            if (!empty(Request::get('gender'))) {
                $return = $return->where('users.gender', 'like', '%'.Request::get('gender').'%');
            }
            if (!empty(Request::get('caste'))) {
                $return = $return->where('users.caste', 'like', '%'.Request::get('caste').'%');
            }
            if (!empty(Request::get('religion'))) {
                $return = $return->where('users.religion', 'like', '%'.Request::get('religion').'%');
            }
            if (!empty(Request::get('mobile_number'))) {
                $return = $return->where('users.mobile_number', 'like', '%'.Request::get('mobile_number').'%');
            }
            if (!empty(Request::get('blood_group'))) {
                $return = $return->where('users.blood_group', 'like', '%'.Request::get('blood_group').'%');
            }
            if (!empty(Request::get('height'))) {
                $return = $return->where('users.height', 'like', '%'.Request::get('height').'%');
            }
            if (!empty(Request::get('weight'))) {
                $return = $return->where('users.weight', 'like', '%'.Request::get('weight').'%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
            }
            if (!empty(Request::get('date_of_birth'))) {
                $return = $return->whereDate('users.date_of_birth', '=', Request::get('date_of_birth'));
            }
            if (!empty(Request::get('admission_date'))) {
                $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
            }
            if (!empty(Request::get('date'))) {
                $return = $return->whereDate('users.created_at', '=', Request::get('date'));
            }

        $return = $return->orderBy('users.id', 'DESC')
            ->groupBy('users.id')
            //Pagination
            ->paginate(10);

            return $return;
    }

    // Student Count for Teacher
    static public function getTeacherStudentCount($teacher_id)
    {
        return self::select('users.id')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
            ->where('assign_class_teacher.status', '=', 0)
            ->where('assign_class_teacher.is_delete', '=', 0)
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'DESC')
            // ->groupBy('users.id')
            ->count();
    }

    static public function getAttendance($student_id, $class_id, $attendance_date)
    {
        return StudentAttendanceModel::checkAllreadyAttendance($student_id, $class_id, $attendance_date);
    }

}
