@include('layouts.header_wrapper')
  <body class="fixed-header ">
    <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
          <h1 class="semi-bold text-white">Projfin</h1>
          <p class="small">
            Final Year Project System
          </p>
        </div>
        <!-- END Background Caption-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 p-r-50 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
          <img src="{{asset('images/logololo.png')}}" alt="logo" style="width: 129px; height: 70px; margin-left: -31px;">
          <h2 class="p-t-25">Get Started <br/> with Projfin</h2>
          <p class="mw-80 m-t-5">Sign in to your account</p>
          <!-- START Login Form -->
          <form id="form-login" class="p-t-15" role="form" method="POST" action="{{route('login')}}">
            @csrf
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Email</label>
              <div class="controls">
                <input type="text" name="email" class="form-control" required>
              </div>
            </div>
            @error('email')
              <label id="email-error" class="error" for="email">{{$message}}</label>
            @enderror
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Password</label>
              <div class="controls">
                <input type="password" class="form-control" name="password" required>
              </div>
            </div>
            <!-- START Form Control-->
            <div class="row">
              <div class="col-md-6 no-padding sm-p-l-10">
                <div class="checkbox ">
                  <input type="checkbox" value="1" id="checkbox1">
                  <label for="checkbox1">Remember me</label>
                </div>
              </div>
              <div class="col-md-6 d-flex align-items-center justify-content-end">
                <button aria-label="" class="btn btn-primary btn-lg m-t-10" type="submit">Sign in</button>
              </div>
            </div>
            <div class="m-b-5 m-t-30">
              {{-- <a href="#" class="normal">Lost your password?</a> --}}
            </div>
            <div>
            <a href="{{route('register')}}" class="normal">Not a member yet? Signup now.</a>
            </div>
            <!-- END Form Control-->
          </form>
          <!--END Login Form-->
          @include('layouts.auth_footer_wrapper')
        </div>
      </div>
      <!-- END Login Right Container-->
    </div>
  </body>
</html>