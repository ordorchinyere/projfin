@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
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
    <script>
        const submissionApp = new Vue({
            el: '#searchApp',
            data: {
                abstract: '',
                status: '',
                name: '',
            },
            methods: {
                handleSubmit: function(){
                    let url = '{{url()}';
                    console.log(url);
                },
            },
        });
    </script>
@endsection