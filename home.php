<?php
session_start();
require_once  "php/dbconnect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION["user_id"];

// Detectar idioma desde ?lang
$lang = $_GET["lang"] ?? "es";
$table = $lang === "en" ? "rutinas_en" : "rutinas";

$sql = "SELECT * FROM $table WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$rutinas = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGDC Fitness - Personal Trainer</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">
</head>
<body>
    <div id="header-placeholder"></div>

    <main class="main-scrollable">
        <section class="hero">
            <div class="hero-content">
                <h1><span languajes="home_greeting"></span> <?php echo $_SESSION["nombre"]; ?> 👋</h1>
                <p languajes="home_intro"></p>
                <div class="profile-actions">
                    <a href="profile.php" class="btn profile-btn" languajes="home_profile">Mi perfil</a>
                    <a href="php/logout.php" class="btn logout-btn" languajes="home_logout"></a>
                </div>
            </div>
        </section>

        <section class="section">
            <?php if ($rutinas->num_rows > 0): ?>
                <?php while($r = $rutinas->fetch_assoc()): ?>
                    <div class="routine-card">
                        <h2><?php echo htmlspecialchars($r["titulo"]); ?></h2>
                        <p><?php echo nl2br(htmlspecialchars($r["descripcion"])); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p languajes="home_no_routines"></p>
            <?php endif; ?>
        </section>
    </main>

    <div id="footer-placeholder"></div>

    <script src="js/lang.js"></script>
    <script src="js/models.js"></script>
    <script src="js/cookie.js"></script>
</body>
</html>

