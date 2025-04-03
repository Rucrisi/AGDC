document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modalEditRoutine");
    const form = document.getElementById("formEditRoutine");

    document.querySelectorAll(".open-edit-routine-modal").forEach(button => {
        button.addEventListener("click", () => {
            const card = button.closest(".routine-card");
            const id = card.dataset.id;

            document.getElementById("editRoutineId").value = id;

            // Cargar ES
            fetch(`php/get_routine_es.php?id=${id}`)
              .then(res => res.json())
              .then(dataEs => {
                document.getElementById("editRoutineTitleEs").value = dataEs.title;
                document.getElementById("editRoutineDescriptionEs").value = dataEs.description;
              });

            // Cargar EN
            fetch(`php/get_routine_en.php?id=${id}`)
              .then(res => res.json())
              .then(dataEn => {
                document.getElementById("editRoutineTitleEn").value = dataEn.title;
                document.getElementById("editRoutineDescriptionEn").value = dataEn.description;
                modal.style.display = "flex";
              });
        });
    });

    window.closeEditRoutineModal = function () {
      modal.style.display = "none";
    };

    form.addEventListener("submit", (e) => {
      e.preventDefault();

      const formData = new FormData(form);

      fetch("php/update_routine.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        alert(data.message);
        if (data.success) {
          location.reload(); // o actualizar dinámicamente si prefieres
        }
      });
    });

    window.onclick = function (event) {
      if (event.target === modal) {
        closeEditRoutineModal();
      }
    };
  });
