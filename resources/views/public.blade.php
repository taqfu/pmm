@extends ('layouts.app')

@section('content')
    <div class="middle-container">
        <div id='logo' class='text-center title' >
            Words Prevail
        </div>
        <div id='about' class='hidden'>
                @include ('about')
        </div>
    </div>
    <div id='about-mobile' class='middle-container hidden'>
        @include ('about')
    </div>
    <div id='login-menu-primary' class='footer navbar-fixed-bottom text-center'>



        Log In Using:
        <a href="redirect/facebook">Facebook</a> /
        <a href="redirect/google">Google</a> /
        <a href='/login' id='replace-primary-login-menu' class='replace-primary-button' >E-mail</a>
    </div>
@endsection
      <!--

    -->
