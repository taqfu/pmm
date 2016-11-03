@extends ('layouts.app')
@section ('content')
    @include ("Contact.create")
    @foreach ($contacts as $contact)
    <div>
        @include ("Contact.destroy")
        {{$contact->name}}
        <input type='button' id='show-create-contact-info{{$contact->id}}' class='show-button btn btn-link' value='[ New Info ]' />
        @include ("ContactInfo.create")
        @foreach($contact->infos($contact->id) as $contact_info)
            <div class='row'>
                <div class='col-md-1'>&nbsp;</div><div class='col-md-11'>
                    <strong>
                        @if($contact_info->type!=null)
                            {{$contact_info->type}}
                        @else
                            {{$contact_info->custom}}
                        @endif
                        :
                    </strong>
                    {{$contact_info->info}}
                </div>
            </div>
        @endforeach
    </div>

    @endforeach
@endsection
