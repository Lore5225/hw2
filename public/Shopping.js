document.querySelectorAll(".grid__item").forEach((item) => {
    item.addEventListener("click", () => {
        const productId = item.dataset.id;

        fetch(`/getProduct/${productId}`)
            .then(onResponseModal)
            .then(showProductModal);
    });
});

function onResponseModal(response) {
    if (!response.ok) return null;
    return response.json();
}

function showProductModal(product) {
    const modalContainer = document.querySelector(".modal__container");
    modalContainer.innerHTML = "";
    modalContainer.classList.add("active");

    const modalProduct = document.createElement("div");
    modalProduct.classList.add("modal__product");

    const closeButton = document.createElement("img");
    closeButton.src = "images/close.png";
    closeButton.classList.add("cross__img");
    closeButton.addEventListener("click", () => {
        modalContainer.classList.remove("active");
    });

    if (product.error) {
        const error = document.createElement("h1");
        error.textContent = product.error;
        modalProduct.appendChild(error);
    } else {
        const productName = document.createElement("h1");
        productName.textContent = product.nome;

        const productImage = document.createElement("img");
        productImage.src = product.immagine;
        productImage.classList.add("modal__product__img");

        const productDescription = document.createElement("div");
        productDescription.classList.add("product__description");
        productDescription.textContent = product.descrizione;

        const productPrice = document.createElement("div");
        productPrice.classList.add("price__modal");
        productPrice.textContent = "Prezzo: €" + product.prezzo;

        const formSubmit = document.createElement("form");
        formSubmit.action = "getProductInformation";
        formSubmit.method = "get";

        const learnMoreButton = document.createElement("button");
        learnMoreButton.classList.add("learn__more__button");
        if (product.nome.includes("Thermo")) {
            learnMoreButton.value = "6";
        } else {
            learnMoreButton.value = product.id;
        }
        learnMoreButton.name = "product";
        learnMoreButton.textContent = "Ulteriori Informazioni";
        formSubmit.appendChild(learnMoreButton);

        modalProduct.appendChild(productName);
        modalProduct.appendChild(productImage);
        modalProduct.appendChild(productDescription);
        modalProduct.appendChild(productPrice);
        modalProduct.appendChild(formSubmit);
    }

    modalProduct.appendChild(closeButton);

    modalContainer.appendChild(modalProduct);
}

const addButton = document.querySelectorAll(".button__add__to__cart");

addButton.forEach((button) => {
    button.addEventListener("click", (event) => {
        event.stopPropagation();

        const productId = button.parentElement.dataset.id;

        const formData = new FormData();
        formData.append("id", productId);

        const token = document.head.querySelector(
            'meta[name="csrf-token"]'
        ).content;

        fetch("/addtocart", {
            method: "post",
            body: formData,
            headers: { "X-CSRF-TOKEN": token },
        })
            .then(onResponse)
            .then(MessageShow);
    });
});

let messageContainer;

function onResponse(response) {
    if (response.ok) return response.json();

    return null;
}

function MessageShow(json) {
    if (!messageContainer) {
        messageContainer = document.createElement("div");
        messageContainer.classList.add("cart__message__added__container");
        document.body.appendChild(messageContainer);
    } else return null;

    if (!document.querySelector(".cart__message__added")) {
        const cartAddedMessage = document.createElement("div");
        if (json.success)
            cartAddedMessage.textContent = "Aggiunto al carrello!";
        else cartAddedMessage.textContent = json.error;
        cartAddedMessage.classList.add("cart__message__added");
        messageContainer.appendChild(cartAddedMessage);

        setTimeout(() => {
            messageContainer.removeChild(cartAddedMessage);
            if (messageContainer.childElementCount === 0) {
                document.body.removeChild(messageContainer);
                messageContainer = null;
            }
        }, 3000);
    }
}
