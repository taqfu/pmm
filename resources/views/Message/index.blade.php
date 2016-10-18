<?php
    use App\Email;
?>
@extends ('layouts.app')
@section ('content')
@foreach ($messages as $message)
    <div>
        @if ($message->ref_type=="email")
            E-mail
        @endif
        -
        @if ($message->activated_at==NULL)
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
        - Due {{date("m/d/y g:i", strtotime($message->check_in_due))}} -
        @if (substr($message->check_in_period, 0, 1)>1)
            Confirm every

            @if (substr($message->check_in_period, 1, 1)=="w")
                Week
            @else
                Day
            @endif
            Up To
            {{substr($message->check_in_period, 0, 1)}}
                Times
        @elseif (substr($message->check_in_period, 0, 1)==1)
            1
            @if (substr($message->check_in_period, 1, 1)=="w")
                Week
            @else
                Day
            @endif
            To Confirm
        @endif
        <form method="POST" action="{{route('message.update',['id'=>$message->id])}}" style='display:inline'>
            {{csrf_field()}}
            {{method_field('PUT')}}
            @if ($message->activated_at!==NULL)
                <input type='hidden' name='updateFunction' value='deactivate' />
                <input type='submit' value='Deactivate' />
            @else
                <input type='hidden' name='updateFunction' value='activate' />
                <input type='submit' value='Activate' />
            @endif

        </form>
        @include ('Message.destroy')

    </div>
@if ($message->ref_type)
    @include('Email.show', ['email'=>Email::find($message->ref_id)])
@endif
@endforeach
@endsection
