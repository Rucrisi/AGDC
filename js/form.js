document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    const message = document.getElementById('form-message');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Simular envío exitoso
            message.textContent = "¡Mensaje enviado con éxito!";
            message.style.color = "green";

            // Resetear el formulario
            form.reset();
        });
    }
});

