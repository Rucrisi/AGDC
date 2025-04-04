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
    $new_name = $_POST["name"];
    $new_pass = $_POST["password"];

    if (!empty($new_pass)) {
        $hashed = password_hash($new_pass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET name = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $new_name, $hashed, $user_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $new_name, $user_id);
    }

    $stmt->execute();
    $_SESSION["name"] = $new_name;
    $mensaje = "Success";
}

// Obtener datos actuales
$stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
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
<body class="static-page">
  <div id="header-placeholder"></div>

  <main class="main-scrollable profile-section">
  <div class="profile-card">
    <h1 languajes="profile_title">Mi perfil</h1>

    <?php if ($mensaje): ?>
      <p class="success-message" languajes="profile_success"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="POST" class="contact-form">
      <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" languajes="profile_name_placeholder" placeholder="Nombre" required>

       <input type="password"
                               id="password"
                               name="password"
                               placeholder="Password"
                               required
                               pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                               title=""
                               languajes="login_error_msg">
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
