@extends ('layouts.app')
@section ('content')
    @if (Auth::user())
        @include('Message.create')
        <hr>
        @include ('Message.index')
    @endif
@endsection
