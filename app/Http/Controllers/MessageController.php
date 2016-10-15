<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Message;
use Auth;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        var_dump($confirm_period, $check_in_period, date($mysql_timestamp), 
          $check_in_due);
        
/*
        $message = new Message;
        $message->user_id = Auth::user()->id;
        $message->activated_at = date($mysql_timestamp);
        $message->check_in_period = $check_in_period;
        $message->confirm_period = $confirm_period;
        $message->check_in_due = $check_in_due;
        $message->save();
*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
