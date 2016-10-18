<form method="POST" action="{{route('message.destroy', ['id'=>$message->id])}}">
    {{csrf_field()}}
    {{method_field('delete')}}
    <input type='submit' value='Delete' />
</form>
