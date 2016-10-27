<form method="POST" action="{{route('contact.store')}}">
    {{csrf_field()}}
    {{method_field('delete')}}
    <input type='text' name='name' maxlength='255'/>
    <input type='submit' value='New Person' class='btn btn-default'/>
</form>
