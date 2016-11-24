@extends ('layouts.app')

@section('content')
    <div class='row text-center lead'>
        <strong>Words Prevail</strong> lets you send out a message if something happens to you. 
    </div>
    @include ('auth.login')
    <div class='container'>
        <h3 class='row'>
            How It Works
        </h3>
        <div class='row'>
            You check in regularly and when you fail to do so, your e-mail will be sent. If you want us to send you a reminder before that (just in case!), we can do that too.
        </div>
    </div>
@endsection
