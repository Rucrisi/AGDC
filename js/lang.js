function getCurrentLang() {
  const urlParams = new URLSearchParams(window.location.search);
  const langFromURL = urlParams.get("lang");

  if (langFromURL) {
    localStorage.setItem("preferredLang", langFromURL);
    return langFromURL;
  }

  const savedLang = localStorage.getItem("preferredLang");
  if (savedLang) return savedLang;

  const browserLang = navigator.language.slice(0, 2);
  return browserLang === "en" ? "en" : "es";
}

function setLanguage(lang) {
  fetch("js/lang.json")
    .then(res => res.json())
    .then(data => {
      const textos = data[lang];
      if (!textos) return;

        document.querySelectorAll("[languajes]").forEach(el => {
            const key = el.getAttribute("languajes");
            const translation = textos[key];

            if (translation) {
                // Si tiene 'title', solo lo actualizamos a ese texto
                if (el.hasAttribute("title")) {
                    el.setAttribute("title", translation);
                }
                // Si no tiene 'title', actualizamos contenido o placeholder
                else if (el.tagName === "INPUT" || el.tagName === "TEXTAREA") {
                    el.placeholder = translation;
                } else {
                    el.innerHTML = translation;
                }
            }
        });
    })
    .catch(err => console.error("Error cargando idioma:", err));
}

function changeLang(lang) {
  localStorage.setItem("preferredLang", lang);
  const currentURL = new URL(window.location.href);
  currentURL.searchParams.set("lang", lang);
  window.location.href = currentURL.toString();
}

document.addEventListener("DOMContentLoaded", () => {
  const lang = getCurrentLang();
  setLanguage(lang);

  // Solo en páginas .php: redirigir con ?lang si no está presente
  if (window.location.pathname.includes(".php")) {
    const currentURL = new URL(window.location.href);
    if (!currentURL.searchParams.get("lang")) {
      currentURL.searchParams.set("lang", lang);
      window.location.href = currentURL.toString();
    }
  }
});


