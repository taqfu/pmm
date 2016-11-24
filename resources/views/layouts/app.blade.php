<?php
    $site_root =
      $_SERVER['SERVER_NAME']=="taqfu.com"
      ? "http://taqfu.com/dev-env/pmm/public/"
      : $_SERVER['SERVER_NAME'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} </title>

    <!-- Styles -->
    <link href="{{$site_root}}/css/app.css" rel="stylesheet">
    <link href="{{$site_root}}/css/css.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
                        @if (Auth::user())
                                <a href="{{route('user.settings')}}">
                                    {{ Auth::user()->name }}
                                </a> -
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class='inline'>
                                    {{ csrf_field() }}
                                    <input type='submit' class='btn-link' value='Logout' />
                                </form>
                        @endif
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{$site_root}}/js/app.js"></script>
    <script src="{{$site_root}}/js/js.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '203969600049244',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>
