<?php

namespace App\Http\Controllers;
use App\Models\AcademicPeriod;
use App\Models\Form;
use Illuminate\Http\Request;

class AcademicSeasonController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'academic_year' => 'required',
            'term' => 'required'
        ]);

        $query = AcademicPeriod::where(['academic_year' => $request->academic_year, 'term' => $request->term])->first();

        if($query === null){
            AcademicPeriod::create([
                'academic_year' => $request->academic_year,
                'term' => $request->term,
            ]);

            $status = Form::find(1);

            $status->active = 0;

            $status->save();

            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error', 'Academic Session already exists');
        }

    }
}
