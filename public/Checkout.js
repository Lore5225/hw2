const form = document.getElementById("checkoutForm");
const inputs = document.querySelectorAll("input[type='text']:not(#notes)");

inputs.forEach(function (input) {
    input.addEventListener("blur", function () {
        const error = input.nextElementSibling;
        if (input.value.trim() === "") {
            showError(input, error, "Campo obbligatorio");
        } else {
            hideError(input, error);
        }
    });
});

form.addEventListener("submit", function (event) {
    let hasVisibleErrors = false;

    inputs.forEach(function (input) {
        const error = input.nextElementSibling;
        if (input.value.trim() === "" && input.id !== "notes") {
            showError(input, error, "Campo obbligatorio");
            hasVisibleErrors = true;
        } else {
            hideError(input, error);
        }
    });

    if (hasVisibleErrors) {
        event.preventDefault();
    }
});

function showError(input, error, message) {
    input.classList.add("error");
    error.textContent = message;
}

function hideError(input, error) {
    input.classList.remove("error");
    error.textContent = "";
}
