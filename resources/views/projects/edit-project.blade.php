@extends('layouts.app')
@section('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('section')
    <div class="container py-3" id="editProjectPage">
        <div class="py-4">
            <h2>Edit Project</h2>
        </div> 
        <form 
            id="projectForm" 
            action="{{route('edit-project-action')}}" 
            method="POST" 
            role="form" 
            enctype="multipart/form-data"
        >
            @csrf
            <input type="hidden" name="department_id" />
            <div class="row">
                <div class="col-12">
                    <div class="form-group form-group-default @error('title') has-error @enderror">
                        <label>Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            class="form-control" 
                            required
                            value="{{$project->title}}"
                        >
                    </div>
                    @error('title')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="form-group form-group-defauwlt">
                        <label>Abstract</label>
                        <div class="bg-light" id="editor" style="height: 300px;">
                        </div>
                        <input type="hidden" id="abstract" name="abstract" value="" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-group-default @error('document') has-error @enderror">
                        <label>Project Document (pdf)</label>
                        <small>Not more than 10mb.</small>
                        <input 
                            type="file" 
                            name="document"
                            accept="application/pdf" 
                            class="form-control pt-3" 
                            required
                            style="height: 60px;"
                        >
                    </div>
                    @error('document')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-6 pl-2">
                    <div class="form-group form-group-default @error('plagiarism_document') has-error @enderror">
                        <label>Plagiarism Document (pdf)</label>
                        <small>Not more than 10mb.</small>
                        <input 
                            type="file" 
                            name="plagiarism_document"
                            accept="application/pdf" 
                            class="form-control pt-3" 
                            required
                            style="height: 60px;"
                        >
                    </div>
                    @error('plagiarism_document')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="form-group form-group-default @error('video') has-error @enderror">
                        <label></label>Video
                        <small>Not more than 20mb.</small>
                        <input 
                            type="file" 
                            name="video"
                            accept="video/*"
                            class="form-control pt-3" 
                            required
                            style="height: 60px;"
                        >
                    </div>
                    @error('video')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="form-group form-group-default @error('project_link') has-error @enderror">
                        <label>Link (Google drive or github)</label>
                        <input 
                            type="text" 
                            name="project_link" 
                            class="form-control" 
                            required
                            value="{{$project->project_link}}"
                        >
                    </div>
                    @error('project_link')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-12">
                    <small class="font-weight-bold">A minimun of one image is required</small>
                </div>
                <div class="col-6">
                    <div class="form-group form-group-default @error('image_1') has-error @enderror">
                        <label>Project Image 1</label>
                        <small>(JPEG, JPG, PNG) 1640 x 480 adviced. Not more than 3mb.</small>
                        <input 
                            type="file" 
                            name="image_1"
                            accept="image/png, image/jpeg"
                            class="form-control pt-3" 
                            required
                            style="height: 60px;"
                        >
                    </div>
                    @error('image_1')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-6 pl-2">
                    <div class="form-group form-group-default @error('image_2') has-error @enderror">
                        <label>Project Image 2</label>
                        <small>(JPEG, JPG, PNG) 1640 x 480 adviced. Not more than 3mb.</small>
                        <input 
                            type="file" 
                            name="image_2"
                            accept="image/png, image/jpeg"
                            class="form-control pt-3"
                            style="height: 60px;"
                        >
                    </div>
                    @error('image_2')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="form-group form-group-default @error('image_3') has-error @enderror">
                        <label>Project Image 3</label>
                        <small>(JPEG, JPG, PNG) 1640 x 480 adviced. Not more than 3mb.</small>
                        <input 
                            type="file" 
                            name="image_3"
                            accept="image/png, image/jpeg"
                            class="form-control pt-3"
                            style="height: 60px;"
                        >
                    </div>
                    @error('image_3')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-6 pl-2">
                    <div class="form-group form-group-default @error('image_4') has-error @enderror">
                        <label>Project Image 4</label>
                        <small>(JPEG, JPG, PNG) 1640 x 480 adviced. Not more than 3mb.</small>
                        <input 
                            type="file" 
                            name="image_4"
                            accept="image/png, image/jpeg"
                            class="form-control pt-3" 
                            style="height: 60px;"
                        >
                    </div>
                    @error('image_4')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-6">
                    <div class="form-group form-group-default">
                        <label>Supervisor</label>
                        <div class="controls">
                            <select name="supervisor_id" class="full-width">
                                @foreach ($supervisors as $supervisor)
                                    @if($project->supervisor->id == $supervisor->id)
                                        <option value="{{$supervisor->id}}" selected>{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                                    @else 
                                        <option value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-group-default">
                        <label>SGDs</label>
                        <div class="controls">
                            <select name="sdg" class="full-width">
                                @foreach ($sdgs as $sdg)
                                    @if($project->sdg == $sdg)
                                        <option value="{{$sdg}}" selected>{{$sdg}} {{$sdg}}</option>
                                    @else 
                                        <option value="{{$sdg}}">{{$sdg}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 pb-3">
                    <div class="form-group mb-0 form-group-default @error('keywords') has-error @enderror">
                        <label>Keywords</label>
                        <textarea name="keywords" class="form-control" required>{{$project->keywords}}</textarea>
                    </div>
                    <small>Separated by commas</small>
                    @error('keywords')
                        <label class="error" >{{ $message }}</label>
                    @enderror
                </div>
                @if($user->user_type === 'super_admin')
                    <div class="col-6">
                        <div class="form-group form-group-default">
                            <label>Department</label>
                            <div class="controls">
                                <select name="department_id" class="full-width" required>
                                    @foreach($departments as $key => $department)
                                        @if($project->department_id == $department->id)
                                            <option value="{{$department->id}}" selected>{{$department->name}}</option>
                                        @else
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 pl-2">
                        <div class="form-group form-group-default">
                            <label>Course</label>
                            <div class="controls">
                                <select name="course_id" class="full-width" required>
                                    @foreach($courses as $key => $course)
                                        @if($project->course_id == $course->id)
                                            <option value="{{$course->id}}" selected>{{$course->name}}</option>
                                        @else
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#editor', {
          theme: 'snow'
        });

        const projectForm = document.getElementById('projectForm');

        projectForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const abstract = document.getElementById('abstract');
            abstract.value = quill.root.innerHTML.trim();
            projectForm.submit();
        });
    </script>
@endsection