<form method="POST" action="{{route('ContactInfo.store')}}" id='create-contact-info{{$contact->id}}' class='create-contact-info'>
    {{csrf_field()}}
    <input type='hidden' name='contactID' value='{{$contact->id}}' />
    <div class='inline'>
        <div>
            <input type='checkbox' name='typeOrCustom' value='type' />
            Type:
            <select name='type'>
                <option value='email' selected>E-mail</option>
            </select>
        </div><div>
            <input type='checkbox' name='typeOrCustom' value='custom' />
            Custom:<input type='text' name='custom' />
        </div>
    </div><div class='inline'>
        <input type='text' name='info' />
        <input type='submit' value='New Info' />
        <input type='button' id='cancel-create-contact-info{{$contact->id}}' class='cancel-button' value='Cancel' />
    </div>

</form>
