document.addEventListener("DOMContentLoaded", function () {
    const productSelect = document.getElementById("product");
    const addButton = document.getElementById("btn-add-to-cart");
    const quantityInput = document.getElementById("product-quantity");
    const messageBox = document.getElementById("message-box");

    productSelect.addEventListener('change', function () {
        const selectedOption = productSelect.selectedOptions[0];
        const basePrice = parseFloat(selectedOption.getAttribute("data-price")) || 0;
        const tax = basePrice * 0.10;
        const totalWithTax = (basePrice + tax).toFixed(2);

        messageBox.innerHTML = `
            <div style="background:#fff3cd; padding:10px; border-radius:6px; font-weight:bold; color:#856404; margin-top:10px;">
                Tax included: 10% – Final price: $${totalWithTax}
            </div>
        `;
    });

    addButton.addEventListener('click', function () {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const productId = selectedOption.value;
        const productName = selectedOption.getAttribute('data-name');
        let productPrice = parseFloat(selectedOption.getAttribute('data-price'));
        const productImage = selectedOption.getAttribute('data-image') || '/assets/images/products/default-product.png';
        const productQuantity = parseInt(quantityInput.value);

        if (!productId || isNaN(productPrice) || productQuantity < 1) {
            showMessage("Please select a valid product and quantity.", "error");
            return;
        }

        const tax = productPrice * 0.10;
        productPrice = productPrice + tax;

        fetch('admin/cart_actions.php?action=add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: productQuantity,
                image: productImage
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                showMessage("Product added to cart with tax included!", "success");
                updateCartUI(productId, productName, productPrice, productQuantity, productImage);
            } else {
                showMessage(data.message, "error");
            }
        })
        .catch(err => {
            console.error('Error:', err);
            showMessage("Could not add product to cart.", "error");
        });
    });

    document.querySelectorAll('.cart-item-quantity').forEach(input => {
        input.addEventListener('input', calculateTotal);
    });

    window.addEventListener('load', calculateTotal);
});

function updateQuantity(index, newQuantity) {
    fetch('admin/cart_actions.php?action=update', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ index: index, quantity: parseInt(newQuantity) })
    })
    .then(res => res.text())
    .then(msg => {
        location.reload();
    })
    .catch(err => {
        console.error('Error:', err);
        alert('Could not update quantity.');
    });
}

function removeFromCart(index) {
    fetch('admin/cart_actions.php?action=delete', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ index: index })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            showMessage("Product removed!", "success");

            const item = document.querySelector(`.cart-item[data-index="${index}"]`);
            if (item) item.remove();

            calculateTotal();

            if (document.querySelectorAll('.cart-item').length === 0) {
                document.getElementById('cart-items').innerHTML = '<p>Your cart is empty.</p>';
                document.getElementById('total-price').textContent = 'Total price: $0.00';
            }

        } else {
            showMessage(data.message, "error");
        }
    })
    .catch(err => {
        console.error('Error:', err);
        showMessage("Could not remove product.", "error");
    });
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        let priceText = item.querySelector('.cart-item-price').textContent;
        let price = parseFloat(priceText.replace('$', '')) || 0;
        let quantityInput = item.querySelector('.cart-item-quantity');
        let quantity = parseInt(quantityInput.value) || 1;
        total += price * quantity;
    });
    document.getElementById('total-price').textContent = 'Total price: $' + total.toFixed(2);
}

function showMessage(msg, type) {
    const box = document.getElementById("message-box") || document.createElement('div');
    box.id = "message-box";
    box.className = type;
    box.textContent = msg;
    document.querySelector(".container").prepend(box);

    setTimeout(() => {
        box.remove();
    }, 3000);
}

function updateCartUI(productId, name, price, quantity, imagePath) {
    const cartContainer = document.getElementById("cart-items");

    if (!imagePath.startsWith('assets/images/') && !imagePath.startsWith('http')) {
        imagePath = 'assets/images/' + imagePath.replace(/^\/+/, '');
    }

    const index = document.querySelectorAll('.cart-item').length;

    const newItem = document.createElement('div');
    newItem.className = 'cart-item';
    newItem.setAttribute('data-index', index);

    newItem.innerHTML = `
        <div class="cart-item-info">
            <img src="${imagePath}" alt="${name}" width="60" height="60">
            <div>
                <div class="cart-item-name">${name}</div>
                <div class="cart-item-price">$${price.toFixed(2)}</div>
            </div>
        </div>
        <input type="number" min="1" class="cart-item-quantity" value="${quantity}" onchange="updateQuantity(${index}, this.value)">
        <button type="button" class="btn-remove" onclick="removeFromCart(${index})">Remove</button>
    `;

    cartContainer.appendChild(newItem);
    calculateTotal();

    if (cartContainer.innerHTML.includes("Please refresh manually")) {
        cartContainer.innerHTML = '';
        cartContainer.appendChild(newItem);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const productSelect = document.getElementById("product");
    const taxInfo = document.getElementById("tax-info");

    if (productSelect && taxInfo) {
        productSelect.addEventListener("change", () => {
            if (productSelect.value) {
                taxInfo.style.display = "block";
            } else {
                taxInfo.style.display = "none";
            }
        });
    }
});