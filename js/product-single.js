document.addEventListener("DOMContentLoaded", function () {
    const minusButton = document.getElementById("minus");
    const plusButton = document.getElementById("plus");
    const inputField = document.getElementById("u_qty");
    const totalPriceElement = document.querySelector(".total-price");

    // Remove commas before parsing the unit price
    const unitPrice = parseFloat(document.querySelector(".unit-price").textContent.replace(/,/g, ''));

    function updateTotalPrice() {
        let quantity = parseInt(inputField.value) || 1;
        if (quantity < 1) quantity = 1; // Prevent negative or zero values
        inputField.value = quantity;
        totalPriceElement.textContent = (unitPrice * quantity).toLocaleString(); // Format output with commas
    }

    minusButton.addEventListener("click", function (event) {
        event.preventDefault();
        if (inputField.value > 1) {
            inputField.value = parseInt(inputField.value) - 1;
            updateTotalPrice();
        }
    });

    plusButton.addEventListener("click", function (event) {
        event.preventDefault();
        inputField.value = parseInt(inputField.value) + 1;
        updateTotalPrice();
    });

    inputField.addEventListener("input", function () {
        updateTotalPrice();
    });

    updateTotalPrice(); // Initialize price on page load
});
