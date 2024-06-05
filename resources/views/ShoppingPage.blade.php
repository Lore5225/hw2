<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="{{ url('Shopping.js') }}" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('ShoppingStyle.css') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">
    <title>Shopping</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('index') }}"><img src="images/homeIcon.png" class="nav__icons" alt="Home"></a>
            <a href="{{ url('ShoppingCart') }}"><img src="images/shopping-cart.png" class="nav__icons" alt="Cart"></a>
        </nav>
    </header>
    <div class="container__grid">
        <div class="grid__products__container">
        @foreach ($products as $product)
            <div class="grid__item" data-id="{{ $product->id }}">

                <div class="img__product__wrapper">
                    <img src="{{ $product->immagine }}" class="img__product">
                </div>
                <button class="button__add__to__cart">Aggiungi al carrello</button>

            </div>
        @endforeach
    </div>
    </div>
    <div class="modal__container"></div>
    <footer>
      <div class="footer-container">
        <p>© Copyright Tecnova Group Srl - P.IVA IT05086260873</p>
        <div>
          <img src="images/facebook.png" alt="" />
          <img src="images/pngegg (1).png" alt="" />
        </div>
      </div>
    </footer>
</body>
</html>
