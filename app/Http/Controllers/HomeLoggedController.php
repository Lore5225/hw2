<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class HomeLoggedController extends BaseController
{
    public function checkAuth()
    {
        if (!Session::has('userID')) {
            return redirect('index');
        }

        $username = Session::get('username');
        return view('indexlogged')->with('username', $username);;
    }
}
