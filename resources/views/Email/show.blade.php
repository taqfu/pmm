<div class='panel panel-default' style='padding: 20px;'>
    <div>
        To:
        <i>{{$email->send_to}}</i>
        <input type='button' value='[ + ]' id='expose-email-body{{$email->id}}' 
          class='expose-button btn btn-link' />
        <input type='button' value='[ - ]' id='cover-email-body{{$email->id}}' 
          class='cover-button hidden btn btn-link' />
    </div>
    <div id='email-body{{$email->id}}-cover' >
        <i>...</i>
    </div>
    <div id='email-body{{$email->id}}' class='hidden'>
        Body:
        <i>
            {{$email->body}}
        </i>
    </div>
</div>
