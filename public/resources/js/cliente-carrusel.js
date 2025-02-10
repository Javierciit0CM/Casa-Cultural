document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".carousel-slide")
  const prevButton = document.querySelector(".carousel-button.prev")
  const nextButton = document.querySelector(".carousel-button.next")
  const dotsContainer = document.querySelector(".carousel-dots")

  let currentIndex = 0
  let intervalId

  function createDots() {
    slides.forEach((_, index) => {
      const dot = document.createElement("div")
      dot.classList.add("carousel-dot")
      if (index === 0) dot.classList.add("active")
      dot.addEventListener("click", () => goToSlide(index))
      dotsContainer.appendChild(dot)
    })
  }

  function updateDots() {
    const dots = document.querySelectorAll(".carousel-dot")
    dots.forEach((dot, index) => {
      dot.classList.toggle("active", index === currentIndex)
    })
  }

  function goToSlide(index) {
    slides[currentIndex].classList.remove("active")
    currentIndex = index
    slides[currentIndex].classList.add("active")
    updateDots()
  }

  function nextSlide() {
    goToSlide((currentIndex + 1) % slides.length)
  }

  function prevSlide() {
    goToSlide((currentIndex - 1 + slides.length) % slides.length)
  }

  function startAutoPlay() {
    intervalId = setInterval(nextSlide, 5000)
  }

  function stopAutoPlay() {
    clearInterval(intervalId)
  }

  createDots()
  prevButton.addEventListener("click", () => {
    prevSlide()
    stopAutoPlay()
    startAutoPlay()
  })
  nextButton.addEventListener("click", () => {
    nextSlide()
    stopAutoPlay()
    startAutoPlay()
  })

  const carouselContainer = document.querySelector(".carousel-container")
  carouselContainer.addEventListener("mouseenter", stopAutoPlay)
  carouselContainer.addEventListener("mouseleave", startAutoPlay)

  startAutoPlay()
})

