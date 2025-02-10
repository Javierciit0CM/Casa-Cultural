document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".testimonials-carousel__track")
    const slides = Array.from(track.children)
    const nextButton = document.querySelector(".testimonials-carousel__button--next")
    const prevButton = document.querySelector(".testimonials-carousel__button--prev")
    const dotsNav = document.querySelector(".testimonials-carousel__dots")
    const playPauseButton = document.querySelector(".testimonials-carousel__play-pause")
  
    const slideWidth = slides[0].getBoundingClientRect().width
  
    // Arrange the slides next to one another
    const setSlidePosition = (slide, index) => {
      slide.style.left = slideWidth * index + "px"
    }
    slides.forEach(setSlidePosition)
  
    const moveToSlide = (track, currentSlide, targetSlide) => {
      track.style.transform = "translateX(-" + targetSlide.style.left + ")"
      currentSlide.classList.remove("current-slide")
      targetSlide.classList.add("current-slide")
    }
  
    const updateDots = (currentDot, targetDot) => {
      currentDot.classList.remove("testimonials-carousel__dot--active")
      targetDot.classList.add("testimonials-carousel__dot--active")
    }
  
    const hideShowArrows = (slides, prevButton, nextButton, targetIndex) => {
      if (targetIndex === 0) {
        prevButton.classList.add("is-hidden")
        nextButton.classList.remove("is-hidden")
      } else if (targetIndex === slides.length - 1) {
        prevButton.classList.remove("is-hidden")
        nextButton.classList.add("is-hidden")
      } else {
        prevButton.classList.remove("is-hidden")
        nextButton.classList.remove("is-hidden")
      }
    }
  
    // Create dot indicators
    slides.forEach((_, index) => {
      const dot = document.createElement("button")
      dot.classList.add("testimonials-carousel__dot")
      if (index === 0) {
        dot.classList.add("testimonials-carousel__dot--active")
      }
      dotsNav.appendChild(dot)
    })
  
    const dots = Array.from(dotsNav.children)
  
    // When I click left, move slides to the left
    prevButton.addEventListener("click", (e) => {
      const currentSlide = track.querySelector(".current-slide")
      const prevSlide = currentSlide.previousElementSibling || slides[slides.length - 1]
      const currentDot = dotsNav.querySelector(".testimonials-carousel__dot--active")
      const prevDot = currentDot.previousElementSibling || dots[dots.length - 1]
      const prevIndex = slides.findIndex((slide) => slide === prevSlide)
  
      moveToSlide(track, currentSlide, prevSlide)
      updateDots(currentDot, prevDot)
      hideShowArrows(slides, prevButton, nextButton, prevIndex)
    })
  
    // When I click right, move slides to the right
    nextButton.addEventListener("click", (e) => {
      const currentSlide = track.querySelector(".current-slide")
      const nextSlide = currentSlide.nextElementSibling || slides[0]
      const currentDot = dotsNav.querySelector(".testimonials-carousel__dot--active")
      const nextDot = currentDot.nextElementSibling || dots[0]
      const nextIndex = slides.findIndex((slide) => slide === nextSlide)
  
      moveToSlide(track, currentSlide, nextSlide)
      updateDots(currentDot, nextDot)
      hideShowArrows(slides, prevButton, nextButton, nextIndex)
    })
  
    // When I click the nav indicators, move to that slide
    dotsNav.addEventListener("click", (e) => {
      const targetDot = e.target.closest("button")
  
      if (!targetDot) return
  
      const currentSlide = track.querySelector(".current-slide")
      const currentDot = dotsNav.querySelector(".testimonials-carousel__dot--active")
      const targetIndex = dots.findIndex((dot) => dot === targetDot)
      const targetSlide = slides[targetIndex]
  
      moveToSlide(track, currentSlide, targetSlide)
      updateDots(currentDot, targetDot)
      hideShowArrows(slides, prevButton, nextButton, targetIndex)
    })
  
    // Auto advance functionality
    let intervalId
    const autoAdvanceTime = 3000 // 3 seconds
  
    const startAutoAdvance = () => {
      intervalId = setInterval(() => {
        const currentSlide = track.querySelector(".current-slide")
        const nextSlide = currentSlide.nextElementSibling || slides[0]
        const currentDot = dotsNav.querySelector(".testimonials-carousel__dot--active")
        const nextDot = currentDot.nextElementSibling || dots[0]
        const nextIndex = slides.findIndex((slide) => slide === nextSlide)
  
        moveToSlide(track, currentSlide, nextSlide)
        updateDots(currentDot, nextDot)
        hideShowArrows(slides, prevButton, nextButton, nextIndex)
      }, autoAdvanceTime)
    }
  
    const stopAutoAdvance = () => {
      clearInterval(intervalId)
    }
  
    // Start auto advance on page load
    startAutoAdvance()
  
    // Play/Pause functionality
    playPauseButton.addEventListener("click", () => {
      if (playPauseButton.classList.contains("is-paused")) {
        playPauseButton.classList.remove("is-paused")
        startAutoAdvance()
      } else {
        playPauseButton.classList.add("is-paused")
        stopAutoAdvance()
      }
    })
  
    // Pause auto advance when user interacts with carousel
    ;[prevButton, nextButton, dotsNav].forEach((element) => {
      element.addEventListener("click", () => {
        stopAutoAdvance()
        playPauseButton.classList.add("is-paused")
      })
    })
  })
  
  