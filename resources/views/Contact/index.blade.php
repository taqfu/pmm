@extends ('layouts.app')
@section ('content')
    @include ("Contact.create")
    @foreach ($contacts as $contact)
    <div>
        @include ("Contact.destroy")
        {{$contact->name}}
        <input type='button' id='show-create-contact-info{{$contact->id}}' class='show-button' value='New Info' />
        @include ("ContactInfo.create")
        @foreach($contact->infos as $contact_info)
            <div>{{var_dump($contact_info)}}</div>
        @endforeach
    </div>

    @endforeach
@endsection
