<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="ShoppingCart.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="ShoppingCart.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <title>ShoppingCart</title>
</head>

<body>
    <header>
        <nav>
            <a href="{{ url('index') }}"><img src="images/homeIcon.png" class="nav__icons" alt="Home"></a>
            <a href="{{ url('ShoppingPage') }}"><img src="images/shopping-cart.png" class="nav__icons" alt="Cart"></a>
        </nav>
    </header>
    <div class="cart__container">
        <div class="title__cart">
            <p>Carrello</p>
        </div>
        <div class="products__wrap">
            @if(empty($products))
            <h1>Nessun prodotto nel carrello</h1>
            @else
            @foreach ($products as $product)
            <div class="product__container" data-id="{{ $product->id }}">
                <div class="product__text">{{ $product->nome }}</div>
                <div class="img__product__wrapper"><img src="{{ $product->immagine }}" class="product__img" alt=""></div>
                <div class="quantity__container">
                    <img src="images/minusiconCart.ico" class="button__remove" alt="">
                    <div class="product__quantity">{{ $product->quantita_totale }}</div>
                    <img src="images/plusiconCart.ico" class="button__add" alt="">
                </div>
                <div class="product__tot__container">
                    <div class="product__total">Prezzo: € {{ $product->prezzo_totale }}</div>
                </div>
            </div>
            @endforeach
            @endif
            @if(!empty($products))
            <div class="cart__bottom">
                @php
                $totalPrice = 0;
                foreach ($products as $product) {
                $totalPrice += $product->prezzo_totale;
                }
                @endphp

                <p>Totale: €{{ $totalPrice }}</p>
                <a href="{{ url('/CheckoutPage') }}" class="link__checkout">
                    <button class="button__checkout">
                        Vai al checkout <img src="images/right-arrow-svgrepo-com.svg" alt="">
                    </button>
                </a>
            </div>
            @endif

        </div>


    </div>
    </div>
</body>

</html>