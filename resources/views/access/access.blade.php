@extends('layouts.app')
@section('section')
    <div class="px-3 py-4">
        <h2>Change User Access</h2>
    </div>
    <div class="px-3 py-4">
        <div class="row">
            <div class="col">
                @if(session()->has('flash_message'))
                    <div class="alert alert-{{session()->get('type')}}">
                        {{session()->get('flash_message')}}
                    </div>
                @endif
                <table id="projectTable" class="table table-hover" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Type</th>
                            <th>Staff ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->first_name}}</td>
                                <td> {{$user->last_name}}</td>
                                <td>{{$user->user_type}}</td>
                                <td>{{$user->staff_id}}</td>
                                <td>
                                    @if($user->user_type !== 'super_admin')
                                        <a href="{{route('change-user-type-action', ['user_type'  => 'super_admin', 'user_id' => $user->id])}}" class="btn btn-primary btn-sm">
                                            Grant admin access
                                        </a>
                                    @else
                                        <a href="{{route('change-user-type-action', ['user_type' => 'sfaff', 'user_id' => $user->id])}}" class="btn btn-primary btn-sm">
                                            Revoke admin access
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
@endsection