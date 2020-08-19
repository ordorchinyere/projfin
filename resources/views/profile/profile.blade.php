@extends('layouts.app')
@section('styles')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
    <style>
        .project-image {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            /* width: 600px; */
            height: 250px;
        }
    </style>
@endsection
@section('section')
    <div class="container py-2" id="profileApp">
        <div class="py-4">
            <h2>Profile</h2>
        </div>
        @if(session()->has('flash_message'))
            <div class="alert alert-{{session()->get('type')}}">
                {{session()->get('flash_message')}}
            </div>
        @endif
        <form id="form-login" class="p-t-15" role="form" method="POST" action="{{route('edit-profile')}}"> 
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group form-group-default">
                        <label>First Name</label>
                        <div class="controls">
                            <input 
                                type="text" 
                                name="first_name" 
                                class="form-control" 
                                required
                                value="{{$user->first_name}}"
                            >
                        </div>
                    </div>
                    @error('first_name')
                        <label id="firstName-error" class="error" for="firstName">{{$message}}</label>
                    @enderror
                </div>
                <div class="col-6 pl-2">
                    <div class="form-group form-group-default">
                        <label>Last Name</label>
                        <div class="controls">
                            <input 
                                type="text" 
                                name="last_name" 
                                class="form-control" 
                                required
                                value="{{$user->last_name}}"
                            >
                        </div>
                    </div>
                    @error('last_name')
                        <label id="lastName-error" class="error" for="lastName">{{$message}}</label>
                    @enderror
                </div>
            </div>
            <div class="form-group form-group-default">
                <label>Email</label>
                <div class="controls">
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        required
                        value="{{$user->email}}"
                    >
                </div>
            </div>
            @error('email')
                <label id="email-error" class="error" for="email">{{$message}}</label>
            @enderror
            @if($user->user_type === 'student')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group form-group-default">
                            <label>Matriculation Number</label>
                            <div class="controls">
                                <input 
                                    type="text" 
                                    name="matriculation_number" 
                                    class="form-control" 
                                    required
                                    value="{{$user->matriculation_number}}"
                                >
                            </div>
                        </div>
                        @error('matriculation_number')
                            <label id="matriculationNumber-error" class="error" for="matriculationNumber">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="col-6 pl-2">
                        <div class="form-group form-group-default">
                            <label>College</label>
                            <div class="controls">
                                <select name="college" class="full-width" required>
                                    @foreach($colleges as $key => $college)
                                        @if($user->college == $college->id)
                                            <option value="{{$college->id}}" selected>{{$college->name}}</option>
                                        @else
                                            <option value="{{$college->id}}">{{$college->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('college')
                            <label id="college-error" class="error" for="college">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-group form-group-default">
                            <label>Department</label>
                            <div class="controls">
                                <select name="department" class="full-width" required>
                                    @foreach($departments as $key => $department)
                                        @if($user->department == $department->id)
                                            <option value="{{$department->id}}" selected>{{$department->name}}</option>
                                        @else
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('department')
                            <label id="department-error" class="error" for="department">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="col-6 pl-2">
                        <div class="form-group form-group-default">
                            <label>Course</label>
                            <div class="controls">
                                <select name="course" class="full-width" required>
                                    @foreach($courses as $key => $course)
                                        @if($user->course == $course->id)
                                            <option value="{{$course->id}}" selected>{{$course->name}}</option>
                                        @else
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('course')
                            <label id="course-error" class="error" for="course">{{$message}}</label>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-group form-group-default">
                            <label>Final Year Student</label>
                            <div class="controls">
                                <div class="form-check form-check-inline">
                                    <input 
                                        type="radio" 
                                        name="final_year" 
                                        id="finalYearYes" 
                                        value="1"  
                                        required
                                        {{ $user->final_year == '1' ? 'checked' : '' }}
                                    >
                                    <label for="finalYearYes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input 
                                        type="radio" 
                                        name="final_year" 
                                        id="finalYearNo" 
                                        value="0" 
                                        required
                                        {{ $user->final_year == '0' ? 'checked' : '' }}
                                    >
                                    <label for="finalYearNo">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('final_year')
                            <label id="finalYear-error" class="error" for="finalYear">{{$message}}</label>
                        @enderror  
                    </div>
                    <div class="col-6 pl-2">
                        <div class="form-group form-group-default">
                            <label>Level</label>
                            <div class="controls">
                                <select name="level" class="full-width">
                                    @php
                                        $levels = [
                                            100, 200, 300, 400, 500
                                        ];
                                    @endphp
                                    @foreach ($levels as $level)
                                        @if($user->level == $level)
                                            <option value="{{$level}}" selected>{{$level}}</option>
                                        @else 
                                            <option value="{{$level}}">{{$level}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('level')
                            <label id="level-error" class="error" for="level">{{$message}}</label>
                        @enderror
                    </div>
                </div>
            @endif
            @if($user->user_type === 'staff' || $user->user_type === 'super_admin')
                <div class="form-group form-group-default">
                    <label>Faculty/Staff ID</label>
                    <div class="controls">
                    <input 
                        type="text" 
                        name="staff_id" 
                        class="form-control" 
                        required
                        value="{{$user->staff_id}}"
                    >
                    </div>
                </div>
                @error('staff_id')
                    <label id="staffId-error" class="error" for="staffId">{{$message}}</label>
                @enderror
            @endif
            <div class="form-group form-group-default">
                <label for="password">Password</label>
                <div class="controls">
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control" 
                        name="password"
                    >
                </div>
            </div>
            @error('password')
                <label id="password-error" class="error" for="password">{{$message}}</label>
            @enderror
            <button aria-label="" class="btn btn-primary m-t-10" type="submit">Update</button>
        </form>
        @if($user->user_type === 'super_admin' || $user->final_year)
            @if($user->project)
                <div class="row justify-content-center">
                    <div class="col-1q">
                        <h5 class="mt-5">Project</h5>
                        <div class="border p-2" id="projectsection">
                            <div class="">
                                <h3 class="py-3">{{ $user->project->title }}</h3>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-2">
                                            <span class="pr-2 fs-16"><span class="bold">Author:</span> {{ $user->first_name }} {{ $user->last_name }}</span>  
                                            ·  
                                            <span class="pl-2 pr-2 fs-16"><span class="bold">Supervisor:</span> {{ $user->project->supervisor ? $user->project->supervisor->first_name : '' }} {{ $user->project->supervisor ? $user->project->supervisor->last_name : '' }}</span>
                                            · 
                                            <span class="pl-2 pr-2 fs-16"><span class="bold">Issue Date:</span> {{$user->project->issue_date->todateString()}}</span>
                                            · 
                                            Status:
                                            @if ($user->project->status === 'pending')
                                                <span class="badge badge-pill badge-secondary py-2">Pending</span>
                                            @elseif($user->project->status === 'rejected')
                                                <span class="badge badge-pill badge-danger py-2">Rejected</span>
                                            <a  href="{{route('edit-project')}}" class="btn btn-primary ml-3">Edit project</a>
                                            @elseif($user->project->status === 'approved')
                                                <span class="badge badge-pill badge-success py-2">Approved</span>
                                            @endif
                                        </div>
                                        <div class="p-2">
                                            <span class="pr-2 fs-16"><span class="bold">Keywords:</span>
                                            @foreach (explode(',', $user->project->keywords) as $keyy)
                                                <a  href="{{url('search')}}?keywords={{$keyy}}&advance_search=true" class="badge badge-pill badge-secondary py-2 pr-2">{{$keyy}}</a>
                                            @endforeach
                                        </div>
                                        @if($user->project->status === 'rejected')
                                            <div class="alert alert-secondary">
                                                <p>Feedback:</p>
                                                {{$user->project->feedback}}
                                            </div>
                                        @endif
                                        <div class="card card-default border">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <div class="fs-16 bold">Abstract</div>
                                                </div>
                                            </div>
                                            <div class="card-block p-2">
                                                <span class="font-weight-light">{{strip_tags($user->project->abstract)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @php
                                        $images = json_decode($user->project->images);
                                    @endphp
                                    <div class="col-6">
                                        <span>Image</span>
                                        <div class="row">
                                            @foreach ($images as $image)
                                                <div class="col-6">
                                                    <div v-b-modal.image-modal class="project-image mb-3" v-on:click="setImage('{{env('AWS_URL').$image}}')" style="background-image: url('{{env('AWS_URL').$image}}')"></div>
                                                </div>
                                            @endforeach
                                            <b-modal centered hide-footer id="image-modal" title="Image" size="lg">
                                                <div >
                                                    <img class="w-100" :src="currentImage" />
                                                </div>
                                            </b-modal>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <span>Video</span>
                                        <video 
                                            controls
                                            src="{{env('AWS_URL').$user->project->video}}"
                                            class="w-100"
                                            style="height: 514px;"
                                        >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="py-3">
                                            <span>Document</span>
                                            <iframe src="{{env('AWS_URL').$user->project->document}}#toolbar=0" width="100%" height="1000px"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            @else
                <div class="border  mt-5 p-2 text-center">
                    <span>You have not submitted any project.</span>
                </div>
            @endif
        @endif
    </div>
@endsection
@section('scripts')
@production
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endproduction
@env('local')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
@endenv
<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>

<script type="text/javascript">
    const registerApp = new Vue({
        el: '#profileApp',
        data: {
            currentImage: '',
        },
        methods: {
            setImage(image) {
                this.currentImage = image;
            },
        }
    });
</script>
@endsection