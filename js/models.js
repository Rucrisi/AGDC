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
        toggle.classList.toggle("open");
      });

      // Cerrar menú al hacer clic fuera
      document.addEventListener("click", (event) => {
        const isClickInside = navMenu.contains(event.target) || toggle.contains(event.target);

        if (!isClickInside && navMenu.classList.contains("active")) {
          navMenu.classList.remove("active");
          toggle.classList.remove("open");
        }
      });
    }

    const slides = document.querySelectorAll('.bg-slide');
    let current = 0;

    function showNextSlide() {
      slides[current].classList.remove('active');
      current = (current + 1) % slides.length;
      slides[current].classList.add('active');
    }

    if (slides.length > 0) {
      setInterval(showNextSlide, 3000);
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



