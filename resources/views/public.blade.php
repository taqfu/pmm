@extends ('layouts.app')

@section('content')

    <div class='text-center'>
        <img src='/logo.png' class='img-responsive center-block' />
    </div>
    <div id='public-primary' class='row text-center lead'>
        <strong>Words Prevail</strong> will send out a message if something happens to you.
        @include ('auth.login')
        <h3 class='footer navbar-fixed-bottom text-center'>
            <a href='#' id='replace-primary-public' class='replace-primary-button'>More</a>
        </h3>
    </div>

    <div id='public-secondary' class='container hidden'>
        @include ('auth.login')
        <h3 class='row'><strong>
            How It Works
        </strong></h3>
        <div class='row'>
            You check in regularly and when you fail to do so, your e-mail will be sent. If you want us to send you a reminder before that (just in case!), we can do that too.
        </div>
        <a href='#' id='replace-secondary-public' class='replace-secondary-button'>Back</a>
    </div>

@endsection
