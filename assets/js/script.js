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

// function Order(name, email, address, product, payment) {
//     this.name = name;
//     this.email = email;
//     this.address = address;
//     this.product = product;
//     this.payment = payment;

//     this.displayOrder = function () {
//         return `Order from ${this.name} for the product ${this.product} with payment method ${this.payment}.`;
//     };
// }

// let order1 = new Order("Arila", "arila@hotmail.com", "Street 123", "Americano", "PayPal");
// let order2 = new Order("Beni", "beni@gmail.com", "Street 456", "Espresso", "Credit Card");

// console.log(order1.displayOrder());
// console.log(order2.displayOrder());


// function dragStart(event) {
//     event.dataTransfer.setData("text", event.target.id);
// }

// function allowDrop(event) {
//     event.preventDefault();
// }

// function drop(event) {
//     event.preventDefault();
//     const data = event.dataTransfer.getData("text");
//     const draggedElement = document.getElementById(data);
//     event.target.appendChild(draggedElement);
// }

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