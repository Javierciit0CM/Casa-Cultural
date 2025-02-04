document.addEventListener("DOMContentLoaded", () => {
    const track = document.querySelector(".lh-testimonial-track")
    const slides = Array.from(track.children)
    const nextButton = document.querySelector(".lh-next")
    const prevButton = document.querySelector(".lh-prev")
    const dotsContainer = document.querySelector(".lh-testimonial-dots")
  
    let slideWidth = slides[0].getBoundingClientRect().width
    let currentIndex = 0
  
    // Arrange the slides next to one another
    const setSlidePosition = (slide, index) => {
      slide.style.left = slideWidth * index + "px"
    }
    slides.forEach(setSlidePosition)
  
    // Create dot indicators
    slides.forEach((_, index) => {
      const dot = document.createElement("div")
      dot.classList.add("lh-dot")
      if (index === 0) dot.classList.add("active")
      dotsContainer.appendChild(dot)
    })
  
    const dots = Array.from(dotsContainer.children)
  
    // Move to target slide
    const moveToSlide = (track, currentSlide, targetSlide) => {
      track.style.transform = "translateX(-" + targetSlide.style.left + ")"
      currentSlide.classList.remove("current-slide")
      targetSlide.classList.add("current-slide")
    }
  
    // Update dots
    const updateDots = (currentDot, targetDot) => {
      currentDot.classList.remove("active")
      targetDot.classList.add("active")
    }
  
    // Hide/show arrows
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
  
    // Next button click
    nextButton.addEventListener("click", (e) => {
      const currentSlide = track.querySelector(".current-slide")
      const nextSlide = currentSlide.nextElementSibling
      const currentDot = dotsContainer.querySelector(".active")
      const nextDot = currentDot.nextElementSibling
      const nextIndex = slides.findIndex((slide) => slide === nextSlide)
  
      moveToSlide(track, currentSlide, nextSlide)
      updateDots(currentDot, nextDot)
      hideShowArrows(slides, prevButton, nextButton, nextIndex)
  
      currentIndex = nextIndex
      animateSlide(nextSlide)
    })
  
    // Previous button click
    prevButton.addEventListener("click", (e) => {
      const currentSlide = track.querySelector(".current-slide")
      const prevSlide = currentSlide.previousElementSibling
      const currentDot = dotsContainer.querySelector(".active")
      const prevDot = currentDot.previousElementSibling
      const prevIndex = slides.findIndex((slide) => slide === prevSlide)
  
      moveToSlide(track, currentSlide, prevSlide)
      updateDots(currentDot, prevDot)
      hideShowArrows(slides, prevButton, nextButton, prevIndex)
  
      currentIndex = prevIndex
      animateSlide(prevSlide)
    })
  
    // Dot indicator click
    dotsContainer.addEventListener("click", (e) => {
      const targetDot = e.target.closest("button")
      if (!targetDot) return
  
      const currentSlide = track.querySelector(".current-slide")
      const currentDot = dotsContainer.querySelector(".active")
      const targetIndex = dots.findIndex((dot) => dot === targetDot)
      const targetSlide = slides[targetIndex]
  
      moveToSlide(track, currentSlide, targetSlide)
      updateDots(currentDot, targetDot)
      hideShowArrows(slides, prevButton, nextButton, targetIndex)
  
      currentIndex = targetIndex
      animateSlide(targetSlide)
    })
  
    // Animate slide
    const animateSlide = (slide) => {
      slide.style.animation = "none"
      slide.offsetHeight // Trigger reflow
      slide.style.animation = "fadeIn 0.5s ease-out, slideIn 0.5s ease-out"
    }
  
    // Auto-play functionality
    let autoplayInterval
    const startAutoplay = () => {
      autoplayInterval = setInterval(() => {
        const currentSlide = track.querySelector(".current-slide")
        let nextSlide = currentSlide.nextElementSibling
        if (!nextSlide) {
          nextSlide = slides[0]
        }
        const currentDot = dotsContainer.querySelector(".active")
        const nextDot = currentDot.nextElementSibling || dots[0]
        const nextIndex = slides.findIndex((slide) => slide === nextSlide)
  
        moveToSlide(track, currentSlide, nextSlide)
        updateDots(currentDot, nextDot)
        hideShowArrows(slides, prevButton, nextButton, nextIndex)
  
        currentIndex = nextIndex
        animateSlide(nextSlide)
      }, 5000) // Change slide every 5 seconds
    }
  
    const stopAutoplay = () => {
      clearInterval(autoplayInterval)
    }
  
    // Start autoplay
    startAutoplay()
  
    // Pause autoplay on hover
    track.addEventListener("mouseenter", stopAutoplay)
    track.addEventListener("mouseleave", startAutoplay)
  
    // Handle window resize
    window.addEventListener("resize", () => {
      slideWidth = slides[0].getBoundingClientRect().width
      slides.forEach(setSlidePosition)
      moveToSlide(track, slides[currentIndex], slides[currentIndex])
    })
  
    // Initial setup
    slides[0].classList.add("current-slide")
    hideShowArrows(slides, prevButton, nextButton, 0)
  
    // Parallax effect for background
    window.addEventListener("scroll", () => {
      const scrollPosition = window.pageYOffset
      document.querySelector(".lh-parallax-bg").style.transform = `translateY(${scrollPosition * 0.5}px)`
    })
  })
  
  