<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href='LogAndRegistrationStyle.css'>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <script src="ResetPassword.js" defer></script>
</head>
<body>
    <div class="login-transition-left-to-right">
        <div id="login-wrap">
            <img src="images/logo.jpeg" id="logo-img" alt="">
            <h1>Inserisci le nuove credenziali.</h1>
            <form name="login_form" method="post" action="{{ route('ResetSubmit') }}" id="form-style">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">
                <label for="password">Password</label>
                <div class="pswrd-wrap">
                    <input type="password" required name="password" id="password" class="input-style" placeholder="Inserisci Password">
                    <img src="images/eye.png" id="toggle-pswrd" alt="">
                </div>
                <div id="password-error" class="error-style"></div>

                <label for="repeat_password">Ripeti Password</label>
                <input type="password" required name="password_confirmation" id="repeat_password" class="input-style" placeholder="Ripeti Password">
                <div id="repeat_password-error" class="error-style"></div>

                <input type="submit" value="Resetta" id="send-button">
            </form>
            <a href="{{ url('/CheckoutPage') }}">Torna alla home...</a>
        </div>
    </div>
</body>
</html>
