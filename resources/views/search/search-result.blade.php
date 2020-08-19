@php 
    use Illuminate\Support\Arr;
    use Illuminate\Support\Carbon;
    use App\Department;
    use App\Course;
    use App\User;

    $departments = Department::orderBy('name', 'asc')->get(); 
    $courses = Course::orderBy('name', 'asc')->get();
    $supervisors = User::whereNotNull('staff_id')->get();

    $sdgs = [
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
@endphp
@extends('layouts.app')
@section('styles')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
@endsection
@section('section')
    <div class="container pt-1 pb-4" id="searchResultApp">
        <form action="{{route('search')}}" method="GET">
            <div class="py-4">
                <div class="row">
                    <div class="col-10">
                        <div class="form-group">
                        <input 
                            type="text" 
                            class="form-control" 
                            id="search" 
                            placeholder="Search"
                            name="title"
                            style="padding-left: 21px; padding-right: 21px;"
                            required
                            value="{{ app('request')->query('title') }}"
                        >
                    </div>
                    <p class="" style="cursor: pointer" v-b-modal.modal1-2><u>Advanced Search</u></p>
                    <b-modal id="modal1-2" centered title="Advanced Search">
                        <div v-on:keyup.enter="handleClick">
                            <div class="row pt-3">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input name="title" v-model="title" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    in: Title
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input name="abstract" v-model="abstract" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    in: Abstract
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input name="keywords" v-model="keywords" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    in: Keywords
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input name="year" v-model="year" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    in: Year
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input name="author" v-model="author" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    in: Author
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <select name="supervisor" v-model="supervisor" class="full-width form-control" >
                                            <option value="" disabled selected>Select supervisor</option>
                                            @foreach($supervisors as $supervisor)
                                                <option value="{{$supervisor->id}}"> {{$supervisor->first_name }} {{ $supervisor->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    in: Supervisor
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <select name="sdg" v-model="sdg" class="full-width form-control" >
                                            <option value="" disabled selected>Select SDG</option>
                                            @foreach($sdgs as $sdg)
                                                <option value="{{$sdg}}">{{$sdg}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    in: SDG
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <select name="course" v-model="course" class="full-width form-control" >
                                            <option value="" disabled selected>Select courses</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    in: Courses
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <select v-model="department" name="department" class="full-width form-control" >
                                            <option value="" disabled selected>Select department</option>
                                            @foreach($departments as $key => $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    in: Department
                                </div>
                            </div>
                        </div>
                        <div slot="modal-footer">
                            <button v-on:click="handleClick" class="btn btn-primary btn-sm">Search</button>
                        </div>
                    </b-modal>
                    </div>
                    <div class="col-2 pl-2">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
                <h2 class="mb-0">Search Results</h2>
            </div>
        </form>
        @if($results->count() === 0)
            <span>No result found.</span>
        @endif
        @foreach($results as $result)
            <div class="row">
                <div class="col-12 py-2">
                    <div class="border p-2 d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="bold mb-0">{{$result->title}}</h4>
                            <div>
                                @php
                                    $date = new Carbon($result->issue_date);
                                @endphp
                                <span class="badge badge-pill badge-success rounded-0 py-1 pr-2">Project</span> <small>{{$date->format('Y')}}</small>
                            </div>
                            <p 
                                style="max-width: 900px; max-height: 400px; overflow: hidden; text-overflow: ellipsis;" 
                                class="pt-1"
                            >
                                {{strip_tags($result->abstract)}}
                            </p>
                            @foreach (explode(',', $result->keywords) as $keyy)
                                <a  href="{{url('search')}}?keywords={{$keyy}}&advance_search=true" class="badge badge-pill badge-secondary py-2 pr-2">{{$keyy}}</a>
                            @endforeach
                        </div>
                        <a class="btn btn-primary btm-sm" href="{{route('view-project', ['project_id' => $result->id])}}">View</a>
                   </div>
                </div>
            </div>
        @endforeach
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
    <script>
      const homeApp = new Vue({
        el: '#searchResultApp',
        data: {
          title: '',
          abstract: '',
          department: '',
          keywords: '',
          sdg: '',
          course: '',
          author: '',
          supervisor: '',
          year: '',
        },
        computed: {
            url(){
                return '{{url('')}}'+'/search/'+'?title='+this.title+'&abstract='+this.abstract+'&department='+this.department+'&keywords='+this.keywords+'&sdg='+this.sdg+'&author='+this.author+'&course='+this.course+'&advance_search=true&year='+this.year+'&supervisor='+this.supervisor;
            }
        },
        methods: {
            handleClick(){
                window.location.href = this.url;
            },
        }
      });
    </script>
@endsection