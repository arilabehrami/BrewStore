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
                totalPriceElement.textContent = `Çmimi total: $${total}`;
            } else {
                totalPriceElement.textContent = "Çmimi total: $0.00";
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
//         return `Porosia nga ${this.name} për produktin ${this.product} me mënyrë pagese ${this.payment}.`;
//     };
// }


// let porosia1 = new Order("Arila", "arila@hotmail.com", "Rruga 123", "Americano", "PayPal");
// let porosia2 = new Order("Beni", "beni@gmail.com", "Rruga 456", "Espresso", "Credit Card");
 

// console.log(porosia1.displayOrder());
// console.log(porosia2.displayOrder());


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



// document.addEventListener("DOMContentLoaded", function () {
//     const currentDate = new Date();
//     const formattedDate = currentDate.toISOString().split('T')[0];

//     const orderDateElement = document.getElementById("order-date");
//     if (orderDateElement) {
//         orderDateElement.value = formattedDate;
//     } else {
//         console.log("Elementi me ID 'order-date' nuk u gjet!");
//     }
// });

document.addEventListener("DOMContentLoaded", function () {
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0];

    const orderDateElement = document.getElementById("order-date");
    if (orderDateElement) {
        orderDateElement.value = formattedDate;
    } else {
        console.log("Elementi me ID 'order-date' nuk u gjet!");
    }
});