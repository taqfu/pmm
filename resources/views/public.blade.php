@extends ('layouts.app')

@section('content')

    <div class='text-center'>
        <img src='/logo.png' class='img-responsive center-block' />
    </div>
    <div id='public-primary' class='container text-center'>
        <div class='lead'>
            <strong>Words Prevail</strong> will send out message if something happens to you.
        </div>
        <h3 class='footer navbar-fixed-bottom text-center'>
            <a href='#' id='replace-primary-public' class='replace-primary-button'>More</a>
        </h3>
    </div>
        @include ('auth.login')

    <div id='public-secondary' class='container hidden'>
        <div >
            <h1 class='row text-center'><strong>
                How It Works
            </strong></h1>
            <h2>Create your message.</h2>
            <ul>
            <li>
                For now, we just have e-mails available, but we're planning on expanding into other forms of communication. When you create your message, you specify how often you want to check in. Every day, every 2 days, every week, every 3 weeks, etc.
            </li>
            </ul>
            <h2>Check in.</h2>
            <div>
            <ul>
            <li>
                Once your message is created, you just need to check in by logging into the site. If you don't check in, it's not a problem. We can confirm with you before sending out the message in case you don't check in.
            </div>
            </li>
            </ul>
            <h2>Know your message will be sent.</h2>
            <div >
            <ul>
            <li>
                In the event that something happens to you, your message will go where it needs to.
            </li>
            </ul>
        </div>
        <h3 class='footer navbar navbar-fixed-bottom text-center'>
            <a href='#' id='replace-secondary-public' class='replace-secondary-button'>
                Back
            </a>
        </h3>
    </div>

@endsection
