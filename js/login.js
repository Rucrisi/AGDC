document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");
    const message = document.getElementById("loginMessage");

    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(form);
      const lang = localStorage.getItem("preferredLang") || "es";

      fetch("php/login.php", {
        method: "POST",
        body: formData,
      })
        .then(res => res.text())
        .then(data => {
          if (data.trim() === "success") {
            window.location.href = "home.php";
          } else {
            // Mostrar mensaje traducido dinámicamente
            message.setAttribute("languajes", "login_error");
            setLanguage(lang);
            message.style.color = "red";
          }
        })
        .catch(err => {
          console.error("Login error:", err);
          message.textContent = "Error al conectar con el servidor.";
          message.style.color = "red";
        });
    });
  });
  