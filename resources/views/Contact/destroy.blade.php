<form method="POST" action="{{route('contact.destroy', ['id'=>$contact->id])}}" class='inline'>
    {{csrf_field()}}
    {{method_field('delete')}}
    <input type='submit' value='x' class='btn btn-danger' />
</form>
