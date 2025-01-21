<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class SubjectModel extends Model
{
    use HasFactory;

    protected $table = 'subject';

    static public function getRecord()
    {
        $return = self::select('subject.*', 'users.name as created_by_name')
            ->join('users', 'users.id', 'subject.created_by');

            // Searching
            if (!empty(Request::get('name'))) {
                $return = $return->where('subject.name', 'like', '%'.Request::get('name').'%');
            }
            if (!empty(Request::get('type'))) {
                $return = $return->where('subject.type', 'like', '%'.Request::get('type').'%');
            }
            if (!empty(Request::get('date'))) {
            $return = $return->whereDate('subject.created_at', '=', Request::get('date'));
            }

        $return = $return->where('subject.is_delete', '=', 0)
            ->orderBy('subject.id', 'DESC')

            //Pagination
            ->paginate(10);

        return $return;
    }

    // Assign Subject
    static public function getSubject()
    {
        $return = self::select('subject.*')
            ->join('users', 'users.id', 'subject.created_by')
            ->where('subject.is_delete', '=', 0)
            ->where('subject.status', '=', 0)
            ->orderBy('subject.name', 'ASC')
            ->get();

        return $return;
    }

    // For edit, update & delete
    static public function getSingle($id)
    {
        return self::find($id);
    }

    // Total Subject
    static public function getTotalSubject()
    {
        $return = self::select('subject.id')
            ->join('users', 'users.id', 'subject.created_by')
            ->where('subject.is_delete', '=', 0)
            ->where('subject.status', '=', 0)
            ->count();

        return $return;
    }
}
