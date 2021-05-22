const input_validate_customer_div = document.querySelector("#clientList_div")
const input_validate_provider_div = document.querySelector("#fournisseurList_div")

function showClient() {
    input_validate_customer_div.classList.remove("hide");
    input_validate_provider_div.classList.add("hide");
}

function showFournisseur() {
    input_validate_customer_div.classList.add("hide");
    input_validate_provider_div.classList.remove("hide");
}