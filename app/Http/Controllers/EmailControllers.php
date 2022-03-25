<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmailControllers extends Controller
{
    public function sendEmail()
    {
        $user = Session::get('user_id');
        $infor_user = User::where('user_id', $user)->first();

        $details = [
            'title' => 'Order code from GREEN',
            'body' => $infor_user->user_name,
        ];
        Mail::to($infor_user->user_email)->send(new SendEmail($details));
        return redirect('/');
    }
}
