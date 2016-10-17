<form method="POST" action="{{route('message.store')}}">
    @include ("Email.create")
    {{csrf_field()}}
    <div>How often do you want to check in for this message?</div>
    <div>
        Every
        <select name='checkInEvery'>
            @for($num=1;$num<9;$num++){
              <option value="{{$num}}">{{$num}}</option>
            @endfor
        </select>
        <input type='radio' name='checkInPeriod' value='day' />days
        <input type='radio' name='checkInPeriod' value='week' checked />weeks
    </div>
    <div>If you don't respond, how often should we contact you before sending this message?</div>
    <div>
        <input type='radio' name='confirmPeriod' value='immediately' checked /> Immediately
        <input type='radio' name='confirmPeriod' value='day' /> Every Day
        <input type='radio' name='confirmPeriod' value='week' /> Every Week
    </div>
    <div>How many times do you want us to try to contact you before we send out this message?
        <select name='confirmIterations'>
            @for($num=1;$num<9;$num++){
              <option value="{{$num}}">{{$num}}</option>
            @endfor
        </select>
    </div>
    <input type='submit' value='Create' />
</form>
