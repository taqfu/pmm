<?php
    use App\Email;
?>
@foreach ($messages as $message)
    <div>
        @if ($message->ref_type=="email")
            E-mail
        @endif            
        - 
        @if ($message->actived_at==null)
            Inactive
        @else   
            Activated 
            {{date("m/d/y g:i", strtotime($message->activated_at))}}
        @endif        
        - Check In Every 
        @if(substr($message->check_in_period, 0, 1)==1)
            @if (substr($message->check_in_period, 1, 1)=="w")
                Week
            @else
                Day
            @endif

        @else
            {{substr($message->check_in_period, 0, 1)}} 
            @if (substr($message->check_in_period, 1, 1)=="w")
                Weeks
            @else
                Days
            @endif
        @endif
        - Due {{date("m/d/y g:i", strtotime($message->check_in_due))}}
        @if (substr($message->check_in_period, 0, 1)>0)
            <div><i>
            If you fail to check in, we'll contact you every 

            @if (substr($message->check_in_period, 1, 1)=="w")
                week
            @else
                day
            @endif
            up to 
            {{substr($message->check_in_period, 0, 1)}} 
            @if (substr($message->check_in_period, 0, 1)>1)
                times
            @else
                time
            @endif
             before sending the message out.
            </i></div>
        @endif 

    </div>
@if ($message->ref_type)
    @include('Email.show', ['email'=>Email::find($message->ref_id)])
@endif
@endforeach

