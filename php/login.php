<?php
session_start();
require_once "dbconnect.php";

$email = $_POST["email"];
$pass = $_POST["password"];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($pass, $user["password"])) {
        // Inicio de sesión válido
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["email"] = $user["email"];
        echo "success";
    } else {
        echo "error"; // Contraseña incorrecta
    }
} else {
    echo "error"; // Usuario no encontrado
}
