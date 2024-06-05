<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="confirm.css">
    <script src="confirm.js"></script>
    <title>Conferma Ordine</title>
</head>

<body>
    <div class="message-box">
        @if(session('message'))
        <h1>{{ session('message') }}</h1>
        @else
        <h1>Errore...</h1>
        @endif
        <p>Ti reindirizziamo alla home...</p>
    </div>
</body>


</html>