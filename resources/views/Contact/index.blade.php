@extends ('layouts.app')
@section ('content')
    @include ("Contact.create")
    @foreach ($contacts as $contact)
    <div>
        {{$contact->name}}
        @include ("Contact.destroy")
    </div>
    @endforeach
@endsection
