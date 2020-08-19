@extends('layouts.app')
@section('section')
    <div>
        <div class="px-3 py-4">
            <h2>Department of Chemical Engineering</h2>
        </div> 
        <div class="">
            sear
        </div>
        <div class="px-3 py-4">
            <table id="myDataTable" class="table table-hover" cellspacing="0" width="100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Project ID</th>
                        <th>Issue Date</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Supervisor</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([2,3,4,5,2,1,5,2,1,3,2,3] as $item)
                        <tr>
                            <td>A01</td>
                            <td>2020</td>
                            <td>Database Management System</td>
                            <td>Chinyere Ordor</td>
                            <td>Prof. Adoghe</td>
                            <td>
                                <a href="{{route('project')}}" class="btn btn-primary btn-sm">
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