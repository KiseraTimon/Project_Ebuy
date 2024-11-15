document.addEventListener("DOMContentLoaded", () => {
const cart = JSON.parse(localStorage.getItem("cart")) || {};
const listItemsContainer = document.querySelector(".list-items");
const totalPriceElement = document.createElement("div");

let totalPrice = 0;
const itemDetails = { names: [], quantities: [], prices: [], totalPrices: [], sellerUIDs: [] };

listItemsContainer.innerHTML = "";

for (const [productID, item] of Object.entries(cart)) {
    if (!item.name || !item.price || !item.quantity) continue;

    const itemTotalPrice = item.price * item.quantity;
    totalPrice += itemTotalPrice;

    itemDetails.names.push(item.name);
    itemDetails.quantities.push(item.quantity);
    itemDetails.prices.push(item.price);
    itemDetails.totalPrices.push(itemTotalPrice);
    itemDetails.sellerUIDs.push(item.sellerUID);

    const itemElement = document.createElement("div");
    itemElement.classList.add("item");
    itemElement.innerHTML = `
    <h2>${item.name}</h2>
    <p>Price: ${item.price} KES</p>
    <p>Quantity: ${item.quantity}</p>
    <p>Total: ${itemTotalPrice.toFixed(2)} KES</p>
    `;
    listItemsContainer.appendChild(itemElement);
}

totalPriceElement.innerHTML = `<h2>Total Price: ${totalPrice.toFixed(2)} KES</h2>`;
listItemsContainer.appendChild(totalPriceElement);

const form = document.querySelector(".checkout-container form");

Object.entries(itemDetails).forEach(([key, value]) => {
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = key;
    input.value = JSON.stringify(value);
    form.appendChild(input);
});

if (!Object.keys(cart).length) {
    listItemsContainer.innerHTML = "<p>Your cart is empty.</p>";
    setTimeout(() => (window.location.href = "/pages/stock.php"), 2000);
}
});
