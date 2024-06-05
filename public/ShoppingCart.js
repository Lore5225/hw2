const plusImg = document.querySelectorAll(".button__add");
const minusImg = document.querySelectorAll(".button__remove");

function addProductToCart(event) {
    const container = event.target.closest(".product__container");
    const productID = container.dataset.id;
    const formData = new FormData();
    formData.append("id", productID);
    const token = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;

    fetch("/addtocart", {
        method: "post",
        body: formData,
        headers: { "X-CSRF-TOKEN": token },
    })
        .then(onResponse)
        .then(onConfirmAdded);
}

function removeProductFromCart(event) {
    const container = event.target.closest(".product__container");
    const productID = container.dataset.id;
    const formData = new FormData();
    formData.append("id", productID);
    const token = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;

    fetch("/removefromcart", {
        method: "post",
        body: formData,
        headers: { "X-CSRF-TOKEN": token },
    })
        .then(onResponse)
        .then(onConfirmAdded);
}

plusImg.forEach((button) => {
    button.addEventListener("click", addProductToCart);
});

minusImg.forEach((button) => {
    button.addEventListener("click", removeProductFromCart);
});

function onResponse(response) {
    if (response.ok) return response.json();

    return null;
}

function onConfirmAdded(json) {
    if (json.success) getUpdatedProduct();
    else {
        console.log("Errore, impossibile aggiungere il prodotto al carrello.");
        return null;
    }
}

function getUpdatedProduct() {
    const token = document.head.querySelector(
        'meta[name="csrf-token"]'
    ).content;
    const formData = new FormData();
    console.log("prova");

    fetch("/getUpdatedCartProducts", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": token,
        },
    })
        .then(onResponse)
        .then(onJsonUpdate);
}

function onJsonUpdate(json) {
    const mainContainer = document.querySelector(".products__wrap");
    mainContainer.innerHTML = "";
    let totalPrice = 0;

    if (json.length === 0) {
        const error = document.createElement("h1");
        error.textContent = "Nessun prodotto nel carrello!";
        mainContainer.appendChild(error);
    } else {
        json.forEach((product) => {
            const productContainer = document.createElement("div");
            productContainer.classList.add("product__container");
            productContainer.dataset.id = product.id;

            const productText = document.createElement("div");
            productText.classList.add("product__text");
            productText.textContent = product.nome;

            const imgProductWrapper = document.createElement("div");
            imgProductWrapper.classList.add("img__product__wrapper");
            const productImg = document.createElement("img");
            productImg.classList.add("product__img");
            productImg.src = product.immagine;
            productImg.alt = "";
            imgProductWrapper.appendChild(productImg);

            const quantityContainer = document.createElement("div");
            quantityContainer.classList.add("quantity__container");
            const minusIcon = document.createElement("img");
            minusIcon.src = "images/minusiconCart.ico";
            minusIcon.classList.add("button__remove");
            const productQuantity = document.createElement("div");
            productQuantity.classList.add("product__quantity");
            productQuantity.textContent = product.quantita_totale;
            const plusIcon = document.createElement("img");
            plusIcon.src = "images/plusiconCart.ico";
            plusIcon.classList.add("button__add");
            quantityContainer.appendChild(minusIcon);
            quantityContainer.appendChild(productQuantity);
            quantityContainer.appendChild(plusIcon);

            const productTotContainer = document.createElement("div");
            productTotContainer.classList.add("product__tot__container");
            const productTotal = document.createElement("div");
            productTotal.classList.add("product__total");
            productTotal.textContent = "Prezzo: € " + product.prezzo_totale;
            productTotContainer.appendChild(productTotal);

            productContainer.appendChild(productText);
            productContainer.appendChild(imgProductWrapper);
            productContainer.appendChild(quantityContainer);
            productContainer.appendChild(productTotContainer);

            mainContainer.appendChild(productContainer);
            totalPrice += Number(product.prezzo_totale);
        });

        const totalContainer = document.createElement("div");
        totalContainer.classList.add("cart__bottom");
        const totalPriceText = document.createElement("p");
        totalPriceText.textContent = "Totale: €" + totalPrice;
        totalContainer.appendChild(totalPriceText);

        const buttonWrapper = document.createElement("div");
        buttonWrapper.classList.add("link__checkout");
        const checkoutButton = document.createElement("button");
        checkoutButton.addEventListener("click", () => {
            location.href = "/CheckoutPage";
        });
        checkoutButton.classList.add("button__checkout");
        checkoutButton.textContent = "Vai al checkout";
        const arrowIcon = document.createElement("img");
        arrowIcon.src = "images/right-arrow-svgrepo-com.svg";
        checkoutButton.appendChild(arrowIcon);
        buttonWrapper.appendChild(checkoutButton);
        totalContainer.appendChild(buttonWrapper);

        mainContainer.appendChild(totalContainer);
    }

    const plusImg = document.querySelectorAll(".button__add");
    const minusImg = document.querySelectorAll(".button__remove");

    plusImg.forEach((button) => {
        button.addEventListener("click", addProductToCart);
    });

    minusImg.forEach((button) => {
        button.addEventListener("click", removeProductFromCart);
    });
}
