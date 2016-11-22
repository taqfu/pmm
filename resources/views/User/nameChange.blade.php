
<form method='POST' action="{{route('name-change')}}" class='margin-left'>
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div>
    Name:{{Auth::user()->name}}
    </div>
    <input type='text' name='newName'><input type='submit' value='Change Name'>
</form>
