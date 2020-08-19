@php 
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
<div class="container  d-flex align-items-center justify-content-center flex-column" style="height: 400px;">
        <div class="row w-100">
            <div class="col-12">
                <form action="{{route('search')}}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-10" id="searchApp">
                            <div class="form-group">
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="search" 
                                    placeholder="Search"
                                    name="title"
                                    style="padding-left: 21px; padding-right: 21px;"
                                    required
                                >
                            </div>
                            <p class="text-center" style="cursor: pointer" v-b-modal.modal-1><u>Advanced Search</u></p>
                            <b-modal id="modal-1" centered title="Advanced Search">
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
                                                    <option value="" disabled selected>Select Courses</option>
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
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>