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

        $caption = ($begin < $end) ? " ago" : " from now";
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
        if ($string=="" && $interval->s == 0){
            return "now";
        }
        if ($interval->y>0){
            $string  = $interval->y . " year";
        }




        $string = substr($string, 0, 2)=="1 "
          ? $string : $string . "s";

        return $string . $caption;
    }
?>
@include ("Message.create")
@forelse ($messages as $message)

    <div id='message-link{{$message->id}}' class='card mt-4
      @if ($message->sent_at!=null)
          message-link
      @else
          bg-light
      @endif
          container' style="width:25rem;">
        <div class='card-block'>

            <h2 class='card-title'>
                @if ($message->ref_type=="email")
                    E-mail
                @elseif ($message->ref_type=="public")
                    Public
                @endif
                - <span title="Created {{date('Y-m-d H:i:se', strtotime($message->created_at))}}">{{format_interval($message->created_at, "now")}}</span>
                @if ($message->sent_at!=null)
                    <span title = " Sent {{date('Y-m-d H:i:se', strtotime($message->sent_at))}} " class='float-right text-success' >
                        &#10003;
                    </span>

                @endif


            </h2>
            <h4 class='card-subtitle mb-2 text-muted mb-2 text-center'>
                @if ($message->ref_type=="email")
                    <?php $email = Email::find($message->ref_id) ?>
                    {{$email->send_to}}
                @elseif ($message->ref_type=="public" && $message->sent_at!=null)
                    <a href="{{route('message.show', ['id'=>$message->id])}}">{{route('message.show', ['id'=>$message->id])}}</a>
                @endif


            </h4>
            <div id="message-body{{$message->id}}" class='
              @if ($message->sent_at!=null)
                  hidden
              @endif
              '>


                  @if ($message->sent_at!=NULL)
                      <div class='card-text text-center border border-info p-3'>
                          @if ($message->ref_type=="email")
                              @include('Email.show', ['email'=>Email::find($message->ref_id)])
                          @elseif ($message->ref_type=="public")
                              {{$message->public_message}}
                          @endif
                      </div><div>
                          <small title="{{date('Y-m-d H:i:se', strtotime($message->sent_at))}}" class='pull-right'>Sent {{format_interval($message->sent_at, "now")}}</small>
                      </div>
                  @elseif ($message->sent_at==null)
                      <div class='text-center mt-3 mb-1' >
                          <form method="POST" action="{{route('message.update',['id'=>$message->id])}}" class='inline'>
                              {{csrf_field()}}
                              {{method_field('PUT')}}


                              @if ($message->activated_at==NULL)
                                  <a id='show-toggle-activation-button{{$message->id}}'
                                    class='show-toggle-activation-button' href="#">Inactive</a>

                                  <input type='hidden' name='updateFunction'
                                    value='activate' />
                                  <input type='submit' value='Activate'
                                    class='hide-toggle-activation-button btn btn-success hidden'
                                    id='hide-toggle-activation-button{{$message->id}}' />
                              @else
                                  <a id='show-toggle-activation-button{{$message->id}}'
                                    class='show-toggle-activation-button' href="#">Active</a>

                                  <input type='hidden' name='updateFunction' value='deactivate' />
                                  <input type='submit' value='Deactivate' class='hide-toggle-activation-button btn btn-warning hidden' id='hide-toggle-activation-button{{$message->id}}' />
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
                      </div>
                <div class='card-text text-center border border-info p-3 '>

                    @if ($message->ref_type=="email")
                        @include('Email.show', ['email'=>Email::find($message->ref_id)])
                    @elseif ($message->ref_type=="public")
                        {{$message->public_message}}
                    @endif

                </div>

                <div class='row mb-3'>
                    <input type='button' id='replace-message-link-with-edit-message-{{$message->id}}'
                      class='mx-4 replace-with pull-left btn btn-block
                      btn-info' value='Edit'  replace='message-link' with='edit-message'/>

                </div>
                <div class=' card-text text-muted'>

                        <div class='text-center'>
                        @if (substr($message->confirm_period, 0, 1)>1)
                            Will Confirm every

                            @if (substr($message->confirm_period, 1, 1)=="w")
                                Week
                            @else
                                Day
                            @endif
                            Up To
                            {{substr($message->confirm_period, 0, 1)}}
                                Times Before Sending
                        @elseif (substr($message->confirm_period, 0, 1)==1)
                            Will Give One
                            @if (substr($message->confirm_period, 1, 1)=="w")
                                Week
                            @else
                                Day
                            @endif
                            To Confirm Before Sending
                        @else
                            No Confirmation. Sent Immediately.
                        @endif
                        </div>
                        <div class='text-center'>
                            Next Check In Due
                            @if ($message->activated_at==NULL)
                                N/A
                            @else
                                <span
                                  title="{{date('m/d/y g:ie',
                                  User::local_time(Auth::user()->timezone,
                                    strtotime($message->check_in_due)))}}">
                                      {{format_interval($message->check_in_due, "now")}}
                                </span>

                            @endif
                        </div>
                      </div>
                    @endif
                </div>



            </div>
        </div>
    </div>



    @include('Message.edit')

@empty
    <div class='margin-left'>You have no messages.</div>
@endforelse
