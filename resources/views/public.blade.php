@extends ('layouts.app')

@section('content')

    <div class='text-center'>
        <img src='/logo.png' class='img-responsive center-block' />
    </div>
    <div id='public-primary' class='container text-center'>
        <div class='lead'>
            <strong>Words Prevail</strong> will send a message if something happens to you.
        </div>
        @include ('auth.login')
        <h3 class='footer navbar-fixed-bottom text-center'>
            <a href='#' id='replace-primary-public' class='replace-primary-button'>More</a>
        </h3>
    </div>

    <div id='public-secondary' class='container hidden'>
        @include ('auth.login')
        <div >
            <h3 class='row'><strong>
                How It Works
            </strong></h3>
            <div class='row'>
                You check in regularly. When you don't check in and don't respond to our follow up emails, your e-mail will be sent.
            </div>
        </div>
        <h3 class='footer navbar-fixed-bottom text-center'>
            <a href='#' id='replace-secondary-public' class='replace-secondary-button'>
                Back
            </a>
        </h3>
    </div>

@endsection
