const lang = getCurrentLang();

// Cargar header
fetch("models/header.html")
  .then(res => res.text())
  .then(data => {
    document.getElementById("header-placeholder").innerHTML = data;

    // ✅ Aplicar idioma después de insertar el header
    if (typeof setLanguage === "function") {
      setLanguage(lang);
    }

    const toggle = document.getElementById("hamburger");
    const navMenu = document.getElementById("nav-menu");

    if (toggle && navMenu) {
      toggle.addEventListener("click", () => {
        navMenu.classList.toggle("active");
      });
    }

    const hamburger = document.getElementById("hamburger");
    if (hamburger) {
      hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("open");
      });
    }
  });

// Cargar footer
fetch("models/footer.html")
  .then(res => res.text())
  .then(data => {
    document.getElementById("footer-placeholder").innerHTML = data;

    // ✅ Aplicar idioma también después de insertar el footer
    if (typeof setLanguage === "function") {
      setLanguage(lang);
    }
  });



