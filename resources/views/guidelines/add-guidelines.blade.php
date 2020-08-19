@extends('layouts.app')
@section('section')
    <div class="container py-3">
        <div class="py-4">
            <h2>Add guideline for {{$department->name}}</h2>
        </div> 
        <form class="" action="{{route('add-guideline-action')}}" method="POST" role="form">
            @csrf
            <input type="hidden" name="department_id" value="{{$department->id}}" />
            <div class="form-group form-group-default">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group form-group-default">
                <label>Link</label>
                <input type="text" name="link" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection