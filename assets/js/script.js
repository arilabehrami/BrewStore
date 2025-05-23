window.addEventListener('DOMContentLoaded', () => {
    const search = document.querySelector('.search-box');
    const cart = document.querySelector('.cart');
    const user = document.querySelector('.user');

    const searchIcon = document.querySelector('#search-icon');
    const cartIcon = document.querySelector('#cart-icon');
    const userIcon = document.querySelector('#user-icon');

    if (searchIcon) {
        searchIcon.onclick = () => {
            search.classList.toggle('active');
            cart.classList.remove('active');
            user.classList.remove('active');
        };
    }

    if (cartIcon) {
        cartIcon.onclick = () => {
            cart.classList.toggle('active');
            search.classList.remove('active');
            user.classList.remove('active');
        };
    }

    if (userIcon) {
        userIcon.onclick = () => {
            user.classList.toggle('active');
            search.classList.remove('active');
            cart.classList.remove('active');
        };
    }
});

$(document).ready(function(){
    $('.timeline-item p').hover(function() {
        $(this).css('color','blue');
    }, function() {
        $(this).css('color','black');
    });
});

$(document).ready(function() {
    $('.about-text p').hover(function() {
        $(this).css('color', 'green'); 
    }, function() {
        $(this).css('color', 'black'); 
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const productElement = document.getElementById("product");
    const quantityElement = document.getElementById("product-suggestion"); 
    const totalPriceElement = document.getElementById("total-price");

    if (productElement && quantityElement && totalPriceElement) {
        function updateTotalPrice() {
            let selectedOption = productElement.options[productElement.selectedIndex];
            let price = parseFloat(selectedOption.getAttribute("data-price"));
            let quantity = parseInt(quantityElement.value);

            if (price && quantity > 0) {
                let total = (price * quantity).toFixed(2);
                totalPriceElement.textContent = `Total price: $${total}`;
            } else {
                totalPriceElement.textContent = "Total price: $0.00";
            }
        }

        productElement.addEventListener("change", updateTotalPrice);
        quantityElement.addEventListener("input", updateTotalPrice);

        updateTotalPrice();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0];

    const orderDateElement = document.getElementById("order-date");
    if (orderDateElement) {
        orderDateElement.value = formattedDate;
    } else {
        console.log("Element with ID 'order-date' not found!");
    }
});