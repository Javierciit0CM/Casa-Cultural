document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.querySelector(".lh-carousel")
    const slides = carousel.querySelectorAll(".lh-carousel-slide")
    const prevButton = document.querySelector(".lh-prev")
    const nextButton = document.querySelector(".lh-next")
    const indicatorsContainer = document.querySelector(".lh-carousel-indicators")
    const showFormButton = document.getElementById("lh-show-form")
    const formOverlay = document.getElementById("lh-form-overlay")
    const closeFormButton = document.getElementById("lh-close-form")
  
    let currentSlide = 0
    const totalSlides = slides.length
  
    // Create indicators
    slides.forEach((_, index) => {
      const indicator = document.createElement("div")
      indicator.classList.add("lh-indicator")
      if (index === 0) indicator.classList.add("lh-active")
      indicator.addEventListener("click", () => goToSlide(index))
      indicatorsContainer.appendChild(indicator)
    })
  
    const indicators = indicatorsContainer.querySelectorAll(".lh-indicator")
  
    function goToSlide(n) {
      slides[currentSlide].classList.remove("lh-active")
      indicators[currentSlide].classList.remove("lh-active")
      currentSlide = (n + totalSlides) % totalSlides
      slides[currentSlide].classList.add("lh-active")
      indicators[currentSlide].classList.add("lh-active")
    }
  
    function nextSlide() {
      goToSlide(currentSlide + 1)
    }
  
    function prevSlide() {
      goToSlide(currentSlide - 1)
    }
  
    nextButton.addEventListener("click", nextSlide)
    prevButton.addEventListener("click", prevSlide)
  
    // Auto-advance carousel
    let intervalId = setInterval(nextSlide, 5000)
  
    // Pause auto-advance on hover
    carousel.addEventListener("mouseenter", () => {
      clearInterval(intervalId)
    })
  
    carousel.addEventListener("mouseleave", () => {
      intervalId = setInterval(nextSlide, 5000)
    })
  
    // Show form overlay
    showFormButton.addEventListener("click", () => {
      formOverlay.classList.add("lh-active")
    })
  
    // Close form overlay
    closeFormButton.addEventListener("click", () => {
      formOverlay.classList.remove("lh-active")
    })
  
    // Close form overlay when clicking outside the form
    formOverlay.addEventListener("click", (e) => {
      if (e.target === formOverlay) {
        formOverlay.classList.remove("lh-active")
      }
    })
  
    // Form validation and animation
    const searchForm = document.querySelector(".lh-search-form")
    const checkInInput = document.getElementById("check-in")
    const checkOutInput = document.getElementById("check-out")
  
    searchForm.addEventListener("submit", (e) => {
      e.preventDefault()
  
      const checkInDate = new Date(checkInInput.value)
      const checkOutDate = new Date(checkOutInput.value)
  
      if (checkOutDate <= checkInDate) {
        alert("La fecha de check-out debe ser posterior a la fecha de check-in.")
        return
      }
  
      // Add animation class to form on submit
      searchForm.classList.add("lh-form-submitted")
  
      // Simulate form submission (replace with actual submission logic)
      setTimeout(() => {
        alert("¡Búsqueda de disponibilidad enviada!")
        searchForm.classList.remove("lh-form-submitted")
        formOverlay.classList.remove("lh-active")
      }, 1000)
    })
  
    // Parallax effect on hero content
    const heroContent = document.querySelector(".lh-hero-content")
    const heroCarousel = document.querySelector(".lh-hero-carousel")
    window.addEventListener("scroll", () => {
      const scrollPosition = window.pageYOffset
      const maxScroll = heroCarousel.offsetHeight
      if (scrollPosition <= maxScroll) {
        heroContent.style.transform = `translate(-50%, calc(-50% + ${scrollPosition * 0.3}px))`
      }
    })
  
    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function (e) {
        e.preventDefault()
        document.querySelector(this.getAttribute("href")).scrollIntoView({
          behavior: "smooth",
        })
      })
    })
  })
  
  