document.addEventListener("DOMContentLoaded", () => {
    const quickLinks = document.querySelectorAll(".lhe-quick-link")
    const hoverImageContainer = document.querySelector(".lhe-hover-image-container")
    const hoverImage = document.querySelector(".lhe-hover-image")
  
    quickLinks.forEach((link) => {
      link.addEventListener("mouseenter", function (e) {
        const imageUrl = this.getAttribute("data-image")
        hoverImage.src = imageUrl
        hoverImage.alt = this.textContent
  
        const linkRect = this.getBoundingClientRect()
        const footerRect = document.querySelector(".lhe-footer").getBoundingClientRect()
  
        hoverImageContainer.style.left = `${linkRect.right + 10}px`
        hoverImageContainer.style.top = `${linkRect.top - footerRect.top}px`
        hoverImageContainer.style.opacity = "1"
      })
  
      link.addEventListener("mouseleave", () => {
        hoverImageContainer.style.opacity = "0"
      })
    })
  })
  
  