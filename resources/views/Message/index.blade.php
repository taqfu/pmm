<?php
    use App\Email;
    use App\User;
    function format_interval($begin, $end){
        $begin = new DateTime($begin);
        if ($end == "now"){
            $end = new DateTime(date('y-m-d H:i:s'));
        } else {
            $end = new DateTime($end);
        }
        $interval = $end->diff($begin);
        $string="";
        if ($interval->s>0){
            $string  = $interval->s . " second";
        }
        if ($interval->i>0){
            $string  = $interval->i . " minute";
        }
        if ($interval->h>0){
            $string  = $interval->h . " hour";
        }
        if ($interval->d>0){
            $string  = $interval->d . " day";
        }
        if ($interval->m>0){
            $string  = $interval->m . " month";
        }

        if ($interval->y>0){
            $string  = $interval->y . " year";
        }




        $string = substr($string, 0, 2)=="1 " ? $string : $string . "s";
        return $string . " ago";
    }
?>

@forelse ($messages as $message)
<!--
    <div id='update-message-primary' class='
      @if ($message->sent_at!=null)
      @elseif ($message->sent_at==null && $message->activated_at==NULL)
          bg-warning
      @else
          bg-info
      @endif
      '>
    -->
    <div class='message-link card container-fluid'>
        <div class='card-body'>
            <div class='col-lg-3 card-title'>
                @if ($message->ref_type=="email")
                    <?php $email = Email::find($message->ref_id) ?>
                    <strong>E-mail</strong> ({{$email->send_to}})
                @endif
            </div>
            <div class='col-lg-9 card-subtitle'>
               <span title="{{date('Y-m-d H:i:se', strtotime($message->created_at))}}">Created {{format_interval($message->created_at, "now")}}</span> -


                @if ($message->sent_at!=NULL)
                    <span title="{{date('Y-m-d H:i:se', strtotime($message->sent_at))}}">Sent {{format_interval($message->sent_at, "now")}}</span>
                @elseif ($message->sent_at==null)
                    <form method="POST" action="{{route('message.update',['id'=>$message->id])}}" class='inline'>
                        {{csrf_field()}}
                        {{method_field('PUT')}}


                        @if ($message->activated_at==NULL)
                            <span id='show-toggle-activation-button'><a href="#">Inactive</a></span>
                            <input type='hidden' name='updateFunction' value='activate' />
                            <input type='submit' value='Activate' class='btn btn-primary hidden' id='hide-toggle-activation-button' />
                        @else
                            <span id='show-toggle-activation-button'><a href="#">Active</a></span>
                            <input type='hidden' name='updateFunction' value='deactivate' />
                            <input type='submit' value='Deactivate' class='btn btn-primary hidden' id='hide-toggle-activation-button' />
                        @endif
                    </form>
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
                        {{date('m/d/y g:i',
                          User::local_time(Auth::user()->timezone, strtotime($message->check_in_due)))}}
                    @endif

                    @if (substr($message->confirm_period, 0, 1)>1)
                        -
                        Confirm every

                        @if (substr($message->confirm_period, 1, 1)=="w")
                            Week
                        @else
                            Day
                        @endif
                        Up To
                        {{substr($message->confirm_period, 0, 1)}}
                            Times Before Sending Message
                    @elseif (substr($message->confirm_period, 0, 1)==1)
                        -
                        1
                        @if (substr($message->confirm_period, 1, 1)=="w")
                            Week
                        @else
                            Day
                        @endif
                        To Confirm

                    @endif
                    @include ('Message.destroy')
                    <input type='button' id='replace-primary-update-message' class='replace-primary-button btn btn-default' value='Edit' />
                @endif
            </div>
            <div class='card-text'>
                @if ($message->ref_type)
                    @include('Email.show', ['email'=>Email::find($message->ref_id)])
                @endif
            </div>
        </div>
    </div>

<!--

    @include('Message.edit')
-->
@empty
    <div class='margin-left'>You have no messages.</div>
@endforelse
