document.addEventListener("DOMContentLoaded", () => {
    const checkCookiePopup = () => {
      const cookiePopup = document.getElementById("cookie-popup");
      const acceptBtn = document.getElementById("accept-cookies");

      if (!cookiePopup || !acceptBtn) {
        // Reintenta después por si aún no se ha cargado el footer
        setTimeout(checkCookiePopup, 100);
        return;
      }

      if (!localStorage.getItem("cookiesAccepted")) {
        cookiePopup.style.display = "flex";
      } else {
        cookiePopup.style.display = "none";
      }

      acceptBtn.addEventListener("click", () => {
        localStorage.setItem("cookiesAccepted", "true");
        cookiePopup.style.display = "none";
      });
    };

    checkCookiePopup();
  });
