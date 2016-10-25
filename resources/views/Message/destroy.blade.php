<form method="POST" action="{{route('message.destroy', ['id'=>$message->id])}}" id='delete-message{{$message->id}}'class='inline'>
    {{csrf_field()}}
    {{method_field('delete')}}
    <input type='submit' value='Delete' class='btn btn-default' />
</form>
