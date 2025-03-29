<?php
session_start();
require_once "dbconnect.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["email"] !== 'admin@correo.com') {
    header("Location: login.html");
    exit();
}

$id = $_GET["id"] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ../control_panel.php");
exit();
