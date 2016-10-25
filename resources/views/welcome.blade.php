@extends ('layouts.app')
@section ('content')
    @if (Auth::user())
        @include('Message.create')
        @include ('Message.index')
    @endif
@endsection
