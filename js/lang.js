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
        if (textos[key]) {
          // Si el elemento es input o textarea, cambia el placeholder
          if (el.tagName === "INPUT" || el.tagName === "TEXTAREA") {
            el.placeholder = textos[key];
          } else {
            el.innerHTML = textos[key];
          }
        }
      });
    })
    .catch(err => console.error("Error cargando idioma:", err));
}

function changeLang(lang) {
  localStorage.setItem("preferredLang", lang);
  setLanguage(lang);
}

document.addEventListener("DOMContentLoaded", () => {
  const lang = getCurrentLang();
  setLanguage(lang);
});


