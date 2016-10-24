<?php
    use App\Email;
?>

@forelse ($messages as $message)
    <div id='update-message-primary' class='well'>
        <div class=''>
            @if ($message->ref_type=="email")
                <strong>E-mail</strong>
            @endif
            - Created {{date("m/d/y g:i", strtotime($message->created_at))}} -
            @if ($message->activated_at==NULL)
                Inactive
            @else
                Active
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
            - Due
            @if ($message->activated_at==NULL)
                N/A
            @else
                {{date("m/d/y g:i", strtotime($message->check_in_due))}}
            @endif
            -
            @if (substr($message->confirm_period, 0, 1)>1)
                Confirm every

                @if (substr($message->confirm_period, 1, 1)=="w")
                    Week
                @else
                    Day
                @endif
                Up To
                {{substr($message->confirm_period, 0, 1)}}
                    Times
            @elseif (substr($message->confirm_period, 0, 1)==1)
                1
                @if (substr($message->confirm_period, 1, 1)=="w")
                    Week
                @else
                    Day
                @endif
                To Confirm

            @endif
            @include ('Message.destroy')
            <form method="POST" action="{{route('message.update',['id'=>$message->id])}}" class='inline'>
                {{csrf_field()}}
                {{method_field('PUT')}}
                @if ($message->activated_at!==NULL)
                    <input type='hidden' name='updateFunction' value='deactivate' />
                    <input type='submit' value='Deactivate' />
                @else
                    <input type='hidden' name='updateFunction' value='activate' />
                    <input type='submit' value='Activate' class='btn btn-default'/>
                @endif

            </form>

            <input type='button' id='replace-primary-update-message' class='replace-primary-button' value='Edit' class='btn btn-default'/>
        </div>
        @if ($message->ref_type)
            @include('Email.show', ['email'=>Email::find($message->ref_id)])
        @endif
    </div>
        @include('Message.edit')
@empty
    You have no messages.
@endforelse
