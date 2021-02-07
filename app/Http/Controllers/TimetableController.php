<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
use Illuminate\Support\Facades\DB;

class TimetableController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function show($id){
        $timetable = Timetable::all();

        $users = DB::table('users')
                ->where('role', '=', 'teacher')
                ->get();

        $session_id = $id;

        $subjects = array('Agriculture', 'Additional Mathematics', 'Building Technology and Design Forms', 'Design and Technology', 'Food Technology', 'Home Management and Design','Technical Graphics and Design', 'Textile Technology and Design', 'Dance', 'Music and Theatre', 'Pure Mathematics', 'Statistics', 'Sociology', 'Family and Religious Studies', 'Business and Enterprise Skills', 'Commerce', 'Commercial Studies','Economic History','Mathematics', 'Ndebele', 'Biology', 'Chemistry', 'Physics', 'Geography', 'English', 'Combined Science', 'Art', 'English Literature', 'History', 'Economics', 'Computer Science', 'Principles of Accounts', 'Managemement of Business', 'Divinity', 'Fashion and Fabrics', 'Food and Nutrition');
        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
        $duration = array('30', '60', '90', '120');
        $classroom = array('Room 1', 'Room 2', 'Room 3', 'Room 4', 'Room 5', 'Room 6', 'Room 7', 'Room 8', 'Room 9', 'Room 10', 'Room 11', 'Room 12', 'Room 13', 'Room 14', 'Room 15', 'Computer Lab 1', 'Computer Lab 2', 'Computer Lab 3', 'Computer Lab 4', 'Science Lab 1', 'Science Lab 2', 'Science Lab 3', 'Music Room 1', 'Music Room 2', 'Music Room 3', 'Cooking Classroom 1', 'Cooking Classroom 2', 'Cooking Classroom 3', 'Art Room 1', 'Art Room 2');
        $class = array('Form 1A', 'Form 1B', 'Form 1C', 'Form 1D', 'Form 2A', 'Form 2B', 'Form 2C', 'Form 2D', 'Form 3A', 'Form 3B', 'Form 3C', 'Form 3D', 'Form 4A', 'Form 4B', 'Form 4C', 'Form 4D', 'Lower 6 Commercials', 'Lower 6 Sciences', 'Lower 6 Arts', 'Upper 6 Commercials', 'Upper 6 Arts', 'Upper 6 Sciences');
        return view("timetable", ['days' => $days, 'session_id' => $session_id,'duration' => $duration, 'class' => $class, 'users' => $users, 'subjects' => $subjects, 'classroom' => $classroom, 'timetable' => $timetable]);
    }

    public function store(Request $request) {
        $timetable = DB::table('timetables')
                ->where('academic_periods_id', '=', $request->academic_periods_id)
                ->where('week', '=', $request->week)
                ->where('day', '=', $request->day)
                ->where('period', '=', $request->period)
                ->where('duration', '=', $request->duration)
                ->where('class', '=', $request->class)
                ->where('teacher', '=', $request->teacher)
                ->where('subject', '=', $request->subject)
                ->where('classroom', '=', $request->classroom)
                ->get();

        if ($timetable->count()) {
            return redirect()->back()->with('error', 'This record is clashing with the current timetable');
        }else {
            Timetable::create([
                'academic_periods_id' => $request->academic_periods_id,
                'week' => $request->week,
                'day' => $request->day,
                'period' => $request->period,
                'duration' => $request->duration,
                'class' => $request->class,
                'teacher' => $request->teacher,
                'subject' => $request->subject,
                'classroom' => $request->classroom,
            ]);

            return redirect()->back();
        }
    }
}
