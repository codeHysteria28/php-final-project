const shoppingCart = document.getElementById("shopping_cart");
const shoppingCartInside = document.getElementById("shopping_cart-inside");
let cart = [];

// dynamically display cart container and change its visibility
shoppingCart.addEventListener('click', () => {
    // Toggle display visibility
    if (shoppingCartInside.style.display === "inline-block") {
        shoppingCartInside.style.display = "none";
        return;
    }

    shoppingCartInside.innerHTML = '';
    shoppingCartInside.style.display = "inline-block";

    // Handle empty cart
    if (cart.length === 0) {
        shoppingCartInside.innerHTML = '<p class="text-center">Your cart is empty.</p>';
        return;
    }

    // Render cart items
    let total = 0;
    const ul = document.createElement('ul');
    cart.forEach(item => {
        const li = document.createElement('li');
        li.textContent = `${item.title} - €${parseFloat(item.price).toFixed(2)}`;
        ul.appendChild(li);
        total += parseFloat(item.price);
    });

    shoppingCartInside.appendChild(ul);

    // Display total price with clear formatting
    const totalDiv = document.createElement('div');
    totalDiv.innerHTML = `<strong>Total: €${total.toFixed(2)}</strong>`;
    shoppingCartInside.appendChild(totalDiv);
});

// function to push courses into cart array
const addToCart = (title, price) => {
    cart.push({ title, price });
};

// attach click event on each individual purchase button
// call addToCart function to fill in the title/price
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".purchase").forEach(button => {
        button.addEventListener('click', e => {
            const title = e.target.dataset.title;
            const price = e.target.dataset.price;
            addToCart(title, price);
        });
    });
});