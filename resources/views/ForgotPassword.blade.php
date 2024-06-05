<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="LogAndRegistrationStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet">
    <script src="ForgotPassword.js" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="login-transition-left-to-right">
        <div id="login-wrap">
            <img src="images/logo.jpeg" id="logo-img" alt="">
            <h1>Inserisci l'email dell'account</h1>
            <h1>Ti manderemo un'email di reset della password</h1>
            <form name="login_form" method="post" action="{{ route('sendResetEmail') }}" id="form-style">
                @csrf
                <label for="email">Email</label>
                <input type="email" required name="email" id="email" value="{{ $email }}" class="input-style" placeholder="Inserisci Email">
                <div id="email-error" class="error-style"></div>
                <input type="submit" value="Invia" id="send-button">
            </form>
            <a href="{{ url('index') }}">Torna alla home...</a>
        </div>
    </div>
</body>

</html>