document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    const message = document.getElementById('form-message');
    const lang = localStorage.getItem("preferredLang") || "es";

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Cargar traducción desde lang.json
            fetch("js/lang.json")
                .then(res => res.json())
                .then(data => {
                    const successText = data[lang]?.contact_success || "Mensaje enviado";
                    message.textContent = successText;
                    message.style.color = "green";
                    form.reset();
                });
        });
    }
});

