document.addEventListener("DOMContentLoaded", () => {
    const body = document.body
    const navToggle = document.querySelector(".eh-nav__toggle")
    const navList = document.querySelector(".eh-nav__list")
    const headerCta = document.querySelector(".eh-header__cta")
    const navClose = document.querySelector(".eh-nav__close")
  
    function toggleMenu() {
      const isExpanded = navToggle.getAttribute("aria-expanded") === "true"
      navToggle.setAttribute("aria-expanded", !isExpanded)
      navList.classList.toggle("eh-nav__list--active")
      headerCta.classList.toggle("eh-header__cta--active")
      body.classList.toggle("eh-menu-open")
    }
  
    navToggle.addEventListener("click", toggleMenu)
    navClose.addEventListener("click", toggleMenu)
  
    // Close menu when clicking a nav link
    navList.addEventListener("click", (event) => {
      if (event.target.classList.contains("eh-nav__link")) {
        toggleMenu()
      }
    })
  
    // Close menu when clicking outside
    document.addEventListener("click", (event) => {
      const isClickInsideNav = navToggle.contains(event.target) || navList.contains(event.target)
      if (!isClickInsideNav && navList.classList.contains("eh-nav__list--active")) {
        toggleMenu()
      }
    })
  
    // Handle window resize
    window.addEventListener("resize", () => {
      if (window.innerWidth > 768 && navList.classList.contains("eh-nav__list--active")) {
        toggleMenu()
      }
    })
  })
  
  