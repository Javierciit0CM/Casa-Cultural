document.addEventListener("DOMContentLoaded", () => {
    const blogCards = document.querySelectorAll(".lh-blog-card")
    const readMoreButtons = document.querySelectorAll(".lh-read-more")
    const ctaButton = document.querySelector(".lh-btn-primary")
    const parallaxBg = document.querySelector(".lh-parallax-bg")
  
    // Parallax effect for background
    window.addEventListener("scroll", () => {
      const scrollPosition = window.pageYOffset
      parallaxBg.style.transform = `translateY(${scrollPosition * 0.5}px)`
    })
  
    // Intersection Observer for fade-in effect
    const fadeInObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("lh-fade-in")
            fadeInObserver.unobserve(entry.target)
          }
        })
      },
      { threshold: 0.1 },
    )
  
    blogCards.forEach((card) => {
      fadeInObserver.observe(card)
    })
  
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function (e) {
        e.preventDefault()
        document.querySelector(this.getAttribute("href")).scrollIntoView({
          behavior: "smooth",
        })
      })
    })
  
    // Hover effects for blog cards
    blogCards.forEach((card) => {
      card.addEventListener("mouseenter", () => {
        card.style.transform = "translateY(-15px) scale(1.02)"
      })
      card.addEventListener("mouseleave", () => {
        card.style.transform = "translateY(0) scale(1)"
      })
    })
  
    // Animated underline effect for read more links
    readMoreButtons.forEach((button) => {
      button.addEventListener("mouseenter", () => {
        button.style.paddingBottom = "2px"
        button.style.borderBottom = "2px solid var(--primary-color)"
      })
      button.addEventListener("mouseleave", () => {
        button.style.paddingBottom = "0"
        button.style.borderBottom = "none"
      })
    })
  
    // Pulse animation for CTA button
    setInterval(() => {
      ctaButton.classList.add("pulse")
      setTimeout(() => {
        ctaButton.classList.remove("pulse")
      }, 1000)
    }, 3000)
  
    // Lazy loading for images
    const lazyImages = document.querySelectorAll("img[data-src]")
    const lazyImageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target
          img.src = img.dataset.src
          img.removeAttribute("data-src")
          lazyImageObserver.unobserve(img)
        }
      })
    })
  
    lazyImages.forEach((img) => {
      lazyImageObserver.observe(img)
    })
  })
  
  