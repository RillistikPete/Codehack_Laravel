<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class UserEmailController extends Controller
{
    //
    function index()
    {
        $user = Auth::user();
        return view('mail.sendMailToUser', compact('user'));
    }

    function send(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $data = array(
            'email'     =>  $request->email,
            'name'      =>  $request->name,
            'message'   =>   $request->message
        );
        $request->session()->flash('comment_message', 'Your message has been submitted and is awaiting moderation');
        return back();
    }

}
