<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\userRequestMail;

class UserEmailController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        return view('mail.sendMailToUser', compact('user'));
    }

    public function send(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            //'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $data = array(
            'email'     =>  $request->email,
            //'name'      =>  $request->name,
            'message'   =>   $request->message
        );
        //$userName = $data->name;
        // $userEmail = $data->email;
        // $userMsg = $data->message;

        // Mail::send('mail.emailBody', $data, function($message) use ($userName, $userMsg) {
        //     $message->to($userEmail, $userName)
        //             ->subject('Request for author role - fPK Faculty');
        //     $message->from('FROM_EMAIL_ADDRESS','Code Faculty');
        // });
        Mail::to($request->email)->send(new userRequestMail($data));
        $request->session()->flash('email_message', 'Your email has been submitted and is awaiting reply');
        return view('mail.sendMailToUser', compact('user'));
    }

}
