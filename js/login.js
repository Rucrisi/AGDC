document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");
    const message = document.getElementById("loginMessage");

    // Gestión del login
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

    // Función para mostrar/ocultar contraseña
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    if (toggle && password) {
        toggle.addEventListener('click', () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            toggle.innerHTML = type === 'password'
                ? '<i class="fas fa-eye"></i>'
                : '<i class="fas fa-eye-slash"></i>';
        });
    }

    // Función para verificar al sesion
        fetch('php/check_session.php')
            .then(res => res.text())
            .then(data => {
                const online = document.getElementById('acceso');
                if (data.trim() === 'active') {
                    window.location.href = 'home.php';
                }                        
            }); 
});

  