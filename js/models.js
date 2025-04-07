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

    // Menú hamburguesa
    const toggle = document.getElementById("hamburger");
    const navMenu = document.getElementById("nav-menu");

    if (toggle && navMenu) {
      toggle.addEventListener("click", () => {
        navMenu.classList.toggle("active");
        toggle.classList.toggle("open");
      });

      document.addEventListener("click", (event) => {
        const isClickInside = navMenu.contains(event.target) || toggle.contains(event.target);
        if (!isClickInside && navMenu.classList.contains("active")) {
          navMenu.classList.remove("active");
          toggle.classList.remove("open");
        }
      });
    }

    // Inicializar ambos carruseles (PC y móvil)
    initCarousel(".background-carousel");
    initCarousel(".background-carousel-mvl");
  });

// Cargar footer
fetch("models/footer.html")
  .then(res => res.text())
  .then(data => {
    document.getElementById("footer-placeholder").innerHTML = data;

    if (typeof setLanguage === "function") {
      setLanguage(lang);
    }
  });

// Función para inicializar un carrusel
function initCarousel(selector) {
  const container = document.querySelector(selector);
  if (!container) return;

  const slides = container.querySelectorAll('.bg-slide');
  let current = 0;

  function showNextSlide() {
    slides[current].classList.remove('active');
    current = (current + 1) % slides.length;
    slides[current].classList.add('active');
  }

  if (slides.length > 0) {
    setInterval(showNextSlide, 3000);
  }
}
