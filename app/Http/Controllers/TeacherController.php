<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AcademicPeriod;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $academic = AcademicPeriod::latest()->get();
        return view('portal', ['academic' => $academic]);
    }

    public function show($id){
        $timetable = DB::table('timetables')
                    ->join('users', 'users.id', '=', 'timetables.teacher')
                    ->where('timetables.teacher', '=', Auth::user()->id)
                    ->where('timetables.academic_periods_id', '=', $id)
                    ->paginate(1);

        return view('teacher', ['timetable' => $timetable]);
    }
}
