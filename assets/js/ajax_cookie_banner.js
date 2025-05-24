document.addEventListener("DOMContentLoaded", function () {
    const acceptBtn = document.getElementById("accept-cookies-btn");
    const rejectBtn = document.getElementById("reject-cookies-btn");
    const banner = document.getElementById("cookie-banner");

    function changeBannerBackground(color) {
        const originalBackground = banner.style.backgroundColor;
        banner.style.transition = "background-color 0.5s ease";
        banner.style.backgroundColor = color;

        // Ktheje në ngjyrën origjinale para me u zhduk
        setTimeout(() => {
            banner.style.backgroundColor = originalBackground || "rgba(34, 34, 34, 0.85)";
        }, 2000);
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
                    changeBannerBackground("#d4edda"); // e gjelbër e lehtë
                    setTimeout(() => {
                        banner.style.display = "none";
                    }, 2500);
                }
            });
        });
    }

    if (rejectBtn) {
        rejectBtn.addEventListener("click", function () {
            changeBannerBackground("#f8d7da"); // e kuqe e lehtë
            setTimeout(() => {
                banner.style.display = "none";
            }, 2500);
        });
    }
});
