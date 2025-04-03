<?php
require_once "dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $title_es = $_POST['title_es'] ?? '';
    $description_es = $_POST['description_es'] ?? '';
    $title_en = $_POST['title_en'] ?? '';
    $description_en = $_POST['description_en'] ?? '';

    if ($id && $title_es && $description_es && $title_en && $description_en) {
        // Actualizar rutina en español
        $stmt1 = $conn->prepare("UPDATE rutinas SET title = ?, description = ? WHERE id = ?");
        $stmt1->bind_param("ssi", $title_es, $description_es, $id);
        $stmt1->execute();

        // Actualizar rutina en inglés
        $stmt2 = $conn->prepare("UPDATE rutinas_en SET title = ?, description = ? WHERE id = ?");
        $stmt2->bind_param("ssi", $title_en, $description_en, $id);
        $stmt2->execute();

        echo json_encode(["success" => true, "message" => "Rutina actualizada en ambos idiomas."]);
    } else {
        echo json_encode(["success" => false, "message" => "Faltan datos."]);
    }
}

