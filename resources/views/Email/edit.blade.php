<?php
    use App\Email;
    $email = Email::find($id);
 ?>
<div>To:</div>
<div>
    <input type='text' name='emailSendTo' maxlength='255' style='width:800px;' value='{{$email->send_to}}'/>
</div>
<div>Body:</div>
<div>
    <textarea name='emailBody' maxlength='20000' style='width:800px;height:200px;'>{{$email->body}}</textarea>
</div>
