@extends ('layouts.app')
@section ('content')
@if (isset($_GET['verified']) && $_GET['verified']==1)
        <div class='margin-left'><strong>
            Your email address has now been verified. 
            (<A href="{{route('root')}}" class='text-danger'>Remove</a>)
        </strong></div>
@endif

@if (count($errors)>0)
    @foreach ($errors->all() as $error)
        <div class='text-danger margin-left'>
            {{$error}}
        </div>
    @endforeach
@endif
    @if (Auth::user())
        @include('Message.create')
        @include ('Message.index')
    @endif
@endsection
