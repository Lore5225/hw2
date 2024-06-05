<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Utenti;
use Illuminate\Support\Facades\Log;

class PasswordResetController extends Controller
{
    public function viewReset()
    {
        $email = '';
        if (Session::has('userID')) {
            $userID = Session::get('userID');
            $user = Utenti::find($userID);
            if ($user) {
                $email = $user->email;
            }
        }
        return view('ForgotPassword', ['email' => $email]);
    }

    public function sendResetEmail(Request $request)
    {
        $email = $request->input('email');
        $token = Str::random(32);
        $passwordReset = new PasswordReset;
        $passwordReset->email = $email;
        $passwordReset->token = $token;
        $passwordReset->expiration_date = now()->addMinutes(15);
        $passwordReset->save();
        $resetLink = route('reset_password', ['token' => $token, 'email' => $email]);

        try {
            Mail::raw("Gentile cliente,\n\nPer reimpostare la tua password, utilizza il seguente link: $resetLink", function ($message) use ($email) {
                $message->from('tecnovagroup@gmail.com');
                $message->to($email)->subject('Reset Password');
            });
        } catch (\Exception $e) {
            return view('ConfirmPage', ['message' => 'Errore nell\'invio dell\'email di reset']);
        }
        session(['email_sent' => true]);
        return redirect()->route('ConfirmPage')->with('message', 'Email di reset inviata a: ' . $email . '!');
    }

    public function showResetPasswordForm(Request $request)
    {
        if (!$request->has('token') || !$request->has('email')) {
            return redirect('index');
        }

        $token = $request->input('token');
        $email = $request->input('email');

        $passwordReset = PasswordReset::where('email', $email)
            ->where('token', $token)
            ->where('expiration_date', '>', now())
            ->first();

        if (!$passwordReset) {
            return redirect('index');
        }

        if ($request->isMethod('get')) {
            return view('resetPassword', ['email' => $email, 'token' => $token]);
        } else
            return redirect('index');
    }

    public function resetPassword(Request $request)
    {
        $errors = [];
        $password = $request->input('password');
        $repeat_password = $request->input('password_confirmation');

        if ($password !== $repeat_password) {
            $errors[] = "Le password non corrispondono.";
        } else if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/', $password)) {
            $errors[] = "La password deve contenere almeno 8 caratteri, di cui almeno una maiuscola, una minuscola, un numero e un simbolo tra !@#$%^&*";
        }

        if (count($errors) > 0) {
            return redirect('reset_password')->withErrors($errors)->withInput();
        }

        $email = $request->input('email');
        $token = $request->input('token');
        $user = Utenti::where('email', $email)->first();

        if (!$user) {
            return redirect('index');
        }

        $passwordReset = PasswordReset::where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$passwordReset) {
            return redirect('index');
        }

        $user->password = Hash::make($password);
        $user->save();

        PasswordReset::where('email', $email)->delete();

        session(['email_sent' => true]);
        return redirect()->route('ConfirmPage')->with('message', "Gentile utente, la password associata all'email $email è stata aggiornata.");
    }
}
