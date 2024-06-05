<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class ConfirmEmailController extends BaseController
{
    public function ConfirmationEmail()
    {
        if (!Session::get('email_sent')) {
            return redirect('index');
        }

        Session::forget('email_sent');

        return view('ConfirmPage', ['message' => session('message')]);
    }
}
