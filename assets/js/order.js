function kontrolloPorosine() {
    try {
        let name = document.getElementById("name").value;
        let email = document.getElementById("email").value;
        let address = document.getElementById("address").value;
        let product = document.getElementById("product").value;
        let payment = document.getElementById("payment-method").value;
        let isChecked = document.getElementById("accept-terms").checked;
        let quantity = document.getElementById("product-suggestion").value;


        validateName(name);
        validateEmail(email);
        validateAddress(address);
        validateQuantity(quantity);

        if (!product) throw "Ju lutem zgjidhni një produkt!";
        if (!payment) throw "Ju lutem zgjidhni mënyrën e pagesës!";
        if (!isChecked) throw "Ju duhet të pranoni kushtet dhe rregullat!";

        // Përdorimi i objekteve dhe metodave për manipulim me data dhe numra
        let currentDate = new Date(); // Përdorim objektin Date
        let currentYear = currentDate.getFullYear();
        let dateString = `Data e porosisë: ${currentDate.toLocaleString()}`;
        console.log(dateString);

        // Manipulimi i numrave
        let maxPayment = 999999.99;
        let minPayment = 0.01;
        console.log(`Vlera maksimale e pagesës: ${maxPayment.toExponential()}`);
        console.log(`Vlera minimale e pagesës: ${minPayment.toString()}`);
        console.log(`Vlera e pagesës: ${payment}`);
        console.log(`Vlera e pagesës është NaN: ${isNaN(payment)}`);

       

        setTimeout(function() {
            alert("Porosia u dërgua me sukses!");
        }, 3000);
    } catch (error) {
        alert(`Gabim: ${error}`);
    }
}
function validateQuantity(quantity) {
    if (!quantity || quantity <= 0) {
        throw "Ju lutem shkruani një sasi të vlefshme!";
    }
}
// Funksionet për validimin e të dhënave
function validateName(name) {
    if (!name) throw "Emri është i detyrueshëm!";
}

function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) throw "Email-i nuk është valid!";
}

function validateAddress(address) {
    if (!address) throw "Adresa është e detyrueshme!";
}

function Product(name, price) {
    this.name = name;
    this.price = price;
    this.displayInfo = function() {
        return `Produkti: ${this.name}, Çmimi: ${this.price}`;
    };
}

let product1 = new Product("Americano", 10);
let product2 = new Product("Esspreso", 25);
let product3 = new Product("Makiato", 20);

console.log(product1.displayInfo());
console.log(product2.displayInfo());
console.log(product3.displayInfo());


let emailExample = "arila@example.com";
let emailMatch = emailExample.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);
if (emailMatch) {
    console.log("Emaili është i vlefshëm");
} else {
    console.log("Emaili është i pavlefshëm");
}

let updatedEmail = emailExample.replace("example.com", "gmail.com");
console.log(`Email i përditësuar: ${updatedEmail}`);