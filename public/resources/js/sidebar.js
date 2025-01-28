document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("hotelSidebar")
  const sidebarToggle = document.getElementById("hotelSidebarToggle")
  const sidebarOverlay = document.querySelector(".sidebar-overlay")
  const dropdowns = document.querySelectorAll(".hotel-dropdown")
  const mobileBreakpoint = 768

  function toggleSidebar() {
    document.body.classList.toggle("sidebar-open")
    sidebar.classList.toggle("show")
  }

  function closeSidebar() {
    document.body.classList.remove("sidebar-open")
    sidebar.classList.remove("show")
  }

  function handleResize() {
    if (window.innerWidth <= mobileBreakpoint) {
      closeSidebar()
    }
  }

  // Toggle sidebar
  sidebarToggle.addEventListener("click", toggleSidebar)

  // Close sidebar when clicking on overlay
  sidebarOverlay.addEventListener("click", closeSidebar)

  // Handle window resize
  window.addEventListener("resize", handleResize)

  // Toggle dropdowns
  dropdowns.forEach((dropdown) => {
    const toggle = dropdown.querySelector(".hotel-dropdown__toggle")
    const menu = dropdown.querySelector(".hotel-dropdown__menu")

    toggle.addEventListener("click", (event) => {
      event.stopPropagation()
      menu.classList.toggle("show")
    })

    // Close dropdown when clicking outside
    document.addEventListener("click", (event) => {
      if (!dropdown.contains(event.target)) {
        menu.classList.remove("show")
      }
    })
  })

  // Add active class to current page link
  const currentPath = window.location.pathname
  const sidebarLinks = document.querySelectorAll(".hotel-sidebar__link")
  sidebarLinks.forEach((link) => {
    if (link.getAttribute("href") === currentPath) {
      link.classList.add("active")
    }
  })

  // Initial check for screen size
  handleResize()
})


// Menus

// Selección de los botones y menús correspondientes
const notificationToggle = document.querySelector('.hotel-dropdown__toggle');
const profileToggle = document.querySelector('.hotel-profile__toggle');
const notificationMenu = document.querySelector('.hotel-dropdown__menu');
const profileMenu = document.querySelectorAll('.hotel-dropdown__menu')[1]; // El segundo menú corresponde al perfil

// Función para alternar el estado del menú de notificaciones
notificationToggle.addEventListener('click', function (event) {
  // Evitar que el clic en el botón de notificaciones cierre el menú
  event.stopPropagation();

  // Verifica si el menú de notificaciones está abierto
  notificationMenu.classList.toggle('show');
  
  // Si el menú de perfil está abierto, ciérralo
  if (profileMenu.classList.contains('show')) {
    profileMenu.classList.remove('show');
  }
});

// Función para alternar el estado del menú del perfil
profileToggle.addEventListener('click', function (event) {
  // Evitar que el clic en el botón de perfil cierre el menú
  event.stopPropagation();

  // Verifica si el menú del perfil está abierto
  profileMenu.classList.toggle('show');
  
  // Si el menú de notificaciones está abierto, ciérralo
  if (notificationMenu.classList.contains('show')) {
    notificationMenu.classList.remove('show');
  }
});

// Función para cerrar los menús cuando se haga clic fuera de los menús desplegables
document.addEventListener('click', function (event) {
  // Si el clic es fuera del menú de notificaciones, lo cerramos
  if (!notificationMenu.contains(event.target) && !notificationToggle.contains(event.target)) {
    notificationMenu.classList.remove('show');
  }

  // Si el clic es fuera del menú del perfil, lo cerramos
  if (!profileMenu.contains(event.target) && !profileToggle.contains(event.target)) {
    profileMenu.classList.remove('show');
  }
});