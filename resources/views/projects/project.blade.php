@php
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.app')
@section('styles')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
    <style>
        .project-image {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            /* width: 800px; */
            height: 250px;
        }
    </style>
@endsection
@section('section')
    <div class="container py-5" id="projectApp">
        <div class="">
            <h1 class="py-3">{{ $project->title }}</h1>
            <div class="row">
                @php 
                    $user = Auth::user();
                @endphp
                <div class="col-12">
                    <div class="p-2">
                        <span class="pr-2 fs-16"><span class="bold">Author:</span> {{$project->user ? $project->user->first_name : ''}} {{$project->user ? $project->user->last_name : ''}}</span>  
                        ·  
                        <span class="pl-2 pr-2 fs-16"><span class="bold">Supervisor:</span> {{ $project->supervisor ? $project->supervisor->first_name : '' }} {{ $project->supervisor ? $project->supervisor->last_name : '' }}</span>
                        · 
                        @if($user->user_type === 'super_admin')
                            <span class="pl-2 pr-2 fs-16"><span class="bold">Issue Date:</span> {{$project->issue_date->todateString()}}</span>
                        @else
                            <span class="pl-2 pr-2 fs-16"><span class="bold">Issue Date:</span> {{$project->issue_date->format('Y')}}</span>
                        @endif
                        · 
                        @if($user->user_type === 'super_admin')
                            Status:
                            @if ($project->status === 'pending')
                                <span class="badge badge-pill badge-secondary py-2">Pending</span>
                            @elseif($project->status === 'rejected')
                                <span class="badge badge-pill badge-danger py-2">Rejected</span>
                            @elseif($project->status === 'approved')
                                <span class="badge badge-pill badge-success py-2">Approved</span>
                            @endif
                            <a target="_blank" href="{{env('AWS_URL').$project->plagiarism_document}}" class="btn btn-primary ml-4">
                                View plagiarism document.
                            </a>
                        @endif
                    </div>
                    <div class="p-2">
                        <span class="pr-2 fs-16"><span class="bold">Keywords:</span>
                        @foreach (explode(',', $project->keywords) as $keyy)
                            <a  href="{{url('search')}}?keywords={{$keyy}}&advance_search=true" class="badge badge-pill badge-secondary py-2 pr-2">{{$keyy}}</a>
                        @endforeach
                    </div>
                    <div class="card card-default border">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="fs-16 bold">Abstract</div>
                            </div>
                        </div>
                        <div class="card-block p-2">
                            <span class="font-weight-light">{{strip_tags($project->abstract)}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="py-3">
                        <div>Project link</div>
                        <a target="_blank" href="{{$project->project_link}}">{{$project->project_link}}</a>
                    </div>
                </div>
            </div>
            <span></span>
            <div class="row">
                @php
                $images = json_decode($project->images);
                    $values = [
                        0 => '6',
                        1 => '6',
                        2 => '6',
                        3 => '6',
                    ];
                @endphp
                <div class="col-6">
                    <span>Image</span>
                    <div class="row">
                        @foreach ($images as $image)
                            @php
                                $colValue = $values[$loop->index]; 
                            @endphp
                            <div class="col-{{$colValue}}">
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
                        src="{{env('AWS_URL').$project->video}}"
                        class="w-100"
                        style="height: 514px;"
                    >
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="py-3">
                        <span>Document</span>
                        @php
                            $urlConstruct = '';
                            if(Auth::user()->user_type !== 'super_admin'){
                                $urlConstruct = '#toolbar=0';
                            }
                        @endphp
                        <iframe src="{{env('AWS_URL').$project->document}}{{$urlConstruct}}" width="100%" height="1000px"></iframe>
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

    <script type="text/javascript">
        const projectApp = new Vue({
            el: '#projectApp',
            data: {
                abstract: '{{ $project->abstract  }}',
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