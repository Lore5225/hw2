
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ url('LogAndRegistrationStyle.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300..700&display=swap" rel="stylesheet">
    <script src="{{ url('loginscript.js') }}"defer></script>
</head>

<body> 
    <div class="login-transition-left-to-right">
        <div id="login-wrap">
            <img src="{{ url('images/logo.jpeg') }}" id="logo-img" alt="">
            <h1>Effettua il Login</h1>
            @if($errors->any())
            @foreach($errors->all() as $error)
            <p class='query-error'>{{ $error }}</p>
            @endforeach
            @endif

            <form name="login_form" method="post" id="form-style">
            @csrf
                <label for="username">Username</label>
                <input type="text" required name="username" id="username" class="input-style" placeholder="Inserisci Username">
                <div id="username-error" class="error-style"></div>

                <label for="password">Password</label>
                <div class="pswrd-wrap">
                    <input type="password" required name="password" id="password" class="input-style" placeholder="Inserisci Password">
                    <img src="{{ url('images/eye.png') }}"id="toggle-pswrd" alt="">
                </div>
                <div id="password-error" class="error-style"></div>

                <input type="submit" value="Login" id="send-button">
            </form>
            <a href="{{ url('registractionpage') }}">Non hai un account? Clicca qui!</a>
            <a href = "{{ url('ForgotPassword') }}"> Hai dimenticato la password? </a>
            <a href="{{ url('index') }}">Torna alla home...</a>
        </div>
    </div>
</body>
</html>

