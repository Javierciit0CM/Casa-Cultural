// Import AOS library.  You'll need to include the AOS library in your HTML file (e.g., via a `<script>` tag)
// For example: <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

document.addEventListener("DOMContentLoaded", () => {
    const roomCards = document.querySelectorAll(".lhs-room-card")
  
    // Inicializar AOS para animaciones de scroll
    AOS.init({
      duration: 800,
      once: true,
    })
  
    roomCards.forEach((card) => {
      const carousel = card.querySelector(".lhs-carousel")
      const images = carousel.querySelectorAll("img")
      let currentIndex = 0
  
      function showNextImage() {
        images[currentIndex].classList.remove("active")
        currentIndex = (currentIndex + 1) % images.length
        images[currentIndex].classList.add("active")
      }
  
      // Mostrar la primera imagen
      images[0].classList.add("active")
  
      // Iniciar el carrusel al pasar el mouse
      card.addEventListener("mouseenter", () => {
        card.carouselInterval = setInterval(showNextImage, 1000)
      })
  
      // Detener el carrusel al quitar el mouse
      card.addEventListener("mouseleave", () => {
        clearInterval(card.carouselInterval)
      })
    })
  
    // Validación de fechas
    const formSearch = document.querySelector(".lhs-search-form")
    const fechaEntrada = document.getElementById("fecha_entrada")
    const fechaSalida = document.getElementById("fecha_salida")
  
    formSearch.addEventListener("submit", (e) => {
      const today = new Date()
      const entradaDate = new Date(fechaEntrada.value)
      const salidaDate = new Date(fechaSalida.value)
  
      if (entradaDate < today) {
        e.preventDefault()
        alert("La fecha de entrada no puede ser anterior a hoy.")
      } else if (salidaDate <= entradaDate) {
        e.preventDefault()
        alert("La fecha de salida debe ser posterior a la fecha de entrada.")
      }
    })
  
    // Efecto parallax suave en las imágenes de las habitaciones
    window.addEventListener("scroll", () => {
      const scrollPosition = window.pageYOffset
      roomCards.forEach((card) => {
        const cardTop = card.offsetTop
        const cardHeight = card.offsetHeight
        const cardImage = card.querySelector("img")
  
        if (scrollPosition > cardTop - window.innerHeight && scrollPosition < cardTop + cardHeight) {
          const speed = 0.5 // Ajusta la velocidad del efecto parallax
          cardImage.style.transform = `translateY(${(scrollPosition - cardTop) * speed}px)`
        }
      })
    })
  })
  
  