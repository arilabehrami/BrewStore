function addToCart(button) {
    const product = button.closest('.box');
    const data = {
        id: product.getAttribute('data-id'),
        name: product.getAttribute('data-name'),
        price: parseFloat(product.getAttribute('data-price')),
        quantity: 1,
        image: product.getAttribute('data-image')
    };

    fetch('admin/cart_actions.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(response => {
        if (response.status === "success") {
            showMessage("Product added to cart!", "success");
        } else {
            showMessage(response.message || "Error adding product.", "error");
        }
    })
    .catch(err => {
        console.error('Gabim:', err);
        showMessage("Something went wrong!", "error");
    });
}

function removeFromCart(index) {
    fetch('admin/cart_actions.php?action=delete', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ index: index })
    })
    .then(res => res.text())
    .then(data => {
        console.log(data);
        location.reload(); 
    })
    .catch(error => {
        console.error('Gabim:', error);
    });
}

function showMessage(msg, type) {
    let box = document.getElementById("message-box");
    if (!box) {
        box = document.createElement("div");
        box.id = "message-box";
        document.body.prepend(box);
    }
    box.className = type;
    box.textContent = msg;

    setTimeout(() => {
        box.remove();
    }, 3000);
}
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const searchQuery = urlParams.get("search");

    if (searchQuery) {
        const products = document.querySelectorAll(".box");

        let found = false;
        products.forEach(product => {
            const name = product.getAttribute("data-name");
            if (name && name.toLowerCase().includes(searchQuery.toLowerCase())) {
                product.scrollIntoView({ behavior: "smooth", block: "center" });
                product.style.outline = "3px solid gold";
                product.style.borderRadius = "12px";
                product.style.transition = "outline 0.3s ease";

                setTimeout(() => {
                    product.style.outline = "none";
                }, 3000);

                found = true;
            }
        });

        if (!found) {
            console.log("Product not found.");
        }
    }
});