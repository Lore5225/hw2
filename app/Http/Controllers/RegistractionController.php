<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use App\Models\Utenti;

class RegistractionController extends BaseController
{
    public function checkAuth()
    {
        if (Session::has('userID')) {
            return redirect('index');
        }
        return view('registractionpage');
    }

    public function Signup()
    {
        if(!empty(Request::post('username')) && !empty(Request::post('email')) && !empty(Request::post('password')) && !empty(Request::post('repeat_password')) && !empty(Request::post('repeat_password')) && !empty(Request::post('terms')))
        {
            $errors = array();
            $password = Request::post('password');
            $repeat_password = Request::post('repeat_password');
        
            if ($password !== $repeat_password) {
                $errors[] = "Le password non corrispondono.";
            } 
            else if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/', $password)) {
                    $errors[] = "La password deve contenere almeno 8 caratteri, di cui almeno una maiuscola, una minuscola, un numero e un simbolo tra !@#$%^&*";
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errors[] = "E-mail non valida!";
            } else if (!isset($_POST["terms"])) {
                $errors[] = "Devi accettare le condizioni per procedere.";
            }

            if (count($errors) == 0) {
                $password = password_hash(Request::get('password'), PASSWORD_BCRYPT);
    
                $user = new Utenti;
                $user->username = Request::get('username');
                $user->password = $password;
                $user->email = Request::get('email');
                $user->save();
                Session::put('userID', $user->id); 
                Session::put('username', $user->username);
                return redirect('index');
            }

        }else $errors[] = "Tutti i campi sono obbligatori.";

        return redirect('registractionpage')->withInput()->withErrors($errors);
    }


    public function CheckIfExists($field)
    {
        if(empty(Request::get('q'))) {
            return response()->json(['exists' => false]);
        }
        if(!in_array($field, ['username', 'email'])) {
            return response()->json(['exists' => false]);
        }

        $user = Utenti::where($field, Request::get('q'))->first();
        return response()->json(['exists' => $user ? true : false]);
    }

}
