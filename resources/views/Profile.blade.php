<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <script src="profile.js" defer></script>
    <title>Profilo</title>
</head>
<body>
    <div class="container">
        <nav>
            <button id="profile__information__button">Informazioni Profilo</button>
            <button id="order__information__button">Ordini</button>
            <a href="{{ url('index') }}"><button>Torna alla Home</button></a>
        </nav>
        <div class="profile-info">
            <h2>Informazioni Profilo</h2>
            <p>ID Utente: {{ $user->id }}</p>
            <p>Username: {{ $user->username }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Numero di Ordini: {{ $totalOrders }}</p>
            <a href="{{ url('ForgotPassword') }}"><button>Cambia Password</button></a>
        </div>

        <div class="orders-info hidden">
            <h2>Ordini</h2>
            @if($orders->count() > 0)
                <ul class="orders-list">
                    @foreach ($orders as $order)
                        <li>
                            <p>ID Ordine: {{ $order->id_ordine }}</p>
                            <p>Data: {{ $order->data_ordine }}</p>
                            <p>Nome: {{ $order->nome }}</p>
                            <p>Cognome: {{ $order->cognome }}</p>
                            <p>Indirizzo: {{ $order->indirizzo }}</p>
                            <p>Codice Postale: {{ $order->codice_postale }}</p>
                            <p>Numero di Telefono: {{ $order->numero_telefono }}</p>
                            <p>Note: {{ $order->note }}</p>
                            <button class="order-details-button">Dettagli ordine</button>
                            <div class="order__text">
                                @foreach ($order->ordiniProdotti as $ordineProdotto)
                                <div class="order__item">
                                        <p>Prodotto: {{ $ordineProdotto->prodotto->nome }}</p>
                                        <p>Quantità: {{ $ordineProdotto->quantità }}</p>
                                        <p>Prezzo Totale: {{ $ordineProdotto->prezzo_totale }}</p>
                                </div>
                                @endforeach
</div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Non hai effettuato ordini.</p>
            @endif
        </div>
    </div>
</body>
</html>
