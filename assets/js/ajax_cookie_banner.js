document.addEventListener("DOMContentLoaded", function () {
    const acceptBtn = document.getElementById("accept-cookies-btn");
    const rejectBtn = document.getElementById("reject-cookies-btn");

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
                }
            });
        });
    }

    if (rejectBtn) {
        rejectBtn.addEventListener("click", function () {
            document.getElementById("cookie-banner").style.display = "none";
        });
    }
});