<div id='edit-message{{$message->id}}' class='edit-message row hidden'>
    <div class='col-lg-3'></div>
    <form method="POST" action="{{route('message.update', ['id'=>$message->id])}}" class='col-lg-6 mx-2' >
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

        <label for='check-in-period'>How often do you want to check in for this message?</label>
        <div id='check-in-period' class='mb-3'>
            <label for='check-in-every'> Every</label>
            <select id='check-in-every' name='checkInEvery'>
                @for($num=1;$num<9;$num++){
                    <option value="{{$num}}"
                        @if (substr($message->check_in_period, 0, 1)==$num)
                            selected
                        @endif
                        >{{$num}}</option>
                @endfor
            </select>
            <div class='custom-control custom-radio custom-control-inline'>
                <input type='radio' id='check-in-day' name='checkInPeriod' class='custom-control-input' value='day'
                    @if (substr($message->check_in_period, 1, 1)=='d')
                        checked
                    @endif
                    />
                <label class='custom-control-label' for='check-in-day'>days</label>
            </div><div class='custom-control custom-radio custom-control-inline'>
                <input type='radio' id='check-in-week' name='checkInPeriod' class='custom-control-input' value='week'
                    @if (substr($message->check_in_period, 1, 1)=='w')
                        checked
                    @endif
                    />
                <label class='custom-control-label' for='check-in-week'>weeks</label>
            </div>
        </div>

        <label for='confirmation-period'>If you don't respond, how often should we contact you before sending this message?</label>
        <div id='confirmation-period' class='mb-3'>
            <div class='custom-control custom-radio custom-control-inline'>
                <input type='radio' id='confirm-immediately' name='confirmPeriod' class='custom-control-input' value='immediately'
                    @if ($message->confirm_period==0)
                        checked
                    @endif
                    />
                <label class='custom-control-label' for='confirm-immediately'> Immediately</label>
            </div><div class='custom-control custom-radio custom-control-inline'>
                <input type='radio' id='confirm-day' name='confirmPeriod' class='custom-control-input' value='day'
                @if (substr($message->confirm_period, 1, 1)=='d')
                    checked
                @endif
                />
                <label class='custom-control-label' for='confirm-day'>Every Day</label>

            </div><div class='custom-control custom-radio custom-control-inline'>
                <input type='radio' id='confirm-week' name='confirmPeriod' class='custom-control-input' value='week'
                @if (substr($message->confirm_period, 1, 1)=='w')
                    checked
                @endif
                />
                <label class='custom-control-label' for='confirm-week'> Every Week</label>
            </div>
        </div>
        <div class='mb-3'>
            <label for='confirm-iterations'>
                How many times do you want us to try to contact you before we
                send out this message?
            </label>
            <select id='confirm-iterations' name='confirmIterations' >
                @for($num=1;$num<9;$num++){
                  <option value="{{$num}}"
                  @if ($message->confirm_period!=0 && substr($message->confirm_period, 0, 1)==$num)
                      selected
                  @endif

                  >{{$num}}</option>
                @endfor
            </select>
        </div>
        <div class='form-group text-center'>
            <input type='submit' value='Update' class='btn btn-info btn-lg'/>
            <input id='replace-edit-message-with-message-link-{{$message->id}}'
              type='button' class='replace-with btn btn-info btn-lg' value='Cancel' />
        </div>
    </form>
    <div class='col-lg-3'></div>
</div>
