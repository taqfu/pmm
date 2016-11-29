<div>
    We've haven't heard from you in a while. You have {{$num_of_messages}} 
    @if ($num_of_messages>1)
    messages
    @else
    message
    @endif
     that will eventually be sent out if we don't hear from you. The first message will be sent out in {{$num_of_days}} 
    @if ($num_of_days>1)
        days
    @else
        day
    @endif
 if you don't respond to the next {{substring($next_message->confirm_period, 0, 1)}} emails.Thanks!
</div>
<div>
    - 
    <a href="{{url('/')}}">
        Words Prevail
    </a>
</div>
