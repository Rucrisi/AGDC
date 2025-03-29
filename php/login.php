<?php
session_start();
require_once  "dbconnect.php";

$email = $_POST["email"];
$pass = $_POST["password"];
$hashed = hash("sha256", $pass);

$sql = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashed);
$stmt->execute();

$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["name"] = $user["name"];
    echo "success";
} else {
    echo "error";
}
