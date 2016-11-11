@extends ('layouts.app')
@section ('content')

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
