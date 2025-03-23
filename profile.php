<?php
session_start();
require_once  "php/dbconnect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION["user_id"];

// Actualizar datos si se envió el formulario
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevo_nombre = $_POST["nombre"];
    $nueva_pass = $_POST["password"];

    if (!empty($nueva_pass)) {
        $hashed = hash("sha256", $nueva_pass);
        $stmt = $conn->prepare("UPDATE users SET nombre = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nuevo_nombre, $hashed, $user_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET nombre = ? WHERE id = ?");
        $stmt->bind_param("si", $nuevo_nombre, $user_id);
    }

    $stmt->execute();
    $_SESSION["nombre"] = $nuevo_nombre;
    $mensaje = "Datos actualizados correctamente ✅";
}

// Obtener datos actuales
$stmt = $conn->prepare("SELECT nombre FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>AGDC Fitness - Personal Trainer</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="inicio">
  <div id="header-placeholder"></div>

  <main class="main-scrollable profile-section">
  <div class="profile-card">
    <h1 languajes="profile_title">Mi perfil</h1>

    <?php if ($mensaje): ?>
      <p class="success-message" languajes="profile_success"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="POST" class="contact-form">
      <input type="text" name="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" languajes="profile_name_placeholder" placeholder="Nombre" required>
      <input type="password" name="password" languajes="profile_password_placeholder" placeholder="Nueva contraseña (opcional)">

      <div class="button-group">
        <button type="submit" class="btn save" languajes="profile_save">Guardar cambios</button>
        <a href="home.php" class="btn back" languajes="profile_back">Volver</a>
      </div>
    </form>

  </div>
</main>

  <div id="footer-placeholder"></div>

  <script src="js/lang.js"></script>
  <script src="js/models.js"></script>
  <script src="js/cookie.js"></script>
</body>
</html>
