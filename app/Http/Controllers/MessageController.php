<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Confirmation;
use App\Email;
use App\Message;
use Auth;
use Mail;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mysql_timestamp = 'Y-m-d H:i:s';
        if (Auth::guest()){
            return back()->withErrors("You must logged in in order to do this.");
        }

        if ($request->checkInEvery>8 || $request->checkInEvery<1
          || ($request->messageType!="email" && $request->messageType!="public")){
            return back()->withErrors("Error Code ?");
        }
        $check_in_period = $request->checkInEvery . substr($request->checkInPeriod,0,1);

        if (substr($request->checkInPeriod,0,1)=="w"){
            $check_in_due =
              date($mysql_timestamp,
              strtotime('+' . $request->checkInEvery . 'week', time()));
        } else if (substr($request->checkInPeriod,0,1)=="d"){
            $check_in_due =
              date($mysql_timestamp,
              strtotime('+' . $request->checkInEvery . ' day', time()));
        } else {
            return back()->withErrors("Error Code ?");
        }

        if ($request->confirmPeriod=="immediately"){
            $confirm_period = 0;
        } else if (substr($request->confirmPeriod, 0, 1)=="d" || substr($request->confirmPeriod, 0, 1)=="w" ){
            $confirm_period = $request->confirmIterations . substr($request->confirmPeriod, 0, 1);
        } else {
            return back()->withErrors("Error Code ?");
        }
        if ($request->messageType=="email"){
            if (Message::email_already_active(trim($request->emailSendTo))){
                return back()->withErrors("There is already an active email being sent to that email address. Sign up for premium membership to be able to do this!");
            }

            $email = new Email;
            $email->user_id = Auth::user()->id;
            $email->body = $request->emailBody;
            $email->send_to = trim($request->emailSendTo);
            $email->save();
        }
        $message = new Message;
        $message->user_id = Auth::user()->id;
        $message->activated_at = date($mysql_timestamp);
        $message->check_in_period = $check_in_period;
        $message->confirm_period = $confirm_period;
        $message->check_in_due = $check_in_due;
        $message->ref_type = $request->messageType;

        if ($request->messageType=="email"){
            $message->ref_id = $email->id;
        }  if ($request->messageType=="public"){
            $message->public_message = $request->publicMessage;
        }
        $message->save();
        $confirmation = new Confirmation;
        $confirmation->message_id = $message->id;
        $confirmation->iteration=0;
        $confirmation->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);

        if ($message==null || $message->ref_type != "public"){
            return "Sorry. There's nothing here.";
        }
        if ($message->ref_type == "public" && $message->sent_at == null){
            return "Sorry. There's nothing here. Yet.";
        }

        return view ("Message.show", ['message'=>$message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = Message::find($id);
        if ($request->updateFunction=="activate"){
            $message->activated_at=date('Y-m-d H:i:s');
        } else if ($request->updateFunction=="deactivate"){
            $message->activated_at=null;
        } else if ($request->updateFunction=="edit"){
            $mysql_timestamp = 'Y-m-d H:i:s';
            $check_in_period = $request->checkInEvery . substr($request->checkInPeriod,0,1);
            if (substr($request->checkInPeriod,0,1)=="w"){
                $check_in_due =
                  date($mysql_timestamp,
                  strtotime('+' . $request->checkInEvery . 'week', time()));
            } else if (substr($request->checkInPeriod,0,1)=="d"){
                $check_in_due =
                  date($mysql_timestamp,
                  strtotime('+' . $request->checkInEvery . ' day', time()));
            }
            if ($request->confirmPeriod=="immediately"){
                $confirm_period = 0;
            } else {
                $confirm_period = $request->confirmIterations . substr($request->confirmPeriod, 0, 1);
            }

            $email = Email::find($request->emailID);
            $email->body = $request->emailBody;
            $email->send_to = $request->emailSendTo;
            $email->save();

            $message->check_in_period = $check_in_period;
            $message->confirm_period = $confirm_period;
            $message->check_in_due = $check_in_due;
            $message->ref_type = "email";
            $message->ref_id = $email->id;

        }
        $message->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::destroy($id);
        return back();
    }
}
