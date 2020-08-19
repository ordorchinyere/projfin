@php 
  $user = Auth::user();
  $colleges = App\College::get();
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Projfin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Meet pages - The simplest and fastest way to build web UI for your dashboard or app." name="description" />
    <meta content="Ace" name="author" />
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link class="main-stylesheet" href="{{asset('css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css" />
    @yield('styles')
    <style>
      .dropdown-menu.show {
        transform: translate3d(3px, 36px, 0px) !important;
      }
    </style>
  </head>
  <body class="d-flex flex-column">
  <div class="header" style="padding-top: 39px; padding-bottom: 42px;">
    <a href="/home">
      <div class="brand inline bold fs-16 py-3">
        <img src="{{asset('images/logololo.png')}}" alt="logo" style="width: 129px; height: 60px; margin-left: -3w1px;">
        Projfin
      </div>
    </a>
    <div class="d-flex align-items-center">
      <a class="mr-3" href="{{route('user-profile')}}">Profile</a>
      <ul class="navbar-nav mr-3">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Colleges
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('college', ['id' => $colleges[0]->id])}}">College of Business and Social Sciences</a>
            <a class="dropdown-item" href="{{route('college', ['id' => $colleges[1]->id])}}">College of Engineering</a>
            <a class="dropdown-item" href="{{route('college', ['id' => $colleges[2]->id])}}">College of Leadership and Development Studies</a>
            <a class="dropdown-item" href="{{route('college', ['id' => $colleges[3]->id])}}">College of Science and Technology</a>
          </div>
        </li>
      </ul>
      <a class="mr-3" href="{{route('guidelines')}}">Guidelines</a>
      @if($user->user_type === 'super_admin')
        <a class="mr-3" href="{{route('view-guidelines-list')}}">Change guidelines links</a>
        <a class="mr-3" href="{{route('change-user-type')}}">Change User Type</a>
        <a class="mr-3" href="{{route('project-submission')}}">View Submitted Projects</a>
        @if($user->project)
          <a href="{{route('user-profile')}}#projectsection" class="btn btn-primary">
            View Project Submission
          </a>
        @else
          <a href="{{route('add-project')}}" class="btn btn-primary">
            Add Project Submission
          </a>
        @endif
      @elseif ($user->final_year)
        @if($user->project)
          <a href="{{route('user-profile')}}#projectsection" class="btn btn-primary">
            View Project Submission
          </a>
        @else
          <a href="{{route('add-project')}}" class="btn btn-primary">
            Add Project Submission
          </a>
        @endif
      @endif
      <a class="ml-3" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </div>
    </div>
  </div>
  <div class="page-content-wrapper" style="flex: 1">
    <div class="content">
        @yield('section')
    </div>
  </div>
  <div class=" container-fluid  container-fixed-lg footer">
    <div class="copyright sm-text-center">
      <p class="small-text no-margin pull-left sm-pull-reset">
        ©2020 All Rights Reserved. <a href="https://github.com/nancyordor" target="_blank">@nancyordor</a>
      </p>
      <p class="small no-margin pull-right sm-pull-reset">
        {{-- Hand-crafted <span class="hint-text">&amp; made with Love</span> --}}
      </p>
      <div class="clearfix"></div>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@yield('scripts')
  </body>
</html>