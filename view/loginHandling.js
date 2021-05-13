const input_logCustomer_div = document.querySelector("#logCustomerForm_div")
const input_logProvider_div = document.querySelector("#logProviderForm_div")
const input_change_type_account_button = document.querySelector("#change_type_button")

function showCustomerDiv() {
    input_logCustomer_div.classList.remove("hide")
    input_logProvider_div.classList.add("hide")
}

function showProviderDiv() {
    input_logCustomer_div.classList.add("hide")
    input_logProvider_div.classList.remove("hide")
}