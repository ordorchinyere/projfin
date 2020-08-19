<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Department;
use App\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ApprovalMail;

class ProjectController extends Controller
{
    public $sdgs = [
        'GOAL 1: No Poverty',
        'GOAL 2: Zero Hunger',
        'GOAL 3: Good Health and Well-being',
        'GOAL 4: Quality Education',
        'GOAL 5: Gender Equality',
        'GOAL 6: Clean Water and Sanitation',
        'GOAL 7: Affordable and Clean Energy',
        'GOAL 8: Decent Work and Economic Growth',
        'GOAL 9: Industry, Innovation and Infrastructure',
        'GOAL 10: Reduced Inequality',
        'GOAL 11: Sustainable Cities and Communities',
        'GOAL 12: Responsible Consumption and Production',
        'GOAL 13: Climate Action',
        'GOAL 14: Life Below Water',
        'GOAL 15: Life on Land',
        'GOAL 16: Peace and Justice Strong Institutions',
        'GOAL 17: Partnerships to achieve the Goal',
    ];

    public function index(Request $request)
    {
        $project = Project::find($request->project_id);

        if(!$project){
            abort(404);
        }

        $data['project'] = $project;

        return view('projects.project', $data);
    }

    public function viewProjectSubmission()
    {
        $projects = Project::all();
        $user = Auth::user();
        $data['projects'] = $projects;
        $data['user'] = $user;

        return view('projects.submission', $data);
    }

    public function changeProjectStatus(Request $request)
    {
        $project = Project::find($request->project_id);

        if(!$project){
            return redirect()->route('project-submission')->with(['flash_message' =>  'Project not found', 'type' => 'danger']);
        }

        $project->status = $request->new_status;
        if($request->new_status === 'rejected'){
            $project->feedback = $request->feedback;
        }

        if($request->new_status === 'approved'){
            $fullName = "{$project->user->first_name} {$project->user->last_name}";
            Mail::to($project->user->email)->send(new ApprovalMail($fullName)); 
        }

        $project->save();
        return redirect()->back()->with(['flash_message' => 'Project updated successfully', 'type' => 'success']);
    }

    public function addProjectView()
    {
        $supervisors = User::whereNotNull('staff_id')->get();
        

        $user = Auth::user();
        $data['supervisors'] = $supervisors;
        $data['sdgs'] = $this->sdgs;
        $data['user'] = $user;

        if($user->user_type === 'super_admin'){
            $data['departments'] = Department::get();
            $data['courses'] = Course::get();
        }

        return view('projects.add-project', $data);
    }

    public function addProject(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image_1' => 'required|file|max:3072',
            'image_2' => 'sometimes|required|file|max:3072',
            'image_3' => 'sometimes|required|file|max:3072',
            'image_4' => 'sometimes|required|file|max:3072',
            'video' => 'required|file|max:20480',
            'document' => 'required|file|max:10240',
            'plagiarism_document' => 'required|file|max:10240',
        ]);

        $user = Auth::user();
        $project = new Project;

        $project->title = $request->input('title');
        $project->abstract = $request->input('abstract');
        $project->keywords = $request->input('keywords');
        $project->sdg = $request->input('sdg');
        $project->project_link = $request->input('project_link');

        $images = [];
        if($request->hasFile('image_1')) {
            $images['image_1'] = $request->image_1->store('images', 's3');
            Storage::disk('s3')->setVisibility($images['image_1'], 'public');
        }
        if($request->hasFile('image_2')) {
            $images['image_2'] = $request->image_2->store('images', 's3');
            Storage::disk('s3')->setVisibility($images['image_2'], 'public');
        }
        if($request->hasFile('image_3')) {
            $images['image_3'] = $request->image_3->store('images', 's3');
            Storage::disk('s3')->setVisibility($images['image_3'], 'public');
        }
        if($request->hasFile('image_4')) {
            $images['image_4'] = $request->image_4->store('images', 's3');
            Storage::disk('s3')->setVisibility($images['image_4'], 'public');
        }

        $project->images = json_encode($images);

        $project->video = $request->video->store('videos', 's3');
        Storage::disk('s3')->setVisibility($project->video, 'public');

        $project->document = $request->document->store('documents', 's3');
        Storage::disk('s3')->setVisibility($project->document, 'public');

        $project->plagiarism_document = $request->plagiarism_document->store('plagiarism_document', 's3');
        Storage::disk('s3')->setVisibility($project->plagiarism_document, 'public');
        
        $project->status = 'pending';
        $project->issue_date = now()->toDateTimeString();
        $project->user_id = $user->id;
        $project->supervisor_id = $request->input('supervisor_id');

        if($user->user_type === 'student') {
            $departmentId = $user->userDepartment->id;
            $courseId = $user->userCourse->id;

            $project->department_id = $departmentId;
            $project->course_id = $courseId;
        }

        if($user->user_type === 'super_admin' && $request->has('department_id')){
            $project->department_id = $request->input('department_id');
        }
        if($user->user_type === 'super_admin' && $request->has('course_id')){
            $project->course_id = $request->input('course_id');
        }

        $project->save();
        return redirect()->route('user-profile');
    }

    public function editProjectView()
    {
        $user = Auth::user();

        if(!$user->project) {
            abort(404);
        }

        $project = $user->project;
        $supervisors = User::whereNotNull('staff_id')->get();

        $data['project'] = $project;
        $data['supervisors'] = $supervisors;
        $data['sdgs'] = $this->sdgs;
        $data['user'] = $user;

        if($user->user_type === 'super_admin'){
            $data['departments'] = Department::get();
            $data['courses'] = Course::get();
        }

        return view('projects.edit-project', $data);
    }

    public function editProject(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image_1' => 'required|file|max:3072',
            'image_2' => 'sometimes|required|file|max:3072',
            'image_3' => 'sometimes|required|file|max:3072',
            'image_4' => 'sometimes|required|file|max:3072',
            'video' => 'required|file|max:20480',
            'document' => 'required|file|max:10240',
            'plagiarism_document' => 'required|file|max:10240',
        ]);
        
        $user = Auth::user();
        $project = $user->project;
        
        $project->title = $request->input('title');
        $project->abstract = $request->input('abstract');
        $project->keywords = $request->input('keywords');
        $project->sdg = $request->input('sdg');
        $project->project_link = $request->input('project_link');

        $images = [];
        if($request->hasFile('image_1')) {
            $images['image_1'] = $request->image_1->store('images' , 's3');
            Storage::disk('s3')->setVisibility($images['image_1'], 'public');
        }
        if($request->hasFile('image_2')) {
            $images['image_2'] = $request->image_2->store('images', 's3');
            Storage::disk('s3')->setVisibility($images['image_2'], 'public');
        }
        if($request->hasFile('image_3')) {
            $images['image_3'] = $request->image_3->store('images', 's3');
            Storage::disk('s3')->setVisibility($images['image_3'], 'public');
        }
        if($request->hasFile('image_4')) {
            $images['image_4'] = $request->image_4->store('images', 's3');
            Storage::disk('s3')->setVisibility($images['image_4'], 'public');
        }

        $project->images = json_encode($images);

        $project->video = $request->video->store('videos', 's3');
        Storage::disk('s3')->setVisibility($project->video, 'public');

        $project->document = $request->document->store('documents', 's3');
        Storage::disk('s3')->setVisibility($project->document, 'public');

        $project->plagiarism_document = $request->plagiarism_document->store('plagiarism_document', 's3');
        Storage::disk('s3')->setVisibility($project->plagiarism_document, 'public');
        
        $project->status = 'pending';
        $project->issue_date = now()->toDateTimeString();
        $project->user_id = $user->id;
        $project->supervisor_id = $request->input('supervisor_id');

        if($user->user_type == 'student') {
            $departmentId = $user->userDepartment->id;
            $courseId = $user->userCourse->id;

            $project->department_id = $departmentId;
            $project->course_id = $courseId;
        }

        if($user->user_type === 'super_admin' && $request->has('department_id')){
            $project->department_id = $request->input('department_id');
        }
        if($user->user_type === 'super_admin' && $request->has('course_id')){
            $project->course_id = $request->input('course_id');
        }

        $project->save();
        return redirect()->route('user-profile')->with(['flash_message' => 'Project edit was successfull', 'type' => 'success']);
    }
}
