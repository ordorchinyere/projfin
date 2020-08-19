<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\College;

class CollegeController extends Controller
{
    public function index($id)
    {
        $college = College::find($id);

        if(!$college) {
            abort(404); 
        }

        $departments = $college->departments;
        $projects = [];

        foreach($departments as $department){
            $projects[] = $department->projects()->where('status', 'approved')->orderBy('created_at', 'DESC')->limit(5)->get();
        }

        $data['college'] = $college;
        $data['projects'] = collect($projects)->flatten();

        return view('colleges.college', $data);
    }
}
