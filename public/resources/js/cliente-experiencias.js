document.addEventListener("DOMContentLoaded", () => {
  const culinaryItems = document.querySelectorAll(".lh-culinary-item")
  const filterButtons = document.querySelectorAll(".lh-filter-btn")

  // Animación de aparición para los elementos culinarios
  const culinaryObserver = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("lh-fade-in")
          observer.unobserve(entry.target)
        }
      })
    },
    { threshold: 0.1 },
  )

  culinaryItems.forEach((item) => {
    culinaryObserver.observe(item)
  })

  // Filtrado de la galería culinaria
  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const filter = button.getAttribute("data-filter")

      filterButtons.forEach((btn) => btn.classList.remove("active"))
      button.classList.add("active")

      culinaryItems.forEach((item) => {
        item.classList.remove("lh-scale-in")
        if (filter === "all" || item.getAttribute("data-category") === filter) {
          item.style.display = "block"
          setTimeout(() => {
            item.classList.add("lh-scale-in")
          }, 10)
        } else {
          item.style.display = "none"
        }
      })
    })
  })

  // Efecto parallax para el fondo
  window.addEventListener("scroll", () => {
    const scrollPosition = window.pageYOffset
    document.querySelector(".lh-culinary-experience").style.backgroundPositionY = scrollPosition * 0.5 + "px"
  })

  // Efecto de zoom suave al hacer hover en las imágenes
  culinaryItems.forEach((item) => {
    item.addEventListener("mouseenter", () => {
      item.querySelector("img").style.transform = "scale(1.05)"
    })

    item.addEventListener("mouseleave", () => {
      item.querySelector("img").style.transform = "scale(1)"
    })
  })

  // Función para intercambiar imágenes
  function swapImages(clickedItem) {
    const mainFeature = document.querySelector(".lh-culinary-feature")
    const mainImg = mainFeature.querySelector("img")
    const mainOverlay = mainFeature.querySelector(".lh-culinary-overlay")

    const clickedImg = clickedItem.querySelector("img")
    const clickedOverlay = clickedItem.querySelector(".lh-culinary-overlay")

    // Determinar la dirección del desplazamiento
    const rect = clickedItem.getBoundingClientRect()
    const centerX = window.innerWidth / 2
    const slideDirection = rect.left < centerX ? "right" : "left"

    // Animación de salida para la imagen principal
    mainFeature.classList.add(`slide-out-${slideDirection}`)

    setTimeout(() => {
      // Intercambiar contenido
      const tempSrc = mainImg.src
      const tempAlt = mainImg.alt
      const tempOverlayHTML = mainOverlay.innerHTML

      mainImg.src = clickedImg.src
      mainImg.alt = clickedImg.alt
      mainOverlay.innerHTML = clickedOverlay.innerHTML

      clickedImg.src = tempSrc
      clickedImg.alt = tempAlt
      clickedOverlay.innerHTML = tempOverlayHTML

      // Animación de entrada para la nueva imagen principal
      mainFeature.classList.remove(`slide-out-${slideDirection}`)
      mainFeature.classList.add(`slide-in-${slideDirection === "left" ? "right" : "left"}`)

      // Restablecer clases de animación
      setTimeout(() => {
        mainFeature.classList.remove(`slide-in-${slideDirection === "left" ? "right" : "left"}`)
      }, 500)
    }, 500)
  }

  // Event listener para las imágenes seleccionables
  const selectableItems = document.querySelectorAll(".lh-culinary-selectable")
  selectableItems.forEach((item) => {
    item.addEventListener("click", () => swapImages(item))
  })
})

