<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $para = "contacto@agdcfitness.com"; // Cambia esto por tu correo real
    $asunto = "Nuevo mensaje desde el formulario";
    $contenido = "Nombre: $nombre\nCorreo: $email\n\nMensaje:\n$mensaje";
    $cabeceras = "From: $email";

    if (mail($para, $asunto, $contenido, $cabeceras)) {
        echo "Mensaje enviado con éxito.";
    } else {
        echo "Hubo un error al enviar el mensaje.";
    }
}
?>
