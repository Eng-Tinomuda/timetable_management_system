<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\AcademicPeriod;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $status = Form::all();
        $academic = AcademicPeriod::latest()->get();
        return view('dashboard', ['status' => $status, 'academic' => $academic]);
    }

    public function update(){
        $status = Form::find(1);

        if($status->active === 1){
            $status->active = 0;
        }else if($status->active === 0){
            $status->active = 1;
        }

        $status->save();

        return back();
    }
}
