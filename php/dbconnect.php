<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "agdc";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error connection: " . $conn->connect_error);
}
?>
