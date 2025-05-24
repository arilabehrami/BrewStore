document.addEventListener("DOMContentLoaded", function () {
    const acceptBtn = document.getElementById("accept-cookies-btn");
    const rejectBtn = document.getElementById("reject-cookies-btn");
    const banner = document.getElementById("cookie-banner");

   
    const cookies = document.cookie.split(";").reduce((acc, c) => {
        const [key, val] = c.trim().split("=");
        acc[key] = val;
        return acc;
    }, {});

    
    if (cookies['user_cookies'] === 'accepted') {
        document.body.style.backgroundColor = "#e8f5e9"; 
    } else if (cookies['user_cookies'] === 'rejected') {
        document.body.style.backgroundColor = "#ffebee"; 
    }

    function changeBannerBackground(color) {
        const originalBackground = banner.style.backgroundColor;
        banner.style.transition = "background-color 0.5s ease";
        banner.style.backgroundColor = color;

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
                    changeBannerBackground("#28a745");
                    document.body.style.backgroundColor = "#e8f5e9"; 
                    setTimeout(() => {
                        banner.style.display = "none";
                    }, 2500);
                }
            });
        });
    }

    if (rejectBtn) {
        rejectBtn.addEventListener("click", function () {
            
            document.cookie = "user_cookies=rejected; path=/; max-age=" + 86400;
            changeBannerBackground("#dc3545");
            document.body.style.backgroundColor = "#ffebee"; 
            setTimeout(() => {
                banner.style.display = "none";
            }, 2500);
        });
    }
});
