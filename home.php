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

$sql = "
    SELECT r.*
    FROM $table r
    JOIN usuario_rutina ur ON ur.rutina_id = r.id
    WHERE ur.user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$rutinas = $stmt->get_result();

// Obtener rutinas en español para el modal de edición
$stmt_es = $conn->prepare("
    SELECT r.id, r.title, r.description
    FROM rutinas r
    JOIN usuario_rutina ur ON ur.rutina_id = r.id
    WHERE ur.user_id = ?
");
$stmt_es->bind_param("i", $user_id);
$stmt_es->execute();

$rutinas_es = [];
$res_es = $stmt_es->get_result();
while ($row = $res_es->fetch_assoc()) {
    $rutinas_es[$row["id"]] = $row;
}

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGDC Fitness - Personal Trainer</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">
</head>
<body class="static-page">
    <div id="header-placeholder"></div>

    <main class="main-scrollable">
        <section class="hero">
            <div class="hero-content">
                <h1><span languajes="home_greeting"></span> <?php echo $_SESSION["name"]; ?>!👋</h1>
                <p languajes="home_intro"></p>
                <div class="profile-actions">
                    <a href="profile.php" class="btn profile-btn" languajes="home_profile">Mi perfil</a>

                    <?php if (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@correo.com'): ?>
                        <a href="control_panel.php" class="btn btn-admin" languajes="home_admin_control"></a>
                    <?php endif; ?>

                    <a href="php/logout.php" class="btn logout-btn" languajes="home_logout"></a>
                </div>
            </div>
        </section>

        <section class="section-card">
            <?php if ($rutinas->num_rows > 0): ?>
                <div class="routines-grid">
                <?php while($r = $rutinas->fetch_assoc()):
                    $es = $rutinas_es[$r['id']] ?? ['title' => '', 'description' => '']; ?>
                    <div class="routine-card"
                        data-id="<?= $r['id'] ?>"
                        data-title="<?= htmlspecialchars($es['title']) ?>"
                        data-description="<?= htmlspecialchars($es['description']) ?>">
                        <h2><?= htmlspecialchars($r["title"]) ?></h2>
                        <p><?= nl2br(htmlspecialchars($r["description"])) ?></p>

                        <?php if ($_SESSION['email'] === 'admin@correo.com'): ?>
                            <button class="btn btn-edit-routine open-edit-routine-modal" languajes="edit_routine_button"></button>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p languajes="home_no_routines"></p>
            <?php endif; ?>
        </section>
    </main>

    <!-- Modal Editar Rutina -->
    <div id="modalEditRoutine" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditRoutineModal()">&times;</span>
        <h2 languajes="edit_routine_title">Editar rutina</h2>
        <form id="formEditRoutine">
            <input type="hidden" name="id" id="editRoutineId">

            <label>Título (ES)</label>
            <input type="text" name="title_es" id="editRoutineTitleEs" required>

            <label>Descripción (ES)</label>
            <textarea name="description_es" id="editRoutineDescriptionEs" rows="4" required></textarea>

            <label>Título (EN)</label>
            <input type="text" name="title_en" id="editRoutineTitleEn" required>

            <label>Descripción (EN)</label>
            <textarea name="description_en" id="editRoutineDescriptionEn" rows="4" required></textarea>

            <button type="submit" class="btn profile-btn" languajes="edit_routine_save">Guardar cambios</button>
        </form>
    </div>
    </div>

    <div id="footer-placeholder"></div>
    <script src="js/routine_card.js"></script>
    <script src="js/lang.js"></script>
    <script src="js/models.js"></script>
    <script src="js/cookie.js"></script>
</body>
</html>

