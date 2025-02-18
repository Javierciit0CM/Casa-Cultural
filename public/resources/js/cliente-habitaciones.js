// Import AOS library.  This will depend on how you've included AOS in your project.
//  Examples include:
//  import AOS from 'aos';  // If using a module bundler like Webpack or Parcel
//  <script src="https://unpkg.com/aos@next/dist/aos.js"></script> //If using a CDN

document.addEventListener("DOMContentLoaded", () => {
    // Inicializar AOS (Animate On Scroll)
    AOS.init({
      duration: 800,
      easing: "ease-in-out",
      once: true,
      mirror: false,
    })
  
    // Efecto de zoom en las imágenes al hacer hover
    const roomImages = document.querySelectorAll(".room-image img")
    roomImages.forEach((img) => {
      img.addEventListener("mouseenter", () => {
        img.style.transform = "scale(1.1)"
      })
      img.addEventListener("mouseleave", () => {
        img.style.transform = "scale(1)"
      })
    })
  })

  // Mostrar Habitaciones

  document.addEventListener("DOMContentLoaded", () => {
    let currentImageIndex = 0
  
    const mainImage = document.querySelector(".room-details__image")
    const prevButton = document.querySelector(".room-details__image-nav--prev")
    const nextButton = document.querySelector(".room-details__image-nav--next")
    const indicatorsContainer = document.querySelector(".room-details__image-indicators")
  
    function updateMainImage() {
      mainImage.src = images[currentImageIndex]
      updateIndicators()
    }
  
    function createImageIndicators() {
      images.forEach((_, index) => {
        const indicator = document.createElement("span")
        indicator.classList.add("room-details__image-indicator")
        if (index === 0) indicator.classList.add("room-details__image-indicator--active")
        indicator.addEventListener("click", () => {
          currentImageIndex = index
          updateMainImage()
        })
        indicatorsContainer.appendChild(indicator)
      })
    }
  
    function updateIndicators() {
      const indicators = document.querySelectorAll(".room-details__image-indicator")
      indicators.forEach((indicator, index) => {
        if (index === currentImageIndex) {
          indicator.classList.add("room-details__image-indicator--active")
        } else {
          indicator.classList.remove("room-details__image-indicator--active")
        }
      })
    }
  
    prevButton.addEventListener("click", () => {
      currentImageIndex = (currentImageIndex - 1 + images.length) % images.length
      updateMainImage()
    })
  
    nextButton.addEventListener("click", () => {
      currentImageIndex = (currentImageIndex + 1) % images.length
      updateMainImage()
    })
  
    createImageIndicators()
  
    // Animación de entrada
    const title = document.querySelector(".room-details__title")
    const gallery = document.querySelector(".room-details__gallery")
    const info = document.querySelector(".room-details__info")
  
    function animate(element, delay) {
      setTimeout(() => {
        element.style.opacity = "1"
        element.style.transform = "translateY(0)"
      }, delay)
    }
    ;[title, gallery, info].forEach((element, index) => {
      element.style.opacity = "0"
      element.style.transform = "translateY(20px)"
      element.style.transition = "opacity 0.5s ease, transform 0.5s ease"
      animate(element, index * 200)
    })
  
    // Efecto hover para el botón de reserva
    const bookBtn = document.querySelector(".room-details__book-btn")
    bookBtn.addEventListener("mouseenter", () => {
      bookBtn.style.transform = "translateY(-2px)"
    })
    bookBtn.addEventListener("mouseleave", () => {
      bookBtn.style.transform = "translateY(0)"
    })
  })
  
  
