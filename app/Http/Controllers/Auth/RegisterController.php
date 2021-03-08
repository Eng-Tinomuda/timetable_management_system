<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index () {
        $users =  User::where('users.role', '!=', 'student')->orderByDesc('id')->paginate(4);

        $students = DB::table('users')
                    ->join('students', 'users.id', '=', 'students.student_id')
                    ->where('students.teacher_id', '=', Auth::user()->id)
                    ->orderByDesc('students.id')
                    ->paginate(10);

        $class = array('Form 1A', 'Form 1B', 'Form 1C', 'Form 1D', 'Form 2A', 'Form 2B', 'Form 2C', 'Form 2D', 'Form 3A', 'Form 3B', 'Form 3C', 'Form 3D', 'Form 4A', 'Form 4B', 'Form 4C', 'Form 4D', 'Lower 6 Commercials', 'Lower 6 Sciences', 'Lower 6 Arts', 'Upper 6 Commercials', 'Upper 6 Arts', 'Upper 6 Sciences');

        return view('auth.register', ['users' => $users, 'students' => $students, 'class' => $class]);
    }

    public function store (Request $request) {
        if($request['class']){
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'role' => 'required',
                'class' => 'required',
                'password' => 'required|confirmed'
            ]);
        }else{
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'role' => 'required',
                'password' => 'required|confirmed'
            ]);
        }


        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if($request['class']){
            if(Auth::user()->role === 'teacher'){
                Student::create([
                    'teacher_id' => Auth::user()->id,
                    'student_id' => $data['id'],
                    'class' => $request->class,
                ]);
            }
        }

        return back()->with('status', 'User created successfully');
    }

    public function destroy(User $user){

        $user->delete();

        return back();
    }

}
