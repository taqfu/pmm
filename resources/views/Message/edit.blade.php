
<form method="POST" action="{{route('message.update', ['id'=>$message->id])}}" class='hidden' id='update-message-secondary'>
    {{csrf_field()}}
    {{method_field('PUT')}}
    @if ($message->ref_type=="email")
        @include ("Email.edit", ['id'=>$message->ref_id])
    @elseif ($message->ref_type=="public")
        <div id='public-message-input' class=''>
            <label for="public-message">Message:</label>
            <textarea id='public-message' name='publicMessage'
              class='form-control' rows='6'>
                {{$message->public_message}}
            </textarea>
        </div>
    @endif
    <input type='hidden' name='updateFunction' value='edit' />
    <div>How often do you want to check in for this message?</div>
    <div>
        Every
        <select name='checkInEvery'>
            @for($num=1;$num<9;$num++){
                <option value="{{$num}}"
                    @if (substr($message->check_in_period, 0, 1)==$num)
                        selected
                    @endif
                    >{{$num}}</option>
            @endfor
        </select>
        <input type='radio' name='checkInPeriod' value='day'
            @if (substr($message->check_in_period, 1, 1)=='d')
                checked
            @endif
            />days
        <input type='radio' name='checkInPeriod' value='week'
            @if (substr($message->check_in_period, 1, 1)=='w')
                checked
            @endif
            />weeks
    </div>
    <div>If you don't respond, how often should we contact you before sending this message?</div>
    <div>
        <input type='radio' name='confirmPeriod' value='immediately'
            @if ($message->confirm_period==0)
                checked
            @endif
            /> Immediately
        <input type='radio' name='confirmPeriod' value='day'
        @if (substr($message->confirm_period, 1, 1)=='d')
            checked
        @endif
        /> Every Day
        <input type='radio' name='confirmPeriod' value='week'
        @if (substr($message->confirm_period, 1, 1)=='w')
            checked
        @endif
        /> Every Week
    </div>
    <div>How many times do you want us to try to contact you before we send out this message?
        <select name='confirmIterations'>
            @for($num=1;$num<9;$num++){
              <option value="{{$num}}"
              @if ($message->confirm_period!=0 && substr($message->confirm_period, 0, 1)==$num)
                  selected
              @endif

              >{{$num}}</option>
            @endfor
        </select>
    </div>
    <input type='submit' value='Submit' class='btn btn-default'/>
    <input type='button' id='replace-secondary-update-message' class='replace-secondary-button btn btn-default' value='Cancel' />

</form>
