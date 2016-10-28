<form method="POST" action="{{route('ContactInfo.store')}}" id='create-contact-info{{$contact->id}}' class='create-contact-info hidden'>
    {{csrf_field()}}
    <input type='hidden' name='contactID' value='{{$contact->id}}' />
    <div class='row'>
        <div class='col-md-4'>
            <input type='radio' name='typeOrCustom' value='type' checked/>
            Type:
            <select name='type' class='form-control'>
                <option value='email' selected>E-mail</option>
            </select>
            <input type='radio' name='typeOrCustom' value='custom' />
            Custom:
            <input type='text' name='custom' class='form-control'/>

        </div>
    </div><div class='row'>
        <div class='col-md-4 '>
            Info:
            <input type='text' name='info' class='form-control'/>
        </div>
    </div><div class='row'>
        <div class='col-md-4 text-right'>
            <input type='button' id='cancel-create-contact-info{{$contact->id}}' 
              class='cancel-button btn btn-default' value='Cancel' />
            <input type='submit' value='New Info'  class='btn btn-default'/>
        </div>
    </div>
</form>
