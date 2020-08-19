@extends('layouts.app')
@section('section')
    <div class="container py-3">
        <div class="py-4">
            <h2>Edit guideline for {{$department->name}}</h2>
        </div> 
        <form class="" action="{{route('edit-guideline-action')}}" method="POST" role="form">
            @csrf
            <input type="hidden" name="department_id" value="{{$department->id}}" />
            <div class="form-group form-group-default">
                <label>Name</label>
                <input type="text" name="name" value="{{$department->guideline->name}}" class="form-control">
            </div>
            <div class="form-group form-group-default">
                <label>Link</label>
                <input type="text" name="link"  value="{{$department->guideline->link}}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection