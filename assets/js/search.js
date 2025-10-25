document.addEventListener("DOMContentLoaded", () => {
    const searchIcon = document.getElementById("search-icon");
    const searchContainer = document.querySelector(".search-container");
    const searchInput = document.getElementById("search-input");
    const searchResults = document.getElementById("search-results");

    if (searchIcon && searchContainer && searchInput && searchResults) {
        searchIcon.addEventListener("click", () => {
            searchContainer.classList.toggle("active");
            if (searchContainer.classList.contains("active")) {
                searchInput.focus();
            } else {
                searchInput.value = "";
                searchResults.innerHTML = "";
            }
        });

        const trySearchUrls = async (query) => {
            const origin = window.location.origin;
            const candidates = [
                `${origin}/admin/search-products.php`,
                `${origin}/BrewStore/admin/search-products.php`,
                "admin/search-products.php",
                "search-products.php"
            ];

            for (let url of candidates) {
                try {
                    const full = `${url}?q=${encodeURIComponent(query)}`;
                    const res = await fetch(full, { method: "GET", credentials: "same-origin" });

                    if (res.ok) {
                        const text = await res.text();

                        if (!text || text.trim().startsWith("<")) {
                            console.warn("Skipping invalid response from:", url);
                            continue;
                        }

                        try {
                            const data = JSON.parse(text);
                            if (Array.isArray(data)) {
                                console.log("✅ Using search endpoint:", url);
                                return data;
                            }
                        } catch (err) {
                            console.warn("Invalid JSON from:", url);
                        }
                    }
                } catch (err) {
                    console.warn("Fetch failed for:", url);
                }
            }

            console.error("❌ No working search endpoint found.");
            return null;
        };

        searchInput.addEventListener("keyup", function () {
            const query = this.value.trim();
            if (query.length === 0) {
                searchResults.innerHTML = "";
                return;
            }

            searchResults.innerHTML = "<div>Searching…</div>";

            trySearchUrls(query).then(data => {
                if (!data) {
                    searchResults.innerHTML = "<div>Error fetching results.</div>";
                    return;
                }

                searchResults.innerHTML = "";
                if (data.length === 0) {
                    searchResults.innerHTML = "<div>No products found.</div>";
                } else {
                    data.forEach(product => {
                        const item = document.createElement("div");
                        item.innerHTML = `
                            <a href="products.php?search=${encodeURIComponent(product.name)}"
                               style="display: flex; justify-content: space-between; align-items: center;
                               padding: 6px 12px; background-color: #f9f9f9; border-radius: 6px;">
                                <span style="font-weight: 500; color: #333;">${product.name}</span>
                                <span style="font-size: 0.9rem; color: #8B6B3E;">${product.price}€</span>
                            </a>
                        `;
                        item.style.padding = "5px 0";
                        searchResults.appendChild(item);
                    });
                }
            }).catch(err => {
                console.error("Unexpected search error:", err);
                searchResults.innerHTML = "<div>Error fetching results.</div>";
            });
        });
    }
});