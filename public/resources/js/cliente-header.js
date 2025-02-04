document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector(".lhe-header");
  const menuToggle = document.querySelector(".lhe-menu-toggle");
  const nav = document.querySelector(".lhe-nav");
  const languageButton = document.querySelector(".lhe-language-button");
  const languageDropdown = document.querySelector(".lhe-language-dropdown");

  // Cambiar estilo del header al hacer scroll
  window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {
          header.classList.add("scrolled");
      } else {
          header.classList.remove("scrolled");
      }
  });

  // Abrir/cerrar menú móvil
  menuToggle.addEventListener("click", (e) => {
      e.stopPropagation();
      nav.classList.toggle("active");
      menuToggle.setAttribute("aria-expanded", nav.classList.contains("active"));
  });

  // Cerrar menú al hacer clic fuera del contenedor en vista móvil
  document.addEventListener("click", (e) => {
      if (!nav.contains(e.target) && !menuToggle.contains(e.target)) {
          nav.classList.remove("active");
          menuToggle.setAttribute("aria-expanded", "false");
      }
  });

  // Abrir/cerrar selector de idioma
  languageButton.addEventListener("click", (e) => {
      e.stopPropagation();
      languageDropdown.classList.toggle("active");
  });

  // Cerrar selector de idioma al hacer clic fuera
  document.addEventListener("click", () => {
      languageDropdown.classList.remove("active");
  });

  // Cambiar idioma
  languageDropdown.addEventListener("click", (e) => {
      if (e.target.tagName === "BUTTON") {
          const lang = e.target.dataset.lang;
          languageButton.querySelector("span").textContent = lang.toUpperCase();
          languageDropdown.classList.remove("active");
          // Aquí puedes agregar la lógica para cambiar el idioma de la página
      }
  });

  // Animación de aparición para los elementos del menú
  const navLinks = document.querySelectorAll(".lhe-nav-link");
  navLinks.forEach((link, index) => {
      link.style.animationDelay = `${0.1 * (index + 1)}s`;
  });
});
