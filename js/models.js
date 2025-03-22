const lang = getCurrentLang();
// Cargar header
fetch("models/header.html")
  .then(res => res.text())
  .then(data => {
    document.getElementById("header-placeholder").innerHTML = data;

    if (typeof setLanguage === "function") {
      setLanguage(lang);
    }

    // 🟢 Ahora sí existe el botón hamburguesa
    const toggle = document.getElementById("hamburger");
    const navMenu = document.getElementById("nav-menu");

    if (toggle && navMenu) {
      toggle.addEventListener("click", () => {
        navMenu.classList.toggle("active");
      });
    }
  });

// Cargar footer
fetch("models/footer.html")
  .then(res => res.text())
  .then(data => {
    document.getElementById("footer-placeholder").innerHTML = data;
  });


