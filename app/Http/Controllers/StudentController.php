<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AcademicPeriod;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(){
        $academic = AcademicPeriod::latest()->get();
        return view('academic', ['academic' => $academic]);
    }

    public function show($id){
        $timetable = DB::table('timetables')
                    ->join('users', 'users.id', '=', 'timetables.teacher')
                    ->where('timetables.teacher', '=', Auth::user()->id)
                    ->where('timetables.academic_periods_id', '=', $id)
                    ->paginate(10);

        return $timetable;

        return view('student', ['timetable' => $timetable]);

    }


}
