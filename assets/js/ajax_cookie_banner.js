document.addEventListener("DOMContentLoaded", function () {
    const acceptBtn = document.getElementById("accept-cookies-btn");
    const rejectBtn = document.getElementById("reject-cookies-btn");

    function changeBackground(color) {
        const body = document.body;
        const originalBackground = getComputedStyle(body).background;
        body.style.transition = "background 0.5s ease";
        body.style.background = color;

        setTimeout(() => {
            body.style.background = originalBackground;
        }, 3000);  
    }

    if (acceptBtn) {
        acceptBtn.addEventListener("click", function () {
            fetch("includes/set_cookie.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "accept_cookies=1"
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("cookie-banner").style.display = "none";
                    changeBackground("green");
                }
            });
        });
    }

    if (rejectBtn) {
        rejectBtn.addEventListener("click", function () {
            document.getElementById("cookie-banner").style.display = "none";
            changeBackground("red");
        });
    }
});
