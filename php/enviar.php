<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $para = "ruben.crispin@gmail.com";
    $asunto = "Nuevo mensaje desde el formulario";
    $contenido = "Nombre: $nombre\nCorreo: $email\n\nMensaje:\n$mensaje";
    $cabeceras = "From: $email";

    if (mail($para, $asunto, $contenido, $cabeceras)) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>
