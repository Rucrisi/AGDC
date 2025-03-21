document.addEventListener("DOMContentLoaded", () => {
    const feedContainer = document.getElementById("rss-feed");
    const rssUrl = "https://rss.app/feeds/v1.1/tk2hOfvyNi2283rS.json"; // Nuevo feed JSON directo con imágenes

    fetch(rssUrl)
        .then(response => response.json())
        .then(data => {
            if (data.items && data.items.length > 0) {
                const list = document.createElement("div");
                list.style.display = "grid";
                list.style.gridTemplateColumns = "repeat(auto-fit, minmax(300px, 1fr))";
                list.style.gap = "30px";
                list.style.padding = "0";

                data.items.slice(0, 6).forEach(item => {
                    const card = document.createElement("div");
                    card.style.border = "1px solid #ddd";
                    card.style.borderRadius = "12px";
                    card.style.overflow = "hidden";
                    card.style.boxShadow = "0 4px 12px rgba(0,0,0,0.08)";
                    card.style.background = "#fff";
                    card.style.transition = "transform 0.2s";
                    card.style.cursor = "pointer";

                    card.addEventListener("mouseover", () => card.style.transform = "scale(1.02)");
                    card.addEventListener("mouseout", () => card.style.transform = "scale(1)");

                    const image = item.image ? `<img src="${item.image}" alt="${item.title}" style="width:100%; max-height:200px; object-fit:cover;">` : "";

                    card.innerHTML = `
                        ${image}
                        <div style="padding: 15px;">
                            <h3><a href="${item.link}" target="_blank" style="text-decoration:none; color:#25D366;">${item.title}</a></h3>
                            <p style="color:#444; font-size:0.95em;">${item.description.slice(0, 120)}...</p>
                        </div>
                    `;

                    list.appendChild(card);
                });

                feedContainer.innerHTML = "";
                feedContainer.appendChild(list);
            } else {
                feedContainer.innerHTML = "No se encontraron entradas del feed.";
            }
        })
        .catch(error => {
            console.error("Error al cargar el RSS:", error);
            feedContainer.innerHTML = "No se pudo cargar el contenido.";
        });
});
