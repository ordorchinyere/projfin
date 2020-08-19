@extends('layouts.app')
@section('section')
    <div class="container py-3">
        <div>
            <div class="py-4">
                <h2>Guidelines</h2>
            </div> 
            @if(session()->has('flash_message'))
                <div class="alert alert-{{session()->get('type')}}">
                    {{session()->get('flash_message')}}
                </div>
            @endif
            @foreach ($departments as $department)
            <div class="border p-3 my-4 d-flex  justify-content-between align-items-center">
                <span class="font-weight-bold">{{$department->name}}</span>
                @if ($department->guideline)
                <a href="{{route('view-edit-guidelines', ['department_id' => $department->id])}}" class="btn btn-primary">Edit</a>
                @else
                    <a href="{{route('view-add-guidelines', ['department_id' => $department->id])}}" class="btn btn-primary">Add</a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
@endsection