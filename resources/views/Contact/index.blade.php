@extends ('layouts.app')
@section ('content')
    @include ("Contact.create")
    @foreach ($contacts as $contact)
    <div>
        @include ("Contact.destroy")
        {{$contact->name}}
    </div>
    @endforeach
@endsection
