@php
    $colleges = App\College::orderBy('name', 'asc')->get();  
    $departments = App\Department::orderBy('name', 'asc')->get();
    $courses = App\Course::orderBy('name', 'asc')->get();
@endphp
@include('layouts.header_wrapper')
  <body class="fixed-header ">
    <div class="login-wrapper" :style="{height: registrationType === 'staff' ? screenHeight+'px' : 'initial', overflow:  registrationType === 'staff' ? 'initial' : 'hidden'}" id="registerApp">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
          <h1 class="semi-bold text-white">Projfin</h1>
          <p class="small">
            Final Year Project System
          </p>
        </div>
        <!-- END Background Caption-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 p-r-50 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="{{asset('images/logololo.png')}}" alt="logo" style="width: 129px; height: 70px; margin-left: -31px;">
            <h2 class="p-t-25">Get Started <br/> with Projfin</h2>
            <p class="mw-80 m-t-5">Create a new account</p>
            <form id="form-login" class="p-t-15" role="form" method="POST" action="{{route('register')}}"> 
                @csrf
                <div class="form-group form-group-default">
                    <label>First Name</label>
                    <div class="controls">
                        <input 
                            type="text" 
                            name="first_name" 
                            class="form-control" 
                            required
                            value="{{old('first_name')}}"
                        >
                    </div>
                </div>
                @error('first_name')
                    <label id="firstName-error" class="error" for="firstName">{{$message}}</label>
                @enderror
                <div class="form-group form-group-default">
                    <label>Last Name</label>
                    <div class="controls">
                        <input 
                            type="text" 
                            name="last_name" 
                            class="form-control" 
                            required
                            value="{{old('last_name')}}"
                        >
                    </div>
                </div>
                @error('last_name')
                    <label id="lastName-error" class="error" for="lastName">{{$message}}</label>
                @enderror
                <div class="form-group form-group-default">
                    <label>Email</label>
                    <div class="controls">
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            required
                            value="{{old('email')}}"
                        >
                    </div>
                </div>
                @error('email')
                    <label id="email-error" class="error" for="email">{{$message}}</label>
                @enderror
                <div class="form-group form-group-default">
                    <label>Are you a Faculty/Staff?</label>
                    <div class="controls">
                        <div class="form-check form-check-inline">
                            <input 
                                type="radio" 
                                id="staffYes"
                                value="staff"
                                required
                                v-model="registrationType"
                            >
                            <label for="staffYes">
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input 
                                type="radio" 
                                id="staffNo"
                                value="student"  
                                required
                                v-model="registrationType"
                                checked
                            >
                            <label for="staffNo">
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <template v-if="registrationType == 'student'">
                    <div class="form-group form-group-default">
                        <label>Matriculation Number</label>
                        <div class="controls">
                            <input 
                                type="text" 
                                name="matriculation_number" 
                                class="form-control" 
                                required
                                value="{{old('matriculation_number')}}"
                            >
                        </div>
                    </div>
                    @error('matriculation_number')
                        <label id="matriculationNumber-error" class="error" for="matriculationNumber">{{$message}}</label>
                    @enderror
                    <div class="form-group form-group-default">
                        <label>College</label>
                        <div class="controls">
                            <select name="college" class="full-width" required>
                                @foreach($colleges as $key => $college)
                                    @if(old('college') == $college->id)
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
                    <div class="form-group form-group-default">
                        <label>Department</label>
                        <div class="controls">
                            <select name="department" class="full-width" required>
                                @foreach($departments as $key => $department)
                                    @if(old('department') == $department->id)
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
                    <div class="form-group form-group-default">
                        <label>Course</label>
                        <div class="controls">
                            <select name="course" class="full-width" required>
                                @foreach($courses as $key => $course)
                                    @if(old('course') == $course->id)
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
                                    {{ old('final_year') == '1' ? 'checked' : '' }}
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
                                    {{ old('final_year') == '0' ? 'checked' : '' }}
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
                                    @if(old('level') == $level)
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
                </template>
                <template v-if="registrationType == 'staff'">
                    <div class="form-group form-group-default">
                        <label>Faculty/Staff ID</label>
                        <div class="controls">
                        <input 
                            type="text" 
                            name="staff_id" 
                            class="form-control" 
                            required
                            value="{{old('staff_id')}}"
                        >
                        </div>
                    </div>
                    @error('staff_id')
                        <label id="staffId-error" class="error" for="staffId">{{$message}}</label>
                    @enderror
                </template>
                <div class="form-group form-group-default">
                    <label for="password">Password</label>
                    <div class="controls">
                        <input 
                            id="password" 
                            type="password" 
                            class="form-control" 
                            name="password" 
                            required
                            value="{{old('password')}}"
                        >
                    </div>
                </div>
                @error('password')
                    <label id="password-error" class="error" for="password">{{$message}}</label>
                @enderror
                <div class="row">
                    <div class="col-md-6 no-padding sm-p-l-10">
                        <div class="checkbox ">
                        <input type="checkbox" value="1" id="checkbox1">
                        <label for="checkbox1">Remember me</label>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-end">
                        <button aria-label="" class="btn btn-primary btn-lg m-t-10" type="submit">Sign Up</button>
                    </div>
                </div>
                <div class="m-b-5 m-t-30">
                    {{-- <a href="#" class="normal">Lost your password?</a> --}}
                </div>
                <div>
                    <a href="{{route('login')}}" class="normal">Already a member yet? Signin now.</a>
                </div>
            </form>
            @include('layouts.auth_footer_wrapper')
        </div>
      </div>
      <!-- END Login Right Container-->
    </div>

    @production
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    @endproduction
    @env('local')
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    @endenv

    <script type="text/javascript">
        const registerApp = new Vue({
            el: '#registerApp',
            data: {
                registrationType: "{{ old('staff_id') ? 'staff' : 'student'}}",
                screenHeight: "",
            },
            methods: {
                resize: function () {
                    window.addEventListener("resize", (event) => {

                    let height = window.innerHeight;
                        this.setVal(height);
                    });
                },
                setVal: function (height) {
                    this.screenHeight = height;
                },
            },
            mounted(){
                this.screenHeight = screen.height;
                this.resize();
            },
        });
    </script>
  </body>
</html>