@extends ('layouts.app')

@section('content')
    
    <div class='text-center'>
        <img src='/logo.png' class='img-responsive' />
    </div>
    <div class='row text-center lead'>
        <strong>Words Prevail</strong> will send out a message if something happens to you. 
    </div>
    @include ('auth.login')
    <div class='container hidden'>
        <h3 class='row'><strong>
            How It Works
        </strong></h3>
        <div class='row'>
            You check in regularly and when you fail to do so, your e-mail will be sent. If you want us to send you a reminder before that (just in case!), we can do that too.
        </div>
    </div>
    <h3 class='footer navbar-fixed-bottom text-center'>
        <a href='' >More</a>
    </h3>
@endsection
