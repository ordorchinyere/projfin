@extends('layouts.app')
@section('styles')
  <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
  <style>
    .carousel-inner {
      height: 480px;
    }

    .image {
      height: 300px;
      /* margin: 10px; */
      position: relative;
    }
   .image img {
      /* height: 300px; */
      /* height: 100%; */
      width: 100%;
      height: 100%;
    }
    .image .overlay {
      background: rgba(0, 0, 0, .7);
      display: flex;
      height: 100%;
      position: absolute;
      width: 100%;
    }
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
      opacity: 0;
    }
  </style>
@endsection
@section('section')
    <div id="collegeApp">
        <div class="px-3 py-4">
          <h2>{{$college->name}}</h2>
        </div> 
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
              @foreach ($projects as $project)
              
              @php 
                $image = json_decode($project->images)->image_1;
                // if($loop->index > 0){
                // break;
                // }
              @endphp
                <b-carousel-slide>
                  <template v-slot:img>
                    <div class="container px-5">
                      <div class="position-absolute p-2" style="left:50%; top:50%; transform: translate(-50%, -50%); width: 100%; height: 100%; background-color: #5d6d7799;">
                        <h1 class=" text-center" style="height: 100%;display: flex; justify-content: center; margin-top: 198px;">
                         <a class="text-white bold" href="{{route('view-project', ['project_id' => $project->id])}}">{{$project->title}}</a>
                        </h1>
                      </div>
                    </div>
                    <img
                      class="d-block img-fluid w-100"
                      src="{{env('AWS_URL').$image}}"
                      alt="image slot"
                    >
                  </template>
                  {{-- berry@stu.cu.edu.ng --}}
              </b-carousel-slide>
              @endforeach
            </b-carousel>
        </div>
        <div class="border-bottomw" style="border-bottom: 1px solid black;">
            @include('partials.search')
        </div>
        <div class="container py-3">
            <div class="row">
                @foreach($college->departments as $department)
                  <div class="col-4 p-2">
                        <div class="image w-100"  @mouseover="hovered = '{{$department->id}}'" @mouseleave="hovered = null">
                            <transition name="fade">
                                <div class="overlay pl-0 p-2" v-if="hovered === '{{$department->id}}'">
                                 <div class="d-flex align-items-center justify-content-center"> 
                                    <h3>
                                      <a href="{{route('department', ['id' => $department->id])}}" class="card-block text-white">
                                          {{$department->name}}
                                      </a>
                                    </h3>
                                  </div>
                                </div>
                            </transition>
                            <img src="{{asset($department->image)}}" />
                        </div>
                  </div>
                @endforeach
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
      const collegeApp = new Vue({
        el: '#collegeApp',
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
          images: [
            { id: 1, path: 'https://images.unsplash.com/photo-1517320082032-7e7a1b415cc6?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=cae1abc218400265372962ed4bb809a9&auto=format&fit=crop&w=1050&q=80' },
            { id: 2, path: 'https://images.unsplash.com/photo-1496626868305-15f52fa605b7?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=3d5a2671d16f1761bdcd0df22f790db4&auto=format&fit=crop&w=1050&q=80' },
            { id: 3, path: 'https://images.unsplash.com/photo-1502763413034-38ff5c7578b1?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=5d7cafdc1b7ce433a794dc557bfa6549&auto=format&fit=crop&w=634&q=80' }
          ],
          hovered: null,
          starred: []
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
        },
        isStarred (id) {
          return this.starred.includes(id)
        },
        starToggle (id) {
          this.starred.includes(id) ? this.starred.splice(this.starred.indexOf(id), 1) : this.starred.push(id)
        }
      }
      });
    </script>
@endsection