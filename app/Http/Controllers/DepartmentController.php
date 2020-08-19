<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    public function index($id)
    {
        $department = Department::find($id);
        
        if(!$department){
            abort(404);
        }
        
        $projects = $department->projects->where('status', 'approved');
        $data['department'] = $department;
        $data['projects'] = $projects;

        return view('departments.department', $data);
    }
}
