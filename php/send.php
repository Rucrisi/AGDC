<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $menssaje = htmlspecialchars($_POST['menssage']);

    $para = "ruben.crispin@gmail.com";
    $asunto = "Nuevo mensaje desde el formulario";
    $contenido = "Nombre: $name\nCorreo: $email\n\nMensaje:\n$menssaje";
    $cabeceras = "From: $email";

    if (mail($para, $asunto, $contenido, $cabeceras)) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>
