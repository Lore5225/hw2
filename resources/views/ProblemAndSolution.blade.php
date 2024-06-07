<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solution</title>
    <link rel="stylesheet" href="{{ url('ProblemAndSolution.css') }}">
    <script src="{{ url('ProblemAndSolution.js') }} " defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
</head>

<body>
    <header>

        <div class="inner-container">
            <img src="{{ url ('images/menu.png') }}" id="hamburger__icon" alt="">
            <img src="{{url ('images/tecnova-group.png') }}" alt="" />

        </div>

        <nav>
            <a href="{{url ('index')}}"> Home</a>
            <h1>Problemi & Soluzioni</h1>
            <div class="nav-text">
                <form action="/getSolution" method="get">
                    <button type="submit" name="Problem" value="1">Il tuo edificio consuma troppa energia?</button>
                    <button type="submit" name="Problem" value="2">La tua casa è attaccata dall'umidità?</button>
                    <button type="submit" name="Problem" value="3">La tua casa è attaccata da agenti esterni?</button>
                    <button type="submit" name="Problem" value="4">L'aria che respiri nella tua casa non è più salubre?</button>
                    <button type="submit" name="Problem" value="5">La tua casa ha bisogno di un restyling?</button>
                </form>
            </div>
            <h1>Prodotti</h1>
            <div class="nav-text">
                <form action="/getProductInformation" method="get" class="">
                    <button type="submit" name="product" value="3">Genié</button>
                    <button type="submit" name="product" value="4">Gemini</button>
                    <button type="submit" name="product" value="6">Climate Coating</button>
                    <button type="submit" name="product" value="5">Geniair</button>
                    <button type="submit" name="product" value="9">Tecnovair</button>
                    <button type="submit" name="product" value="2">Evercem Easy</button>
                    <button type="submit" name="product" value="1">Evercem Protettivi</button>
                </form>
            </div>
            </div>


            <a href="{{url ('ShoppingPage') }}"> <img id="shopping-cart" src="{{url ('images/carrello.png') }}" alt="" /></a>


            </div>
            </div>


        </nav>

    </header>

    <div class="solution__container">
        <div class="main__paragraph">
            <div class="Paragraph">
                <h1>{{ $titoli['TitoloPrincipale'] }}</h1>
                <p>{{ $paragrafi['ParagrafoPrincipale'] }}</p>
            </div>
            <div class="image__wrapper">
                <img src="{{ url($immagini['immagineDescrittiva1']) }}" alt="">
            </div>
        </div>

        <div class="products__solution__container">
            @for ($i = 1; $i <= count($titoli) - 1; $i++) <div class="products__item">
                <img src="{{ url($immagini['immagineDescrittiva' . ($i + 1)]) }}" alt="">
                <h1>{{ $titoli['Titolo' . $i] }}</h1>
                <p>{{ $paragrafi['Paragrafo' . $i] }}</p>
        </div>
        @endfor
    </div>
    </div>

    <div id="divider">
        <p>Per qualsiasi domanda, contattaci!</p>
    </div>

    <div class="container-border">
        <div class="contacts-container">
            <div class="contacts-item">
                <p>Contattaci su Whatsapp</p>
                <a href="#" class="contacts-button">
                    <img src="{{ url('images/cornetta.png') }}" alt="">Clicca qui
                </a>
            </div>
            <div class="contacts-item">
                <p>Scrivici per ogni esigenza</p>
                <a href="#" class="contacts-button">
                    <img src="{{ url('images/pngwing.com (1).png') }}" alt="">Clicca qui
                </a>
            </div>
        </div>
    </div>
    <div class="container-endpage">
        <div class="item-endpage">
            <h3>Tecnova Group</h3>
            <p>Sede legale e operativa:</p>
            <p>Via Al Idrisi, 2T 95041 Caltagirone (CT)</p>
            <p>Tel. 0933 31224 / 0933 25621</p>
            <p>Fax: 0933 25621</p>
            <p>Email: <a href="mailto:info@tecnovagroup.com">info@tecnovagroup.com</a></p>
            <p>Pec: <a href="mailto:tecnovagroup@pec.it">tecnovagroup@pec.it</a></p>
            <p>P.IVA: IT05086260873</p>

            <img src="{{ url('images/enel.png') }}" alt="" />

        </div>
        <div class="item-endpage">
            <div id="dubai-format">
                <p>Representative office: 48 Burj Gate, 10th Floor, room #1001, Downtown, Dubai (EAU)</p>
                <p>Representative office: 7th Floor – CI Tower – Khalidiya Area – Abu Dhabi</p>
                <a href="#">Lavora con noi</a>
                <a href="#">Privacy e trattamento dei dati</a>
                <a href="#">Uso dei cookie</a>
            </div>
        </div>
        <div class="item-endpage">
            <p>Iscriviti alla nostra Newsletter</p>
            <div class="email_bar">
                <input type="email" placeholder="Email">
            </div>
            <button class="send-button">Invia</button>
            <div class="accept-button-container">
                <input type="checkbox" name="myCheckbox" id="checkbox">
                <label for="checkbox">Ho letto e accettato l’info sulla privacy</label>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <p>© Copyright Tecnova Group Srl - P.IVA IT05086260873</p>
            <div>
                <img src="{{ url('images/facebook.png') }}" alt="">
                <img src="{{ url('images/pngegg (1).png') }}" alt="">
            </div>
        </div>
    </footer>
</body>

</html>