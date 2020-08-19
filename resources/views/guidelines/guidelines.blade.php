@extends('layouts.app')
@section('section')
    <div class="containers px-5">
        <div class="py-5">
            <h2>Final Year Project Guidelines</h2>
        </div>
    </div>
    <div class="containers px-5">
        <div class="row justify-content-center py-5">
            <div class="col-10 text-center">
                <h2>Colleges</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($colleges as $college)
                <div class="col-3">
                    <div class="border text-center p-2 college-list d-flex align-items-center justify-content-center">
                        <h5>{{$college->name}}</h5>
                    </div>
                    <div class="card card-default" style="height: 320px;">
                        <div class="card-header text-center">
                            <div class="card-title">
                                Departments
                            </div>
                        </div>
                        <div class="card-block scrollable">
                            <div class="p-2" style="max-height:250px">
                                @foreach ($college->departments as $department)
                                    <div class="mb-1">
                                        <a download target="_blank" href="{{$department->guideline->link}}">{{$department->name}}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
