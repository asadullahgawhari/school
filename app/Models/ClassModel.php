<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    static public function getRecord()
    {
        $return = self::select('class.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'class.created_by');

            // Searching
            if (!empty(Request::get('name'))) {
                $return = $return->where('class.name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('status'))) {
                $return = $return->where('class.status', 'like', '%'.Request::get('status').'%');
            }
            if (!empty(Request::get('date'))) {
            $return = $return->whereDate('class.created_at', '=', Request::get('date'));
            }

        $return = $return->where('class.is_delete', '=', 0)
            ->orderBy('class.id', 'DESC')

            //Pagination
            ->paginate(10);

        return $return;
    }

    // Assign Subject
    static public function getClass()
    {
        $return = self::select('class.*')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'ASC')
            ->get();

        return $return;
    }

    // For edit, update & delete
    static public function getSingle($id)
    {
        return self::find($id);
    }

    // Total Class
    static public function getTotalClass()
    {
        $return = self::select('class.id')
            ->join('users', 'users.id', 'class.created_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->count();

        return $return;
    }
}
