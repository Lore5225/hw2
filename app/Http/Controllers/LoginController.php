<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use App\Models\Utenti;

class LoginController extends BaseController
{
    public function checkAuth()
    {
        if (Session::has('userID')) {
            return redirect('index');
        }
        return view('loginpage');
    }

   public function login()
   {
    $errors = [];

    if(!empty(Request::post('username')) && !empty(Request::post('password')))
    {
        $username_or_email = Request::post('username');
        if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
            $user = Utenti::where('email', Request::post('username'))->first();
        } else {
            $user = Utenti::where('username', Request::post('username'))->first();
        } 
        
        if($user){
            if(!password_verify(Request::post('password'), $user->password))
            {
                $errors[] = "Errore, password errata";
            }
        } else {
            $errors[] = "Errore, email o username non trovati";
        }
    } else {
        $errors[] = "Tutti i campi sono obbligatori.";
    }

    if(count($errors) == 0){
        Session::put('userID', $user->id);
        Session::put('username', $user->username);
        return redirect('index');
    } else {
        return redirect('loginpage')->withInput()->withErrors($errors);
    }
    
}
}
