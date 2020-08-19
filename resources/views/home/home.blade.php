@extends('layouts.app')
@section('styles')
  <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
  <style>
    .carousel-inner {
      height: 480px;
    }

    .carousel-caption {

    }
  </style>
@endsection
@section('section')
    <div id="homeApp">
      <div>
        <b-carousel
          id="carousel-1"
          v-model="slide"
          :interval="4000"
          controls
          indicators
          background="#ababab"
          style="text-shadow: 1px 1px 2px #333;"
          @sliding-start="onSlideStart"
          @sliding-end="onSlideEnd"
        >
          
              <b-carousel-slide>
                <template v-slot:img>
                  <div class="container px-5">
                    <div class="position-absolute p-2" style="left:50%; top:25%; transform: translate(-50%, -50%)">
                      <h1 class="text-white text-center">
                        Welcome to Projfin
                      </h1>
                      <h4 class="text-center">
                        <a class="text-white bold font-weight-light" href="#colleges">Projfin is the institutional repository to capture, store and showcase the scholarly outputs of Covenant University.</a>
                      </h4>
                    </div>
                  </div>
                  <img
                    class="d-block img-fluid w-100"
                    src="{{asset('images/home/1.jpg')}}"
                    alt="image slot"
                  >
                </template>
            </b-carousel-slide>
            <b-carousel-slide>
              <template v-slot:img>
                <div class="container px-5">
                  <div class="position-absolute p-2" style="left:50%; top:25%; transform: translate(-50%, -50%)">
                    <h3  class="text-center">
                      <a style="color: #000000;" class="bold font-weight-light" href="#colleges">By showcasing and disseminating the research outputs of Covenant University students, Projfin aims to increase the visibility of research and facilitate research collaboration among the university community.</a>
                    </h3>
                  </div>
                </div>
                <img
                  class="d-block img-fluid w-100"
                  src="{{asset('images/home/2.jpg')}}"
                  alt="image slot"
                >
              </template>
          </b-carousel-slide>
          <b-carousel-slide>
            <template v-slot:img>
              <div class="container px-5">
                <div class="position-absolute p-2 text-center" style="left:50%; top:25%; transform: translate(-50%, -50%)">
                  <h1 class="text-white text-center">
                    Guidelines
                  </h1>
                  <h4 class="text-white bold text-center font-weight-light">
                    Do you know the project format requirement for your department? All project formats are available in the guidelines section.
                  </h4>
                  <a href="{{route('guidelines')}}" class="btn btn-primary btn-sm text-center">
                    Find out more
                  </a>
                </div>
              </div>
              <img
                class="d-block img-fluid w-100"
                src="{{asset('images/home/3.jpg')}}"
                alt="image slot"
              >
            </template>
        </b-carousel-slide>
        <b-carousel-slide>
          <template v-slot:img>
            <div class="container px-5">
              <div class="position-absolute p-2" style="left:50%; top:25%; transform: translate(-50%, -50%)">
                <h1 class="text-white text-center">
                  &nbsp; ..
                </h1>
                <h4 style="font-size: 30px;" class="text-white bold text-center">
                  Discover the research work done by other students.
                </h4>
              </div>
            </div>
            <img
              class="d-block img-fluid w-100"
              src="{{asset('images/home/cucrid.jpg')}}"
              alt="image slot"
            >
          </template>
      </b-carousel-slide>
        </b-carousel>
      </div>
      <div class="border-bottom">
        @include('partials.search')
      </div>
      @php
        $colleges = App\College::get();
      @endphp
      <div class="border-bottom">
        <div class="container py-5" id="colleges">
          <div class="row">
              <div class="col-6 d-flex align-items-center">
                <div class="text-center">
                  <h3>College of Business and Social Sciences </h3>
                  <div class="pb-3">
                    The College of Business and Social Sciences (CBS) has a vibrant research community active in a number of applied research projects in the fields of communication, marketing, accounting and business Management. Our research addresses the most important concerns of society and contributes to policy change in many areas.
                  </div>
                  <a href="{{route('college', ['id' => $colleges[0]->id])}}" class="btn btn-primary">
                    Find out more
                  </a>
                </div>
              </div>
              <div class="col-6">
                <div class="w-75">
                  <img class="w-100" src="{{asset('images/Business_and_Social_Sciences.jpg')}}">
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="border-bottom">
        <div class="container py-5">
          <div class="row">
              <div class="col-6">
                <div class="w-75">
                  <img class="w-100" src="{{asset('images/engineering.jpg')}}">
                </div>
              </div>
              <div class="col-6 d-flex align-items-center">
                <div class="text-center">
                  <h3>College of Engineering </h3>
                  <div class="pb-3">
                    The College of Engineering's research focuses on providing innovative and practical solutions to industrial problems, with particularly strong industry-focused research in the sectors such as oil and gas, renewable/sustainable energy, network engineering among others. 
                  </div>
                  <a href="{{route('college', ['id' => $colleges[1]->id])}}" class="btn btn-primary">
                    Find out more
                  </a>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="border-bottom">
        <div class="container py-5">
          <div class="row">
              <div class="col-6 d-flex align-items-center">
                <div class="text-center">
                  <h3>College of Leadership and Development Studies</h3>
                  <div class="pb-3">
                    The College of Leadership and Development Studies has played a strategic role in the realization of raising visionary global leaders who are skilled in the art of leadership and excel in innovative research that celebrates the value and variety of human experience and the many ways in which it can be expressed.
                  </div>
                  <a href="{{route('college', ['id' => $colleges[2]->id])}}" class="btn btn-primary">
                    Find out more
                  </a>
                </div>
              </div>
              <div class="col-6">
                <div class="w-75">
                  <img class="w-100" src="{{asset('images/Leadership_and_development_studies.jpg')}}">
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="border-bottom">
        <div class="container py-5">
          <div class="row">
              <div class="col-6">
                <div class="w-75">
                  <img class="w-100" src="{{asset('images/science_and_technology.jpg')}}">
                </div>
              </div>
              <div class="col-6 d-flex align-items-center">
                <div class="text-center">
                  <h3>College of Science and Technology</h3>
                  <div class="pb-3">
                    The College of Science and Technology addresses many of society's grand challenges through significant discoveries associated with the research from various students. The unique combination of individual disciplines and collaborations creates a vitality and vibrancy in the faculty's research structure.
                  </div>
                  <a href="{{route('college', ['id' => $colleges[3]->id])}}" class="btn btn-primary">
                    Find out more
                  </a>
                </div>
              </div>
          </div>
        </div>
      </div>
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
        el: '#homeApp',
        data: {
          slide: 0,
          sliding: null,
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
        onSlideStart(slide) {
          this.sliding = true
        },
        onSlideEnd(slide) {
          this.sliding = false
        },
        handleClick(){
          window.location.href = this.url;
        }
      }
      });
    </script>
@endsection