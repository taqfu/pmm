@extends ('layouts.app')
@section ('content')
@if (Auth::user())
    @include('Message.create')
@endif
@endsection
