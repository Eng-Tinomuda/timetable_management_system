<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index () {
        $users =  User::orderByDesc('id')->paginate(4);
        return view('auth.register', ['users' => $users]);
    }

    public function store (Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'User created successfully');
    }

    public function destroy(User $user){

        $user->delete();

        return back();
    }
}
