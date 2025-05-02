// 1. Aktivizimi dhe çaktivizimi i seksioneve të ndryshme
let search=document.querySelector('.search-box');
let cart=document.querySelector('.cart');
let user=document.querySelector('.user');
// Funksionet për klikim të ikonave
document.querySelector('#search-icon').onclick = () => {
    search.classList.toggle('active');
    cart.classList.remove('active');
    user.classList.remove('active');
}
document.querySelector('#cart-icon').onclick = () => {
    cart.classList.toggle('active');
    search.classList.remove('active');
    user.classList.remove('active');
}
document.querySelector('#user-icon').onclick = () => {
    user.classList.toggle('active');
    search.classList.remove('active');
    cart.classList.remove('active');
}
function pershendetje1() {
    alert("Shijoni produktet tona!");
}

function shfaqVerejtje() {
    const warningElement = document.getElementById('warningMessage');
    warningElement.innerHTML = "Nëse përballeni me ndonjë problem,ju lutem të kontaktoni shërbimin tonë të klientit. Faleminderit për mirëkuptimin tuaj!";
}

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

function Order(name, email, address, product, payment) {
    this.name = name;
    this.email = email;
    this.address = address;
    this.product = product;
    this.payment = payment;

    this.displayOrder = function () {
        return `Porosia nga ${this.name} për produktin ${this.product} me mënyrë pagese ${this.payment}.`;
    };
}


let porosia1 = new Order("Arila", "arila@hotmail.com", "Rruga 123", "Americano", "PayPal");
let porosia2 = new Order("Beni", "beni@gmail.com", "Rruga 456", "Espresso", "Credit Card");
 

console.log(porosia1.displayOrder());
console.log(porosia2.displayOrder());


function dragStart(event) {
    event.dataTransfer.setData("text", event.target.id);
}

function allowDrop(event) {
    event.preventDefault();
}

function drop(event) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text");
    const draggedElement = document.getElementById(data);
    event.target.appendChild(draggedElement);
}



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

