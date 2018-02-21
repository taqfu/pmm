@extends ('layouts.app')

@section('content')
    <div id="middle-container">
        <div id='logo' class='text-center title' >
            Words Prevail
        </div>
        <div id='about' class='hidden'>
                @include ('about')
        </div>
    </div>
    <div id='about-mobile' class='hidden'>
        @include ('about')
    </div>
    @include ('auth.login')

@endsection
      <!--

    -->
