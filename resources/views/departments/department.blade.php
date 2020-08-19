@extends('layouts.app')
@section('styles')
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css" media="all" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
@endsection
@section('section')
    <div id="departmentApp">
        <div class="px-3 py-4">
            <h2>Department of {{$department->name}}</h2>
        </div> 
        <div class="border-bottomw" style="border-bottom: 1px solid black;">
            @include('partials.search')
        </div>
        <div class="px-3 py-4">
            <table id="projectTable" class="table table-hover" cellspacing="0" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-light">Project ID</th>
                        <th>Issue Date</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Course</th>
                        <th>Supervisor</th>
                        <th>Keywords</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{$project->id}}</td>
                            <td>{{$project->issue_date->format('Y')}}</td>
                            <td>{{$project->title}}</td>
                            <td>{{$project->user ? $project->user->first_name : ''}} {{ $project->supervisor ? $project->user->last_name : '' }}</td>
                            <td>{{$project->user->userCourse ? $project->user->userCourse->name : ''}}</td>
                            <td>{{ $project->supervisor ? $project->supervisor->first_name : '' }} {{ $project->supervisor ? $project->supervisor->last_name : '' }}</td>
                            <td>{{$project->keywords}}</td>
                            <td>
                                <a href="{{route('view-project', ['project_id' => $project->id])}}" class="btn btn-primary btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> --}}
  {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#projectTable').DataTable();
        } );
    </script>
    @production
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    @endproduction
    @env('local')
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    @endenv
    <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
    <script>
        const collegeApp = new Vue({
          el: '#departmentApp',
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
          }
        }
        });
      </script>
@endsection