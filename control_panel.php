<?php
session_start();
require_once "php/dbconnect.php";
require_once "php/control.php";

?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title>Control Panel - Admin</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/control_panel.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">
</head>
<body class="static-page">
    <div id="header-placeholder"></div>
    <main class="main-scrollable">
        <div class="admin-columns">
            <section class="hero">
                <div class="hero-content">
                    <h1 languajes="manage_users_title"></h1>

                    <?php if ($usuarios->num_rows > 0): ?>
                        <div class="responsive-table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th languajes="manage_users_name"></th>
                                    <th languajes="manage_users_email"></th>
                                    <th languajes="manage_users_actions"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $usuarios->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row["id"] ?></td>
                                        <td><?= htmlspecialchars($row["name"]) ?></td>
                                        <td><?= htmlspecialchars($row["email"]) ?></td>
                                        <td>
                                            <div class="table-action-buttons">
                                                <button type="button"
                                                class="btn btn-assign"
                                                onclick="openAssignModal(<?= $row['id'] ?>)"
                                                data-user-id="<?= $row['id'] ?>"
                                                languajes="assign_routine"></button>

                                                <button class="btn btn-edit open-edit-modal" data-id="<?= $row["id"] ?>" data-name="<?= htmlspecialchars($row["name"]) ?>" data-email="<?= htmlspecialchars($row["email"]) ?>" languajes="manage_users_edit"></button>

                                                <a href="php/delete_user.php?id=<?= $row["id"] ?>" class="btn btn-delete" onclick="return confirm('¿Seguro que quieres eliminar este usuario?');" languajes="manage_users_delete"></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        </div>
                    <?php else: ?>
                        <p>No hay usuarios registrados.</p>
                    <?php endif; ?>

                    <?php if (!empty($menssage)): ?>
                        <p class="mensaje" languajes="<?= $menssage ?>"></p>
                    <?php endif; ?>
                </div>
            </section>

            <section class="hero">
                <div class="hero-content">
                    <h1 languajes="new_user_title"></h1>

                    <form method="POST" class="contact-form">
                        <input type="text" name="name" placeholder="Nombre completo" languajes="new_user_name" required>
                        <input type="email" name="email" placeholder="Correo electrónico" languajes="new_user_email" required>
                        <input type="password"
                               id="password"
                               name="password"
                               placeholder="Password"
                               required
                               pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                               title=""
                               languajes="login_error_msg">

                        <div class="form-buttons-container"></div>
                        <button type="submit" class="btn profile-btn" languajes="new_user_button"></button>
                        <a href="home.php" class="btn back btn-edit" languajes="new_user_back"></a>
                    </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
    <div id="footer-placeholder"></div>

    <!-- Modal Editar Usuario -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 languajes="edit_user_title"></h2>
            <form method="POST" class="contact-form">
                <input type="hidden" name="edit_id" id="edit_id">
                <input type="text" name="edit_name" id="edit_name" required>
                <input type="email" name="edit_email" id="edit_email" required>
                <input type="password"
                               id="password"
                               name="edit_password"
                               placeholder="Password"
                               pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                               title=""
                               languajes="login_error_msg">
                <button type="submit" name="edit_submit" class="btn profile-btn" languajes="edit_user_save"></button>
                <button type="button" onclick="closeModal()" class="btn orange-btn" languajes="edit_user_cancel"></button>
            </form>
        </div>
    </div>

    <!-- Modal Asignar Rutina -->
    <div id="assignRoutineModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeAssignModal()">&times;</span>
            <h2 languajes="assign_routine">Asignar rutina</h2>
            <form method="POST">
                <input type="hidden" name="user_id" id="assign_user_id">
                    <div id="rutinasAsignadasContainer"></div>

                <?php if (!empty($rutinas_actuales)): ?>
                    <div class="rutinas-asignadas">
                        <strong>Rutinas actuales:</strong>
                        <ul>
                            <?php foreach ($rutinas_actuales as $rutina): ?>
                                <li>
                                    <?= htmlspecialchars($rutina["title"]) ?>
                                    <form method="POST">
                                        <input type="hidden" name="user_id" value="<?= $uid ?>">
                                        <input type="hidden" name="rutina_id" value="<?= $rutina["id"] ?>">
                                        <button type="submit" name="eliminar_rutina" title="Eliminar rutina">🗑️</button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <label languajes="select_routine">Selecciona una o más rutinas:</label>
                    <div class="checkbox-rutinas">
                        <?php
                        $rutinas_lista = $conn->query("SELECT id, title FROM rutinas");
                        while ($r = $rutinas_lista->fetch_assoc()):
                        ?>
                            <label class="rutina-checkbox">
                                <input type="checkbox" name="rutina_id[]" value="<?= $r['id'] ?>">
                                <?= htmlspecialchars($r['title']) ?>
                            </label>
                        <?php endwhile; ?>
                    </div>

                <button type="submit" name="asignar_rutina" class="btn btn-assign-2" languajes="assign_button">Asignar rutina</button>
            </form>
        </div>
    </div>


    <script src="js/control_panel.js"></script>
    <script src="js/lang.js"></script>
    <script src="js/models.js"></script>
    <script src="js/cookie.js"></script>
    <script src="js/form.js"></script>

</body>
</html>
