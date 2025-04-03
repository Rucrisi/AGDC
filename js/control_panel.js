document.addEventListener("DOMContentLoaded", () => {
    const openButtons = document.querySelectorAll(".open-edit-modal");
    const modal = document.getElementById("editModal");
    const assignModal = document.getElementById("assignRoutineModal");
    let currentEditUserId = null;
    let currentUserId = null;

    openButtons.forEach(btn => {
      btn.addEventListener("click", () => {
        const id = btn.dataset.id;
        document.getElementById("edit_id").value = id;
        document.getElementById("edit_name").value = btn.dataset.name;
        document.getElementById("edit_email").value = btn.dataset.email;

        currentEditUserId = id; // ← Guardamos el ID
        modal.style.display = "flex";
      });
    });


    window.onclick = function (event) {
      if (event.target === modal) closeModal();
      if (event.target === assignModal) closeAssignModal();
    };

    document.addEventListener("click", function (e) {
      if (e.target.classList.contains("delete-routine")) {
        e.preventDefault();

        const userId = e.target.dataset.userId;
        const rutinaId = e.target.dataset.rutinaId;

        const formData = new FormData();
        formData.append("user_id", userId);
        formData.append("rutina_id", rutinaId);
        formData.append("eliminar_rutina", "1");

        fetch("control_panel.php", {
          method: "POST",
          body: formData,
        })
          .then(() => fetch(`php/user_routines.php?user_id=${userId}`))
          .then(res => res.text())
          .then(html => {
            document.getElementById("rutinasAsignadasContainer").innerHTML = html;
          });
      }
    });

    window.closeModal = function () {
      modal.style.display = "none";

      if (currentEditUserId) {
        fetch(`php/get_user_row.php?id=${currentEditUserId}`)
          .then(res => res.text())
          .then(html => {
            // Reemplazar la fila entera del usuario con la nueva info
            const row = document.querySelector(`tr[data-user-id="${currentEditUserId}"]`);
            if (row) {
              row.outerHTML = html;
            }
            currentEditUserId = null;
          });
      }
    };

    window.closeAssignModal = function () {
      // Refrescar las rutinas antes de cerrar el modal
      if (currentUserId) {
        fetch(`php/user_routines.php?user_id=${currentUserId}`)
          .then(res => res.text())
          .then(html => {
            document.getElementById("rutinasAsignadasContainer").innerHTML = html;
            assignModal.style.display = "none";
          });
      } else {
        assignModal.style.display = "none";
      }
    };


    window.openAssignModal = function (userId) {
      currentUserId = userId; // Guardamos el ID para usarlo al cerrar
      document.getElementById("assign_user_id").value = userId;
      assignModal.style.display = "flex";

      fetch(`php/user_routines.php?user_id=${userId}`)
        .then(res => res.text())
        .then(html => {
          document.getElementById("rutinasAsignadasContainer").innerHTML = html;
        });
    };


    // Abrir/Cerrar modal de crear rutina
    document.getElementById("btnCrearRutina").addEventListener("click", () => {
      document.getElementById("modalCrearRutina").style.display = "block";
    });

    document.getElementById("cerrarModalCrearRutina").addEventListener("click", () => {
      document.getElementById("modalCrearRutina").style.display = "none";
    });

    // Enviar datos al servidor
    document.getElementById("formCrearRutina").addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch("php/create_routine.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        alert(data.message);
        if (data.success) {
          this.reset();
          document.getElementById("modalCrearRutina").style.display = "none";
          // Opcional: refrescar lista de rutinas
        }
      })
      .catch(error => {
        console.error("Error:", error);
      });
    });
  });

