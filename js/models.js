// Cargar header
fetch("models/header.html")
  .then(res => res.text())
  .then(data => {
    document.getElementById("header-placeholder").innerHTML = data;
    if (typeof setLanguage === "function") {
      setLanguage(lang);
    }
  });

// Cargar footer
fetch("models/footer.html")
  .then(res => res.text())
  .then(data => {
    document.getElementById("footer-placeholder").innerHTML = data;
  });



