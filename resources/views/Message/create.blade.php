<div class='text-center'>
<input type='button' id='show-create-message' class="btn btn-primary btn-lg mb-4 show-button" style='font-size:30px;' value='New Message'/>
</div>
<form id='create-message' method="POST" action="{{route('message.store')}}" class=' hidden container mb-5'>
    <div class='inline'>
        {{csrf_field()}}
        <div class='form-check form-check-inline'>
            <input type='radio' id='email-message-type' name='messageType' class='form-check-input' value='email' checked/>
            <label for='email-message-type' class='form-check-label'>E-mail</label>
        </div>
        <div class='form-check form-check-inline'>
            <input type='radio' id='public-message-type' name='messageType' class='form-check-input' value='public' />
            <label for='public-message-type' class='form-check-label'>Public Message</label>
        </div>
        @include ("Email.create")
        <div id='public-message-input' class='hidden'>
            <label for="public-message">Message:</label>
            <textarea id='public-message' name='publicMessage'
              class='form-control' rows='6'></textarea>
        </div>
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
            <input type='submit' value='Submit' class='btn btn-primary btn-lg big-button' />
            <input type='button' id='cancel-create-message' class='cancel-button btn btn-primary btn-lg big-button' value='Cancel' />
        </div>
    </div>
</form>
