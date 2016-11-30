<div>

    Hello. Because we haven't heard from you in a while, there  
    @if ($num_of_messages>1)
        are {{$num_of_messages}} messages
    @else
        is {{$num_of_messages}} message
    @endif
    that will eventually be sent out if we don't hear from you. 
    @if ($num_of_messages>1)
        Your first message 
    @else
        This message
    @endif
    will be sent out in {{$num_of_days}} 
    @if ($num_of_days>1)
        days
    @else
        day
    @endif
    if you don't check in.Thanks!
</div>
<div>
    - Words Prevail
</div>
<h3 style='text-align:center;font-weight:bold;'>
    <a href="{{url('/')}}">
        Check in at Words Prevail!

    </a>
</h3>
