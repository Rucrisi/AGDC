<?php
require_once "dbconnect.php";

if (isset($_GET["user_id"])) {
    $user_id = (int) $_GET["user_id"];

    $stmt = $conn->prepare("
        SELECT r.id, r.title
        FROM rutinas r
        JOIN usuario_rutina ur ON ur.rutina_id = r.id
        WHERE ur.user_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<strong>Rutinas actuales:</strong><ul class='lista-rutinas-asignadas'>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($row["title"]) . "
            <button
                class='delete-routine'
                data-user-id='" . $user_id . "'
                data-rutina-id='" . $row['id'] . "'
                title='Eliminar rutina'>🗑️</button>
            </li>";

        }
        echo "</ul>";
    } else {
        echo "<p>No tiene rutinas asignadas.</p>";
    }
} else {
    echo "<p>Usuario no especificado.</p>";
}

