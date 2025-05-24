
document.addEventListener("DOMContentLoaded", function () {
    const acceptBtn = document.getElementById("accept-cookies-btn");
    const rejectBtn = document.getElementById("reject-cookies-btn");
    const banner = document.getElementById("cookie-banner");

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
                    changeBackground("#d4edda"); // Light green for Accept All
                    setTimeout(() => {
                        banner.style.display = "none";
                    }, 500);
                }
            });
        });
    }

    if (rejectBtn) {
        rejectBtn.addEventListener("click", function () {
            changeBackground("#f8d7da"); // Light red for Reject All
            setTimeout(() => {
                banner.style.display = "none";
            }, 500);
        });
    }
});