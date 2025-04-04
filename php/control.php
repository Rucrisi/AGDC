<?php
if (!isset($_SESSION["user_id"]) || $_SESSION["email"] !== 'admin@correo.com') {
    header("Location: login.html");
    exit();
}

$lang = $_GET["lang"] ?? "es";
$menssage = "";

// Actualizar usuario
if (isset($_POST['edit_submit'])) {
    $id = $_POST['edit_id'];
    $name = $conn->real_escape_string($_POST['edit_name']);
    $email = $conn->real_escape_string($_POST['edit_email']);
    $password = !empty($_POST['edit_password']) ? password_hash($_POST['edit_password'], PASSWORD_DEFAULT) : null;

    if ($password) {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $id);
    }

    $menssage = $stmt->execute() ? "updated" : "error";
}

// Registrar nuevo usuario
if (isset($_POST["name"])) {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt_check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $resultado_check = $stmt_check->get_result();

    if ($resultado_check->num_rows > 0) {
        $menssage = "exists";
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt_insert->bind_param("sss", $name, $email, $password);
        $stmt_insert->execute();
        $menssage = "success";
    }
}

// Asignar rutina
// Asignar rutina
if (isset($_POST['asignar_rutina'])) {
    $user_id = (int) $_POST['user_id'];
    $rutina_ids = isset($_POST['rutina_id']) ? $_POST['rutina_id'] : [];
    $menssage = "routine_error";

    if (!empty($rutina_ids)) {
        foreach ($rutina_ids as $rid) {
            $rid = (int) $rid;
            $stmt = $conn->prepare("INSERT IGNORE INTO usuario_rutina (user_id, rutina_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $user_id, $rid);
            if ($stmt->execute()) {
                $menssage = "routine_assigned";
            }
        }
    } else {
        // Opcional: puedes manejar un mensaje especial si no se seleccionó ninguna rutina
        $menssage = "no_routine_selected";
    }
}


// Eliminar rutina asignada
if (isset($_POST["eliminar_rutina"])) {
    $user_id = (int) $_POST["user_id"];
    $rutina_id = (int) $_POST["rutina_id"];

    $stmt = $conn->prepare("DELETE FROM usuario_rutina WHERE user_id = ? AND rutina_id = ?");
    $stmt->bind_param("ii", $user_id, $rutina_id);
    $stmt->execute();
    $menssage = "routine_deleted";
}

$usuarios = $conn->query("SELECT id, name, email FROM users");
$rutinas_lista = $conn->query("SELECT id, title FROM rutinas");
?>