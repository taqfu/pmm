<div class='text-center'>
<input type='button' id='show-create-message' class="btn btn-primary btn-lg mb-4 show-button" style='font-size:30px;' value='New Message'/>
</div>
<form id='create-message' method="POST" action="{{route('message.store')}}" class=' hidden container mb-5'>
    <div class='inline'>
        {{csrf_field()}}
        <input type='hidden' name='messageType' value='email' />
        @include ("Email.create")

        <div class='create-message-caption'>How often do you want to check in for this message?</div>
        <div class='create-message-answers mb-2'>
            Every
            <select name='checkInEvery'>
                @for($num=1;$num<9;$num++){
                  <option value="{{$num}}">{{$num}}</option>
                @endfor
            </select>
            <input type='radio' name='checkInPeriod' value='day' checked />day<span class='plural hidden'>s</span>
            <input type='radio' name='checkInPeriod' value='week'/>week<span class='plural hidden'>s</span>
        </div>
        <div class='create-message-caption'>If you don't respond, how often should we contact you before sending this message?</div>
        <div  class='create-message-answers mb-2'>
            <input type='radio' name='confirmPeriod' value='immediately' checked /> Immediately
            <input type='radio' name='confirmPeriod' value='day' /> Every Day
            <input type='radio' name='confirmPeriod' value='week' /> Every Week
        </div>
        <div id='confirm-iterations' class='create-message-caption mb-4 hidden'>How many times do you want us to try to contact you before we send out this message?
            <select name='confirmIterations'>
                @for($num=1;$num<9;$num++){
                  <option value="{{$num}}">{{$num}}</option>
                @endfor
            </select>
        </div>
        <div class='form-group-row text-center'>
            <input type='submit' value='Submit' class='btn btn-primary btn-lg' style="font-size:30px;"/>
            <input type='button' id='cancel-create-message' class='cancel-button btn btn-primary btn-lg' value='Cancel' style="font-size:30px;"/>
        </div>
    </div>
</form>
