<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\College;
use App\Course;
use App\Department;
use App\Guideline;

class GuidelinesController extends Controller
{
    public function index()
    {   
        $colleges = College::get();
        $data['colleges'] = $colleges;
        
        return view('guidelines.guidelines', $data);
    }

    public function viewGuidelinesList()
    {
        $departments = Department::get();

        $data['departments'] = $departments;
        return view('guidelines.guidelines-list', $data);
    }

    public function viewAddGuidelines(Request $request)
    {
        $department = Department::find($request->department_id);

        if(!$department){
            abort(404);
        }

        $data['department'] = $department;

        return view('guidelines.add-guidelines', $data);
    }

    public function addGuideline(Request $request)
    {
        $guideline = new Guideline;
        $guideline->department_id = $request->input('department_id');
        $guideline->name = $request->input('name');
        $guideline->link = $request->input('link');
        $guideline->save();

        return redirect()->route('view-guidelines-list')->with(['flash_message' => 'Successfully added guideline', 'type' => 'success']);
    }

    public function viewEditGuideline(Request $request)
    {
        $department = Department::find($request->department_id);

        if(!$department){
            abort(404);
        }

        $data['department'] = $department;

        return view('guidelines.edit-guidelines', $data);
    }

    public function editGuideline(Request $request)
    {
        $guideline = Guideline::find($request->input('department_id'));

        if($request->has('name')){
            $guideline->name = $request->input('name');
        }

        if($request->has('link')){
            $guideline->link = $request->input('link');
        }

        $guideline->save();

        return redirect()->route('view-guidelines-list')->with(['flash_message' => 'Successfully edited guideline', 'type' => 'success']);
    }
}
