
<form method='POST' action="{{route('email-change')}}" class='margin-left'>
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div>
    E-mail:{{Auth::user()->email}}
    </div>
    <input type='text' name='newEmail'><input type='submit' value='Change E-mail'>
</form>
