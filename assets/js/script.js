window.addEventListener('DOMContentLoaded', () => {
    const cart = document.querySelector('.cart');
    const user = document.querySelector('.user');

    const cartIcon = document.querySelector('#cart-icon');
    const userIcon = document.querySelector('#user-icon');

    if (cartIcon && cart) {
        cartIcon.onclick = () => {
            cart.classList.toggle('active');
            user?.classList.remove('active');
        };
    }

    if (userIcon && user) {
        userIcon.onclick = () => {
            user.classList.toggle('active');
            cart?.classList.remove('active');
        };
    }
});