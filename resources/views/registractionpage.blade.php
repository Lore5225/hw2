

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href='LogAndRegistrationStyle.css'>
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet">
    <script src="{{ url('Registration.js') }}"defer></script>
</head>

<body>
    <div class="login-transition-left-to-right">
        <div id="login-wrap">
            <img src="{{ url('images/logo.jpeg') }}" id="logo-img" alt="">
            <h1>Effettua la Registrazione!</h1>

            @foreach($errors->all() as $error)
                <p class='query-error'>{{ $error }}</p>
            @endforeach

            <form name="login_form" method="post" id="form-style">
            @csrf
                <label for="username">Username</label>
                <input type="text" required name="username" id="username" class="input-style" placeholder="Inserisci Username">
                <div id="username-error" class="error-style"></div>

                <label for="email">Email</label>
                <input type="email" required name="email" id="email" class="input-style" placeholder="Inserisci Email">
                <div id="email-error" class="error-style"></div>

                <label for="password">Password</label>
                <div class="pswrd-wrap">
                    <input type="password" required name="password" id="password" class="input-style" placeholder="Inserisci Password">
                    <img src="{{ url('images/eye.png') }}"id="toggle-pswrd" alt="">
                </div>
                <div id="password-error" class="error-style"></div>

                <label for="repeat_password">Ripeti Password</label>
                <input type="password" required name="repeat_password" id="repeat_password" class="input-style" placeholder="Ripeti Password">
                <div id="repeat_password-error" class="error-style"></div>
                <input type="checkbox" name = "terms" required id="terms-checkbox">
                <label for="terms-checkbox">Accetto le condizioni di TecnovaGroup</label>
                <div id="terms-error" class="error-style"></div>

                <input type="submit" value="Registrati" id="send-button">
            </form>
            <a href="{{ url('loginpage') }}">Sei già registrato? Clicca qui!</a>
            <a href = "{{ url('ForgotPassword') }}"> Hai dimenticato la password? </a>
            <a href="{{ url('index') }}">Torna alla home...</a>
        </div>
    </div>
</body>
</html>
