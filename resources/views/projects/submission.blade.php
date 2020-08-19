@extends('layouts.app')
@section('styles')
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css" media="all" rel="stylesheet"/>
    <style>
        .dropdown-menu {
            border: none !important;
            outline: none !important;
        }
        .dropdown-item:hover {
            background-color: #3490dc !important;
            border-radius: 0;
        }

        
    </style>
@endsection
@section('section')
    <div id="submissionApp">
        <div class="px-3 py-4">
            <h2>All Submission</h2>
        </div> 
        <div class="border-bottom">
            @include('partials.search')
        </div>
        <div class="px-3 py-4">
            @if(session()->has('flash_message'))
                <div class="alert alert-{{session()->get('type')}}">
                    {{session()->get('flash_message')}}
                </div>
            @endif
            <table id="projectTable" class="table table-hover" cellspacing="0" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Project ID</th>
                        <th>Issue Date</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Course</th>
                        <th>Supervisor</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->issue_date->toDateString() }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{$project->user ? $project->user->first_name : ''}} {{$project->user ? $project->user->last_name : ''}}</td>
                            <td>{{$project->course ? $project->course->name : ''}}</td>
                            <td>{{ $project->supervisor ? $project->supervisor->first_name: '' }} {{ $project->supervisor ? $project->supervisor->last_name : '' }}</td>
                            <td class="text-capitalize">{{$project->status}}</td>
                            <td>
                                <a href="{{route('view-project' , ['project_id' => $project->id])}}" class="btn btn-primary btn-sm">
                                    View
                                </a>
                                <b-dropdown size="sm" id="dropdown-1" text="Change Project Status">
                                    @if($project->status == 'pending')
                                        <b-dropdown-item href="{{route('project-change-status', ['project_id' => $project->id, 'new_status' => 'approved'])}}">Approve</b-dropdown-item>
                                        <b-dropdown-item @click="showFackBackForm('{{$project->id}}')">Reject</b-dropdown-item>
                                    @endif
                                    @if($project->status == 'approved')
                                        <b-dropdown-item @click="showFackBackForm('{{$project->id}}')">Reject</b-dropdown-item>
                                        <b-dropdown-item href="{{route('project-change-status', ['project_id' => $project->id, 'new_status' => 'pending'])}}">Return back to pending</b-dropdown-item>
                                    @endif
                                    @if($project->status == 'rejected')
                                        <b-dropdown-item href="{{route('project-change-status', ['project_id' => $project->id, 'new_status' => 'approved'])}}">Approve</b-dropdown-item>
                                        <b-dropdown-item href="{{route('project-change-status', ['project_id' => $project->id, 'new_status' => 'pending'])}}">Return back to pending</b-dropdown-item>
                                    @endif
                                </b-dropdown>
                                <div ref="reject-form-{{$project->id}}" class="pt-4" style="display: none">
                                    <p class="mb-0 bold">Feedback:</p>
                                    <form v-on:submit.prevent="submitFeedback({{$project->id}})">
                                        <textarea  
                                            v-model="feedback" 
                                            name="form-control feedback" 
                                            style="resize:none; width: 100%; border-radius: 4px;"
                                            required
                                        ></textarea>
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#projectTable').DataTable();
        } );
    </script>
    <script>
        const submissionApp = new Vue({
          el: '#submissionApp',
          data: {
            feedback: '',
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
            submitFeedback: function(projectId){
                window.location.href = '{{url('')}}'+'/projects/change-status/'+projectId+'/status/rejected/'+this.feedback;
            },
            handleClick(){
                window.location.href = this.url;
            },
            showFackBackForm(id) {
                this.feedback = '';
                
                let elem = this.$refs['reject-form-'+id];
                let keys = Object.keys(this.$refs);
                let key = 'reject-form-'+id;

                for(let el in this.$refs){
                    if(keys[el] == key){
                        continue;
                    }
                    this.$refs[el].style.display = 'none';
                }

                this.$refs['reject-form-'+id].style.display = 'block';
            }
          },
          mounted: function(){
            
          }
        });
        
      </script>
@endsection